<?php 


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <title>Login/Register</title>
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
        <div class="number">
            <i class="fa-solid fa-phone"></i>
            <input type="tel" name="phone" placeholder="Phone Number" required>
        </div>
        <div class="password">
            <i class="fa-solid fa-lock"></i>
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <div class="confirm_password">
            <i class="fa-solid fa-lock"></i>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        </div>
        <button class="btn" type="submit">Register</button>
        <div class="login_link">
            Already have an account? <a href="login.php">Login</a>
       </div>
    </form>
</div>




</body>
</html>