<?php 
include 'config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];



        if ($password === $cpassword) {
        echo "Password & Confirm Password mismatched!";
    } else {
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (username, email, number, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $number, $hashed_pass);

    }
}


?>


<div class="register">
    <h2>Register</h2>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" id="" placeholder="Enter your username" required>
        <label for="email">Email:</label>
        <input type="email" name="email" id="" placeholder="Enter your email" required>
        <label for="number">Phone Number:</label>
        <input type="number" name="number" id="" placeholder="Enter your phone number" required>
        <label for="password">Password:</label>
        <input type="password" name="password" id="" placeholder="Enter your password" required>
        <label for="cpassword">Confirm Password:</label>
        <input type="password" name="cpassword" id="" placeholder="Confirm your password" required>
        <button type="submit">Register</button>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </form>
</div>