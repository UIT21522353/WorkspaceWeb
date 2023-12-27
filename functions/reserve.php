<?php
session_start();
include('../config/dbconn.php');

function generateUniqueId()
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charLength = strlen($characters);
    $uniqueId = '';

    for ($i = 0; $i < 20; $i++) {
        $randomIndex = mt_rand(0, $charLength - 1);
        $uniqueId .= $characters[$randomIndex];
    }

    return $uniqueId;
}

if (isset($_POST['reserveBtn'])) {
    if ($_SESSION['role_as'] != 1) {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $adult = $_POST['adult'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $note = $_POST['note'];

        // Sử dụng Prepared Statements để ngăn chặn SQL injection
        $insert_query = "INSERT INTO reservations(name, phone, adult, date, time, note) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param('ssssss', $name, $phone, $adult, $date, $time, $note);

        if ($stmt->execute()) {
            $_SESSION['message'] = 'Reserved successfully. We will contact with you in a minute!';
            header('location: ../reservation.php');
        } else {
            $_SESSION['message'] = 'Something went wrong';
            header('location: ../reservation.php');
        }

        $stmt->close();
    } else {
        // Admins are not allowed to make reservations
        $_SESSION['message'] = 'Admins are not allowed to make reservations';
        header('location: ../reservation.php');
    }
}
?>