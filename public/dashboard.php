<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("Location: index.php");
  exit;
}
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="dashboard">
    <h2>Welcome, <?php echo htmlspecialchars($user['name']); ?>!</h2>
    <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
    <p>Phone: <?php echo htmlspecialchars($user['phone']); ?></p>
    <a href="logout.php">Logout</a>
  </div>
</body>
</html>
