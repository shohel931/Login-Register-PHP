<?php
session_start();
include 'config.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

// ইউজারের ইনফো নিয়ে আসা
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
    <meta charset="UTF-8">
    <title>Settings</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>

<div class="register_login_form">
    <h2>Account Settings</h2>

    <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>

    <div class="setting_links" style="margin-top: 20px;">
        <a href="edit_profile.php" class="btn"><i class="fas fa-user-edit"></i> Edit Profile</a>
        <a href="change_password.php" class="btn"><i class="fas fa-key"></i> Change Password</a>
        <a href="delete_account.php" class="btn" onclick="return confirm('Are you sure you want to delete your account?');"><i class="fas fa-user-times"></i> Delete Account</a>
        <a href="dashboard.php" class="btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
    </div>
</div>

</body>
</html>
