<?php 
include 'config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password, email)
            VALUES ('$username', '$email', '$password')";


   if( conn->query($sql) === TRUE) {
      echo "Registration Successful. <a href='login.php'>Login here</a>";
   } else{
     echo "Error:" . $conn->error;
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
        <label for="password">Password:</label>
        <input type="password" name="password" id="" placeholder="Enter your password" required>
        <button type="submit">Register</button>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </form>
</div>