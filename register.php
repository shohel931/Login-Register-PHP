<?php 
include 'config.php';

if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // ✅ Username check
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        echo "<p class='title_tage'>Username already exists!</p>";
    } else {
        // ✅ Email check
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "<p class='title_tage'>Email already exists!</p>";
        } else {
            // ✅ All clear: Insert user
            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $password);
            if ($stmt->execute()) {
                echo "<p class='title_tage'>Registration Successful!</p>";
            } else {
                echo "<p class='title_tage'>Error: " . $stmt->error . "</p>";
            }
        }
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