<?php  
$host = 'localhost';
$db = 'my_users';
$users = 'root';
$pass = '';
$conn = new mysqli($host, $users, $pass, $db);
if ($conn->connect error) {
    die("Connection failed:" . $conn->contact_error);
} 

?>