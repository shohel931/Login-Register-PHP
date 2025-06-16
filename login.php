<?php 
include 'config.php';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['username'] = $row['username'];
            $_SESSION['id'] = $row['id'];
            header("Location: dashboard.php");
            exit();
        } else {
            echo "<p class='wrong_pass'>Incorrect Password!</p>";
        }
    } else {
        echo "<p class='wrong_pass'>Username not found!</p>";
    }
}

mysqli_close($conn);





?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="shortcut icon" href="./img/favicon.jpg" type="image/x-icon">
    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <title>Login</title>
</head>
<body>
    

<div class="register_login_form">
    <h2>Login</h2>
    <form  method="POST">
       <div class="user">
            <i class="fa-solid fa-user"></i>
            <input type="text" name="username" placeholder="Username" required>
        </div>
        <div class="password">
            <i class="fa-solid fa-lock"></i>
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <button class="btn" type="submit" name="submit">Login</button>
        <div class="login_link">
            Don't have an account? <a href="register.php">Register</a>
       </div>
    </form>
</div>




</body>
</html>