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
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <div class="dashboard">
    <h2>Welcome, <?php echo htmlspecialchars($user['name']); ?>!</h2>
    <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
    <p>Phone: <?php echo htmlspecialchars($user['phone']); ?></p>
    <p>Your account is verified.</p><br></br>
    <button class="btn-logout" onclick="confirmLogout()">Logout</button>

    <script>
    function confirmLogout() {
     if (confirm("Are you sure you want to log out?")) {
      window.location.href = 'logout.php';
     }
    }
</script>


  </div>
</body>
</html>
