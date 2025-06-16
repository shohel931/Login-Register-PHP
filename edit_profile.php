<?php
session_start();
include 'config.php';

// যদি ইউজার লগ ইন না থাকে
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$message = "";
$current_username = $_SESSION['username'];

// ইউজারের বর্তমান তথ্য লোড করো
$sql = "SELECT username, email FROM users WHERE username = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $current_username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

// ফর্ম সাবমিট করলে
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_username = trim($_POST['username']);
    $new_email = trim($_POST['email']);

    // Username বা Email অন্য কেউ ব্যবহার করছে কিনা চেক
    $check_sql = "SELECT * FROM users WHERE (username = ? OR email = ?) AND username != ?";
    $check_stmt = mysqli_prepare($conn, $check_sql);
    mysqli_stmt_bind_param($check_stmt, "sss", $new_username, $new_email, $current_username);
    mysqli_stmt_execute($check_stmt);
    $check_result = mysqli_stmt_get_result($check_stmt);

    if (mysqli_num_rows($check_result) > 0) {
        $message = "<p style='color:red;'>Username or Email already taken!</p>";
    } else {
        // আপডেট করো
        $update_sql = "UPDATE users SET username = ?, email = ? WHERE username = ?";
        $update_stmt = mysqli_prepare($conn, $update_sql);
        mysqli_stmt_bind_param($update_stmt, "sss", $new_username, $new_email, $current_username);
        if (mysqli_stmt_execute($update_stmt)) {
            $_SESSION['username'] = $new_username;
            $message = "<p style='color:green;'>Profile updated successfully!</p>";
            $current_username = $new_username;
            $user['username'] = $new_username;
            $user['email'] = $new_email;
        } else {
            $message = "<p style='color:red;'>Failed to update profile.</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>

<div class="register_login_form">
    <h2>Edit Profile</h2>
    <?php echo $message; ?>
    <form method="POST">
        <div class="user">
            <i class="fa-solid fa-user"></i>
            <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
        </div>
        <div class="email">
            <i class="fa-solid fa-envelope"></i>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>
        <button class="btn" type="submit">Update Profile</button>
        <div class="login_link">
            <a href="dashboard.php">⬅ Back to Dashboard</a>
        </div>
    </form>
</div>

</body>
</html>
