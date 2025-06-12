<?php 
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            $_SESSION['user'] = $row['username'];
            header("Location: db.php");
        } else {
            echo "Wrong password!";
        }
    } else {
        echo "User not found!";
    }
}


?>

<div class="Login">
    <h2>Login</h2>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" id="" placeholder="Enter your username" required>
        <label for="password">Password:</label>
        <input type="password" name="password" id="" placeholder="Enter your password" required>
        <input type="button" value="Login" onclick="this.form.submit()">
        <p>Don't have an account? <a href="register.php">Register</a></p>
    </form>
</div>