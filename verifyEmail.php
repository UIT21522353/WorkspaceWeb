<?php
session_start();

include('./config/dbconn.php');

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Sử dụng Prepared Statements để ngăn chặn SQL injection
    $verify_query = "SELECT verification_code, verify_status FROM users WHERE verification_code = ? LIMIT 1";
    $stmt = $conn->prepare($verify_query);
    $stmt->bind_param('s', $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($verification_code, $verify_status);
        $stmt->fetch();

        if ($verify_status == '0') {
            // Cập nhật trạng thái xác minh
            $update_verify_query = "UPDATE users SET verify_status='1' WHERE verification_code=? LIMIT 1";
            $stmt_update = $conn->prepare($update_verify_query);
            $stmt_update->bind_param('s', $token);

            if ($stmt_update->execute()) {
                $_SESSION['message'] = "Your Account has been verified successfully !!";
                header("Location: login.php");
                exit(0);
            } else {
                $_SESSION['message'] = "Verification Failed !!";
                header("Location: login.php");
                exit(0);
            }
        } else {
            $_SESSION['message'] = "Email Already Verified. Please Login!!";
            header("Location: login.php");
            exit(0);
        }
    } else {
        $_SESSION['message'] = "This Token does not exist";
        header("Location: login.php");
    }

    $stmt->close();
} else {
    $_SESSION["message"] = "Not Allowed";
    header("Location: login.php");
    exit(0);
}
?>
