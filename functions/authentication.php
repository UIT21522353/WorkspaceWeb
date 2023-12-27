<?php
session_start();

// if (session_status() == PHP_SESSION_NONE) {
//     session_start();
// }

include('../config/dbconn.php');
include('./myFunctions.php');
require_once('../PHPMailer-master/src/Exception.php');
require_once('../PHPMailer-master/src/PHPMailer.php');
require_once('../PHPMailer-master/src/SMTP.php');

if (isset($_POST['registerBtn'])) {
    //to prevent sql injection -> mysqli_real...
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
    $verification_code = sprintf('%06d', mt_rand(0, 999999));

    // use Prepared Statements to prevent sql injection
    $check_email_query = "SELECT email FROM users WHERE email=?";
    $stmt = $conn->prepare($check_email_query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $_SESSION['message'] = "Email has already existed";
        header('location: ../register.php');
    } else {
        if ($password == $cpassword) {
            // Hash the password before storing it in the database
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // $insert_query = "INSERT INTO users(name, email, phone, password, verification_code) VALUES('$name','$email','$phone','$hashedPassword','$verification_code')";
            // $insert_query_run = mysqli_query($conn, $insert_query);    

            $insert_query = "INSERT INTO users(name, email, phone, password, verification_code) VALUES(?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($insert_query);
            $stmt->bind_param('sssss', $name, $email, $phone, $hashedPassword, $verification_code);
            $stmt->execute();

            // use Prepared Statements
            if ($stmt->affected_rows > 0) {
                sendRegistrationEmail("$name", "$email", "$verification_code");
            } else {
                $_SESSION['message'] = 'Something went wrong';
                header('location: ../register.php');
            }
        } else {
            //use session so add session_start(); at the start of the page
            $_SESSION['message'] = "Password do not match";
            header('location: ../register.php');
        }
    }
    $stmt->close();
} else if (isset($_POST['loginBtn'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);


    //$login_query = "SELECT * FROM users WHERE email='$email'";
    //$login_query_run = mysqli_query($conn, $login_query);

    //to prevent sql injection
    $login_query = "SELECT * FROM users WHERE email=?";
    $stmt = $conn->prepare($login_query);
    $stmt->bind_param('s', $email);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        //$userdata = mysqli_fetch_array($login_query_run);
        $userdata = $result->fetch_assoc();
        $hashedPassword = $userdata['password'];
        $verifyStatus = $userdata['verify_status'];


        if (password_verify($password, $hashedPassword)) {
            if ($verifyStatus == 1) {
                $_SESSION['auth'] = true;

                $userid = $userdata['id'];
                $username = $userdata['name'];
                $useremail = $userdata['email'];
                $userphone = $userdata['phone'];
                $role_as = $userdata['role_as'];

                $_SESSION['auth_user'] = [
                    'user_id' => $userid,
                    'name' => $username,
                    'email' => $useremail,
                    'phone' => $userphone
                ];
                $_SESSION['role_as'] = $role_as;

                // 1==admin
                if ($role_as == 1) {
                    redirect("../admin/index.php", "Welcome to the dashboard");
                } else {
                    redirect("../index.php", "Logged in");
                }
            } else {
                // verify email
                redirect("../login.php", "You need to verify your email first");
            }
        } else {
            redirect("../login.php", "Invalid!");
        }
    } else {
        // invalid
        redirect("../login.php", "Don't have an account yet? Register right at the top right!");
    }
    $stmt->close();
} else if (isset($_POST["ResetBtn"])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $token = sprintf('%06d', mt_rand(0, 999999));

    //$check_email_query = "SELECT email FROM users WHERE email='$email'";
    //$check_email_query_run = mysqli_query($conn, $check_email_query);
    // Check if the user is not an admin (role_as != 1)
    $check_user_role_query = "SELECT role_as FROM users WHERE email='$email'";
    $check_user_role_query_run = mysqli_query($conn, $check_user_role_query);

    if ($check_user_role_query_run) {
        $user_role = mysqli_fetch_assoc($check_user_role_query_run)['role_as'];

        if ($user_role != 1) {  // Check if the user is not an admin
            $check_email_query = "SELECT email FROM users WHERE email=?";
            $stmt = $conn->prepare($check_email_query);
            $stmt->bind_param('s', $email);
            $stmt->execute();

            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                //$row = mysqli_fetch_array($check_email_query_run);
                $row = $result->fetch_assoc();
                $get_name = $row["name"];
                $get_email = $row["email"];

                //$update_token = "UPDATE users SET verification_code= '$token' WHERE email = '$get_email' LIMIT 1";
                //$update_token_run = mysqli_query($conn, $update_token);
                $update_token = "UPDATE users SET verification_code= ? WHERE email = ? LIMIT 1";
                $stmt = $conn->prepare($update_token);
                $stmt->bind_param('ss', $token, $get_email);
                $stmt->execute();

                if ($stmt->affected_rows > 0) {
                    sendPasswordResetEmail($get_name, $get_email, $token);
                    $_SESSION['message'] = 'We have sent you a Resert Password email';
                    $stmt->close();
                    header('location: ../passwordReset.php');
                    exit(0);
                } else {
                    $_SESSION['message'] = 'Something went wrong';
                    $stmt->close();
                    header('location: ../passwordReset.php');
                    exit(0);
                }
            } else {
                $_SESSION['message'] = 'No Email Found';
                $stmt->close();
                header('location: ../passwordReset.php');
                exit(0);
            }
        } else {
            $_SESSION['message'] = 'Admins are not allowed to reset passwords';
            header('location: ../passwordReset.php');
            exit(0);
        }
    }
}
if (isset($_POST["updatePasswordBtn"])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $newPassword = mysqli_real_escape_string($conn, $_POST['newPassword']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmPassword']);

    $token = mysqli_real_escape_string($conn, $_POST['passwordToken']);

    if (!empty($token)) {
        if (!empty($email) && !empty($newPassword) && !empty($confirmPassword)) {
            //check token is valid
            //$check_token = "SELECT verification_code FROM users WHERE verification_code='$token' LIMIT 1";
            //$check_token_run = mysqli_query($conn, $check_token);
            $check_token_query = "SELECT verification_code FROM users WHERE verification_code=?";
            $stmt = $conn->prepare($check_token_query);
            $stmt->bind_param('s', $token);
            $stmt->execute();

            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                if ($newPassword == $confirmPassword) {
                    // Hash the new password
                    $hashednewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                    //$update_password = "UPDATE users SET password= '$hashednewPassword' WHERE verification_code='$token' LIMIT 1";
                    //$update_password_run = mysqli_query($conn, $update_password);
                    $update_password_query = "UPDATE users SET password= ? WHERE verification_code= ? LIMIT 1";
                    $stmt = $conn->prepare($update_password_query);
                    $stmt->bind_param('ss', $hashednewPassword, $token);
                    $stmt->execute();

                    if ($stmt->affected_rows > 0) {
                        // update verification_code
                        $new_verification_code = sprintf('%06d', mt_rand(0, 999999));
                        $update_new_verification_code_query = "UPDATE users SET verification_code= ?, verify_status = '1' WHERE verification_code= ? LIMIT 1";
                        $stmt = $conn->prepare($update_new_verification_code_query);
                        $stmt->bind_param('ss', $new_verification_code, $token);
                        $stmt->execute();

                        $_SESSION['message'] = "New Password Update Successfully!!";
                        $stmt->close();
                        header('location: ../login.php');
                        exit(0);
                    } else {
                        $_SESSION['message'] = "Have you updated your password yet? Something went wrong";
                        $stmt->close();
                        header("location: ../passwordUpdate.php?token=$token&email=$email");
                        exit(0);
                    }
                } else {
                    $_SESSION['message'] = "Password do not match";
                    $stmt->close();
                    header("location: ../passwordUpdate.php?token=$token&email=$email");
                    exit(0);
                }
            } else {
                $_SESSION['message'] = 'Invalid Token';
                $stmt->close();
                header("location: ../passwordUpdate.php?token=$token&email=$email");
                exit(0);
            }
        } else {
            $_SESSION['message'] = 'Please fill out all fields';
            $stmt->close();
            header("location: ../passwordUpdate.php?token=$token&email=$email");
            exit(0);
        }
    } else {
        $_SESSION['message'] = 'No Token Available';
        $stmt->close();
        header('location: ../passwordUpdate.php');
        exit(0);
    }
}
