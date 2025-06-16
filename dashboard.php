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


<?php
session_start();
include 'config.php';

// ইউজার লগইন চেক
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['id'];
$username = $_SESSION['username'];

// পোস্ট সাবমিট হলে হ্যান্ডেল করব
if (isset($_POST['submit'])) {
    $title = trim($_POST['title']);
    $message = trim($_POST['message']);
    $error = '';
    $success = '';

    if ($title == '' || $message == '') {
        $error = "All fields are required!";
    } else {
        $sql = "INSERT INTO posts (user_id, title, message) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "iss", $user_id, $title, $message);

        if (mysqli_stmt_execute($stmt)) {
            $success = "Post created successfully!";
        } else {
            $error = "Database error: " . mysqli_error($conn);
        }
    }
}

// ইউজারের পোস্টগুলো নিয়ে আসব
$sql = "SELECT * FROM posts WHERE user_id = ? ORDER BY created_at DESC";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="./css/style.css" />
</head>
<body>

<div class="main_dashboard">

    <h2>Welcome, <?php echo htmlspecialchars($username); ?></h2>

    <!-- পোস্ট তৈরি করার ফর্ম -->
    <div class="post_form">
        <h3>Create a New Post</h3>

        <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <?php if (!empty($success)) echo "<p style='color:green;'>$success</p>"; ?>

        <form method="POST" action="">
            <div>
                <label>Title:</label><br />
                <input type="text" name="title" required />
            </div>
            <div>
                <label>Message:</label><br />
                <textarea name="message" rows="5" required></textarea>
            </div>
            <button type="submit" name="submit">Post</button>
        </form>
    </div>

    <!-- পোস্ট লিস্ট দেখানো -->
    <div class="post_list">
        <h3>Your Posts</h3>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <ul>
                <?php while ($post = mysqli_fetch_assoc($result)): ?>
                    <li>
                        <h4><?php echo htmlspecialchars($post['title']); ?></h4>
                        <p><?php echo nl2br(htmlspecialchars($post['message'])); ?></p>
                        <small>Posted on: <?php echo $post['created_at']; ?></small>
                    </li>
                    <hr>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p>No posts yet.</p>
        <?php endif; ?>
    </div>

</div>

</body>
</html>
