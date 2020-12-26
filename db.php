<?php
$servername = "localhost";
$username = "root"; //paste your own username
$password = ""; //paste your own password
$dbname = "test_database"; //paste your own database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
