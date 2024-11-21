<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$db = "employee_db";
// create connection
$conn = new mysqli($servername, $username, $password, $db);

// check connection
if ($conn->connect_error) {
  die("connection failed:" . $conn->connect_error);
}
?>