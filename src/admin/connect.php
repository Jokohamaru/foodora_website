<?php
    $servername = "localhost";
    $username = "root";
    $password = "123456";
    $database = "foodora_db";

    $conn =  new mysqli($servername,$username,$password,$database);

    if($conn->connect_error){
        die("Connect failed: " . $conn->connect_error);
    }
    else{
        // echo "Connect successfully";
    }
?>