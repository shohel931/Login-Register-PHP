<?php 
$host = 'localhost';
$db = 'user_db';
$username = 'root';
$password = '';

$conn = mysqli_connect($host, $username, $password, $db);

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

?>