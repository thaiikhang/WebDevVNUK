<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "reviewphp";

    $conn = mysqli_connect($servername,$username,$password,$database);
    mysqli_set_charset($conn, 'UTF8');

    if(!$conn){
        die("Connection failed: ".mysqli_connect_error());
    } else {
        echo("connected successfully");
    }
?>

