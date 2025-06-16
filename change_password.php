<?php
session_start();
include 'config.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$message = "";

// Form submit হলে:
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $current_password = $_POST['current_password'];
    $new_password     = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // ইউজারের বর্তমান পাসওয়ার্ড খোঁজা
    $sql = "SELECT password FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if ($row && password_verify($current_password, $row['password'])) {
        if ($new_password === $confirm_password) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // পাসওয়ার্ড আপডেট
            $update_sql = "UPDATE users SET password = ? WHERE username = ?";
            $update_stmt = mysqli_prepare($conn, $update_sql);
            mysqli_stmt_bind_param($update_stmt, "ss", $hashed_password, $username);
            mysqli_stmt_execute($update_stmt);

            $message = "<p style='color:green;'>Password changed successfully!</p>";
        } else {
            $message = "<p style='color:red;'>New passwords do not match.</p>";
        }
    } else {
        $message = "<p style='color:red;'>Current password is incorrect.</p>";
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

<div class="register_login_form">
    <h2>Change Password</h2>
    <?php echo $message; ?>
    <form method="POST">
        <div class="password">
            <i class="fa-solid fa-lock"></i>
            <input type="password" name="current_password" placeholder="Current Password" required>
        </div>
        <div class="password">
            <i class="fa-solid fa-lock"></i>
            <input type="password" name="new_password" placeholder="New Password" required>
        </div>
        <div class="password">
            <i class="fa-solid fa-lock"></i>
            <input type="password" name="confirm_password" placeholder="Confirm New Password" required>
        </div>
        <button class="btn" type="submit">Update Password</button>
        <div class="login_link">
            <a href="dashboard.php">⬅ Back to Dashboard</a>
        </div>
    </form>
</div>

</body>
</html>
