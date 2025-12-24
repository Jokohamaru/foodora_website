<?php
$servername = "localhost";
$username = "root";
$password = "123456";
$databasename = "foodora_db";

// Create connection
$conn = new mysqli($servername, $username, $password,$databasename);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "<script>console.log('Connected successfully');</script>";
?>