<?php

$servername = "localhost";
$username = "root";
$password = "";

// diubah tergantung setup database
$database = "perpus";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// buat testing
// echo "Connected successfully";