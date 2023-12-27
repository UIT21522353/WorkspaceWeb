<?php
// session_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('../config/dbconn.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once('../PHPMailer-master/src/Exception.php');
require_once('../PHPMailer-master/src/PHPMailer.php');
require_once('../PHPMailer-master/src/SMTP.php');

// use Prepared Statements to prevent sql injection
function getAll($table)
{
    global $conn;
    $query = "SELECT* FROM $table";
    // $query_run = mysqli_query($conn, $query);
    // return $query_run;
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}
function getByID($table, $id)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id); // i is interger
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

function redirect($url, $message)
{
    $_SESSION['message'] = $message;
    header('location:' . $url);
    exit();
}
function getAllOrders()
{
    // nếu chỉ lấy đơn hàng bằng 0 thì giữ cx được không thì dùng $stmt
    global $conn;
    $query = "SELECT * FROM orders WHERE status='0'";
    $query_run = mysqli_query($conn, $query);
    return $query_run;
}
function checkTrackingNoExist($trackingNo)
{
    global $conn;
   
    //$query="SELECT * FROM orders WHERE tracking_no='$trackingNo'";
    //return mysqli_query($conn, $query);
    $query = "SELECT * FROM orders WHERE tracking_no=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $trackingNo);  // s is string
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

function getOrderHistory()
{
    global $conn;
   
    //$query="SELECT * FROM orders WHERE status != '0'";
    //return mysqli_query($conn, $query);
    $query = "SELECT * FROM orders WHERE status != '0'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}
// verify email registration
function sendRegistrationEmail($name, $email, $verification_code)
{
    $mail = new PHPMailer(true);
    
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'foodiesbistrongarden@gmail.com';   
        $mail->Password   = 'hbrb cmvj taxm qzak';  
        $mail->SMTPSecure = 'tls';                  
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('foodiesbistrongarden@gmail.com', 'Foodies');  
        $mail->addAddress($email, $name);

        // Content
        $mail->isHTML(true);
        $mail->Subject = "Email Verification from Foodies";
        $mail_template = "
            <h2> You have Registered with Foodies </h2>
            <h5> Verify your email address to Login with the below given link </h5>
            <br/><br/>
            <a href ='http://localhost:8080/Foodies/verifyEmail.php?token=$verification_code'> Click me </a>
        ";

        $mail->Body = $mail_template;

        $mail->send();
        $_SESSION['message'] = "Email has been sent. Please check your email.";
        header("Location: ../login.php");
        return true;
     
    } catch (Exception $e) {
     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
     return false;
    } 
}

// email for reset Password
function sendPasswordResetEmail($get_name, $get_email, $token)
{
    $mail = new PHPMailer(true);
    
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'foodiesbistrongarden@gmail.com';   
        $mail->Password   = 'hbrb cmvj taxm qzak';  
        $mail->SMTPSecure = 'tls';                  
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('foodiesbistrongarden@gmail.com', 'Foodies');  
        $mail->addAddress($get_email, $get_name);

        // Content
        $mail->isHTML(true);
        $mail->Subject = "Reset Password Notification";
        $mail_template = "
            <h2> Hello </h2>
            <h5> You are receiving this email because we received a password reset request for your account </h5>
            <br/><br/>
            <a href ='http://localhost:8080/Foodies/passwordUpdate.php?token=$token&email=$get_email'> Click me </a>
        ";

        $mail->Body = $mail_template;

        $mail->send();
        echo 'Email has been sent'; 
        return true;
     
    } catch (Exception $e) {
     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
     return false;
    }
}


// send email when order successfully
function sendOrderConfirmationEmail($name, $email, $tracking_no)
{
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'foodiesbistrongarden@gmail.com';
        $mail->Password   = 'hbrb cmvj taxm qzak'; 
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Người nhận
        $mail->setFrom('foodiesbistrongarden@gmail.com', 'Foodies');
        $mail->addAddress($email, $name);

        // Nội dung
        $mail->isHTML(true);
        $mail->Subject = "Order Placed Successfully";
        $mail_template = "
            <h2>Dear our beloved customer</h2>
            <h5>Your order has been placed successfully with tracking code: $tracking_no</h5>
            <br/><br/>
            <p>Thank you for supporting us. Hope you like it!</p>
        ";

        $mail->Body = $mail_template;

        $mail->send();
        return true;
    } catch (Exception $e) {
        echo "Không thể gửi thông điệp. Lỗi Mailer: {$mail->ErrorInfo}";
        return false;
    }
}
function getOnGoingReservations()
{
    global $conn;
    $query = "SELECT * FROM reservations WHERE status='1' OR status='2'";
    $query_run = mysqli_query($conn, $query);
    return $query_run;
}
function getAllReservations()
{
    global $conn;
    $query = "SELECT * FROM reservations";
    $query_run = mysqli_query($conn, $query);
    return $query_run;
}