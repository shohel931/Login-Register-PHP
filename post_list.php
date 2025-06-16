<?php
session_start();
include 'config.php';

// ইউজার লগইন চেক
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['id'];

$sql = "SELECT * FROM posts WHERE user_id = ? ORDER BY created_at DESC";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Posts</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<h2>My Posts</h2>

<?php if (mysqli_num_rows($result) > 0): ?>
    <ul>
        <?php while ($post = mysqli_fetch_assoc($result)): ?>
            <li>
                <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                <p><?php echo nl2br(htmlspecialchars($post['message'])); ?></p>
                <small>Posted on: <?php echo $post['created_at']; ?></small>
            </li>
        <?php endwhile; ?>
    </ul>
<?php else: ?>
    <p>No posts yet.</p>
<?php endif; ?>

<p><a href="dashboard.php">Back to Dashboard</a></p>
</body>
</html>

