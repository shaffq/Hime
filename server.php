<?php
session_start();


// Create connection
$conn = new mysqli("localhost", "root", "", "himev2");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = addslashes($data);
    return $data;
  }
//$conn->close();
?>