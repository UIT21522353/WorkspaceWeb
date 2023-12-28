<?php

$host="localhost";
$username="root";
$password="";
$database="database";
//create db connection
$conn=mysqli_connect($host, $username, $password, $database);
//check db connection
// if(!$conn){
//     die("Connection failed: ". mysqli_connect_errno());
// }else{
//     echo "Connected succesflly";
// }

?>