<?php
$serverName = "localhost";
$user = "root";
$dataBaseName = "oficina 2.0";
$password = "";

$conn = new mysqli($serverName, $user, $password, $dataBaseName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
