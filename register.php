<?php 
include 'config.php';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);


    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

    // if (mysqli_query($conn, $sql)){
    //     echo "<script>alert('Registration Successful!'); window.location.href='login.php'; </script>";
    //     exit;
    // } else {
    //     echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    // }

    
    // Check if usename already exists
    $check_username_sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $check_username_sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Username already exists! Please try with a different one.');</script>";
    } else {
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

        if (mysqli_query($conn, $sql)){
            echo "<script>alert('Registration Successful!'); window.location.href='login.php';</script>";
            exit;
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    }
     // Check if email already exists
    $check_email_sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $check_email_sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Email already exists! Please try with a different one.');</script>";
    } else {
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="shortcut icon" href="./img/favicon.jpg" type="image/x-icon">
    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <title>Register</title>
</head>
<body>
    

<div class="register_login_form">
    <h2>Register</h2>
    <form  method="POST">
       <div class="user">
            <i class="fa-solid fa-user"></i>
            <input type="text" name="username" placeholder="Username" required>
        </div>
        <div class="email">
            <i class="fa-solid fa-envelope"></i>
            <input type="email" name="email" placeholder="Email" required>
        </div>
        <div class="password">
            <i class="fa-solid fa-lock"></i>
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <button class="btn" type="submit" name="submit">Register</button>
        <div class="login_link">
            Already have an account? <a href="login.php">Login</a>
       </div>
    </form>
</div>




</body>
</html>