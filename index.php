<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home - MyApp</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="shortcut icon" href="./img/favicon.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>

<div class="homepage_container">
    <header class="header">
        <div class="logo">
            <h2><i class="fas fa-code"></i> MyApp</h2>
        </div>
        <nav class="navbar">
            <ul>
                <li><a href="index.php">Home</a></li>
                <?php if (isset($_SESSION['username'])): ?>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main class="main_content">
        <h1>Welcome to MyApp</h1>
        <p>A simple user login and registration system using PHP & MySQL</p>
        <?php if (!isset($_SESSION['username'])): ?>
            <a class="btn" href="register.php">Get Started</a>
        <?php else: ?>
            <a class="btn" href="dashboard.php">Go to Dashboard</a>
        <?php endif; ?>
    </main>
</div>

</body>
</html>
