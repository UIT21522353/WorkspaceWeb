<?php

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'webgaming';

//global $conn;
$conn = mysqli_connect($host, $user, $password, $database);

if($conn === false){
    die("Không thể kết nối tới database ". mysqli_connect_error());   
}

?>
