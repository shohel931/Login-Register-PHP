<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <title>Dashboard</title>
</head>
<body>


<div class="main_dashboard">
  <div class="sub_dashboard_a">
    <div class="sidebar">
        <div class="title_dashboard">
            <h2><i class="fas fa-tachometer-alt"></i> Dashboard</h2>
        </div>
      <ul>
        <li><a href="dashboard.php"><span><i class="fas fa-home"></i></span> Home</a></li>
        <li><a href="profile.php"><span><i class="fas fa-user"></i></span> Profile</a></li>
        <li><a href="settings.php"><span><i class="fas fa-cog"></i></span> Settings</a></li>
        <li><a href="logout.php"><span><i class="fas fa-sign-out-alt"></i></span> Logout</a></li>
      </ul>
    </div>
  </div>


  <div class="sub_dashboard_b">
    <div class="dashboard_header">
      <h1>Dashboard</h1>
      <div class="user_info">
        <span> Welcome, <i class="fa-solid fa-circle-user"></i><?php echo $_SESSION['user'] ?></span>
      </div>
    </div>
    <div class="dashboard_content">
      <div class="card">
        <h2>Card Title 1</h2>
        <p>Some content for the first card.</p>
      </div>
      <div class="card">
        <h2>Card Title 2</h2>
        <p>Some content for the second card.</p>
      </div>
      <div class="card">
        <h2>Card Title 3</h2>
        <p>Some content for the third card.</p>
      </div>
    </div>
  </div>
</div>



</body>
</html>