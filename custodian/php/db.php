<?php

$host = "localhost";
$dbname = "rentify";
$username = "root";
$password = "";

$mysqli = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Set the character set to utf8mb4
if (!$mysqli->set_charset("utf8mb4")) {
    die("Error setting charset: " . $mysqli->error);
}

return $mysqli;

?>
