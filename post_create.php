<?php
session_start();
include 'config.php';

// ইউজার লগইন আছে কিনা চেক
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['submit'])) {
    $user_id = $_SESSION['id'];
    $title = trim($_POST['title']);
    $message = trim($_POST['message']);

    if ($title == '' || $message == '') {
        $error = "All fields are required!";
    } else {
        $sql = "INSERT INTO posts (user_id, title, message) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "iss", $user_id, $title, $message);

        if (mysqli_stmt_execute($stmt)) {
            $success = "Post created successfully!";
        } else {
            $error = "Database error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Post</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<div class="post_form_container">
    <h2>Create a Post</h2>

    <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
    <?php if (!empty($success)) echo "<p class='success'>$success</p>"; ?>

    <form method="POST">
        <div>
            <label>Title:</label><br>
            <input type="text" name="title" required>
        </div>
        <div>
            <label>Message:</label><br>
            <textarea name="message" rows="5" required></textarea>
        </div>
        <button type="submit" name="submit">Post</button>
    </form>

    <p><a href="dashboard.php">Back to Dashboard</a></p>
</div>
</body>
</html>
