<?php
session_start();
include 'config.php';

// ইউজার লগইন চেক
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$message = "";

// যদি ইউজার নিশ্চিত করে ডিলিট করতে
if (isset($_POST['confirm_delete'])) {
    $sql = "DELETE FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    if (mysqli_stmt_execute($stmt)) {
        session_destroy(); // সেশন শেষ
        header("Location: goodbye.php");
        exit();
    } else {
        $message = "<p style='color: red;'>Failed to delete account. Please try again.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Delete Account</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>

<div class="register_login_form">
    <h2>Delete Account</h2>
    <?php echo $message; ?>
    <p>Are you sure you want to delete your account permanently?</p>
    <form method="POST">
        <button class="btn" type="submit" name="confirm_delete" onclick="return confirm('Are you sure you want to delete your account permanently?')">Yes, Delete</button>
        <div class="login_link">
            <a href="dashboard.php">⬅ Cancel</a>
        </div>
    </form>
</div>

</body>
</html>
