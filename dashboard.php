<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>

<div class="main_dashboard">
    <!-- Sidebar -->
    <div class="sidebar">
        <h2><i class="fas fa-tachometer-alt"></i> Dashboard</h2>
        <ul>
            <li><a href="dashboard.php"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="profile.php"><i class="fas fa-user"></i> Profile</a></li>
            <li><a href="settings.php"><i class="fas fa-cog"></i> Settings</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="dashboard_header">
            <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
            <p>This is your home dashboard where you can manage your account and settings.</p>
        </div>

        <div class="dashboard_cards">
            <div class="card">
                <h3><i class="fas fa-user"></i> Profile</h3>
                <p>View and update your personal profile information.</p>
                <a href="profile.php" class="btn">Go to Profile</a>
            </div>
            <div class="card">
                <h3><i class="fas fa-cog"></i> Settings</h3>
                <p>Manage your account settings and preferences.</p>
                <a href="settings.php" class="btn">Open Settings</a>
            </div>
            <div class="card">
                <h3><i class="fas fa-sign-out-alt"></i> Logout</h3>
                <p>Click below to safely log out from your account.</p>
                <a href="logout.php" class="btn">Logout</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
