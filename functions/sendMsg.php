<?php
session_start();
include('../config/dbconn.php');

if (isset($_POST['sendMsgBtn'])) {
    if ($_SESSION['role_as'] != 1) {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $msg = $_POST['msg'];

        // Sử dụng Prepared Statements để ngăn chặn SQL injection
        $insert_query = "INSERT INTO messages(first_name, last_name, email, msg) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param('ssss', $firstName, $lastName, $email, $msg);

        if ($stmt->execute()) {
            $_SESSION['message'] = 'Message sent successfully';
            header('location: ../contactUs.php');
        } else {
            $_SESSION['message'] = 'Something went wrong';
            header('location: ../contactUs.php');
        }

        $stmt->close();
    } else {
        // Admins are not allowed to send messages
        $_SESSION['message'] = 'Admins are not allowed to send messages';
        header('location: ../contactUs.php');
    }
}
?>