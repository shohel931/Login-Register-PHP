<?php
session_start();
include 'config.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Profile</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

<div class="profile_container">
    <h2>👤 Profile</h2>
    <div class="sub_profile">
    <p><strong>Username:</strong> <?php echo $user['username']; ?></p>
    <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
    <p><strong>Join Date:</strong> <?php echo date('d M Y', strtotime($user['created_at'] ?? 'now')); ?></p>
</div>
    <div class="actions">
        <a href="edit_profile.php">✏️ Edit Profile</a> |
        <a href="change_password.php">🔒 Change Password</a> | <br>
        <a href="dashboard.php">🏠 Back to Dashboard</a>
    </div>
</div>

</body>
</html>
