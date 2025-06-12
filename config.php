<?php  
$host = 'localhost';
$db = 'test-work';
$users = 'root';
$pass = '';
$conn = new mysqli($host, $users, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed:" . $conn->contact_error);
} 

?>