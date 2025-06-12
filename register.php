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