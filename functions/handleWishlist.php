<?php
session_start();
include('../config/dbconn.php');

if (isset($_SESSION['auth'])) {
    // Check if the user is not an admin (role_as != 1)
    if ($_SESSION['role_as'] != 1) {
        if (isset($_POST['scope'])) {
            $scope = $_POST['scope'];

        switch ($scope) {
            case "add":
                $product_id = $_POST['product_id'];
                $product_qty = $_POST['product_qty'];

                $user_id = $_SESSION['auth_user']['user_id'];
                // $check_existing = "SELECT * FROM wishlist WHERE product_id='$product_id' AND user_id='$user_id'";
                // $check_existing_run = mysqli_query($conn, $check_existing);

                // Use Prepared Statements to prevent SQL injection
                $check_existing_query = "SELECT * FROM wishlist WHERE product_id=? AND user_id=?";
                $check_existing_stmt = $conn->prepare($check_existing_query);
                $check_existing_stmt->bind_param('ii', $product_id, $user_id);
                $check_existing_stmt->execute();
                $check_existing_result = $check_existing_stmt->get_result();

                if ($check_existing_result->num_rows > 0) {
                    echo "existing";
                } else {
                    // $insert_query = "INSERT INTO wishlist (user_id, product_id, product_qty) VALUES ('$user_id','$product_id','$product_qty')";
                    // $insert_query_run = mysqli_query($conn, $insert_query);

                    $insert_query = "INSERT INTO wishlist (user_id, product_id, product_qty) VALUES (?, ?, ?)";
                    $insert_stmt = $conn->prepare($insert_query);
                    $insert_stmt->bind_param('iii', $user_id, $product_id, $product_qty);
                    $insert_query_run = $insert_stmt->execute();

                    if ($insert_query_run) {
                        echo 201;
                    } else {
                        echo 500;
                    }
                }

                break;
            case "delete":
                $wishlist_id = $_POST['wishlist_id'];

                $user_id = $_SESSION['auth_user']['user_id'];
    
                // $check_existing = "SELECT * FROM wishlist WHERE id='$wishlist_id' AND user_id='$user_id'";
                // $check_existing_run = mysqli_query($conn, $check_existing);

                $check_existing_query = "SELECT * FROM wishlist WHERE id=? AND user_id=?";
                $check_existing_stmt = $conn->prepare($check_existing_query);
                $check_existing_stmt->bind_param('ii', $wishlist_id, $user_id);
                $check_existing_stmt->execute();
                $check_existing_result = $check_existing_stmt->get_result();

                if ($check_existing_result->num_rows > 0) {
                    // $delete_query = "DELETE FROM wishlist WHERE id='$wishlist_id'";
                    // $delete_query_run = mysqli_query($conn, $delete_query);
                    $delete_query = "DELETE FROM wishlist WHERE id=?";
                    $delete_stmt = $conn->prepare($delete_query);
                    $delete_stmt->bind_param('i', $wishlist_id);
                    $delete_query_run = $delete_stmt->execute();

                    if ($delete_query_run) {
                        echo 201;
                    } else {
                        echo "Something went wrong";
                    }
                } else {
                    echo "Something went wrong";
                }
                break;
            default:
                echo 500;
        }
    }
} else {
    echo 403; // Forbidden: Admins are not allowed to perform cart actions
    }
} else {
    echo 401;
}