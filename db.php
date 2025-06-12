<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
echo "<h1>Welcome, " . $_SESSION['user'] . "</h1>";
?>
<a href="logout.php">Logout</a>
