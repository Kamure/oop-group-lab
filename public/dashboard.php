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
  <title>User Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="assets/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(135deg, #6f42c1, #0d6efd);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 0;
    }
    .card {
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.2);
      max-width: 500px;
      width: 100%;
    }
  </style>
</head>

<body>
  <div class="card p-4 bg-white text-center">
    <h3 class="text-primary mb-3">
      Welcome, <?php echo htmlspecialchars($user['name']); ?>!
    </h3>

    <div class="mb-3 text-start">
      <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
      <p><strong>Phone:</strong> <?php echo htmlspecialchars($user['phone']); ?></p>
      <p class="text-success"><strong>Status:</strong> Verified</p>
    </div>

    <div class="d-grid gap-2">
      <a href="users.php" class="btn btn-outline-primary">View All Users</a>
      <a href="services.php" class="btn btn-outline-success">View Services</a>
      <button class="btn btn-danger" onclick="confirmLogout()">Logout</button>
    </div>
  </div>

  <script>
    function confirmLogout() {
      if (confirm("Are you sure you want to log out?")) {
        window.location.href = 'logout.php';
      }
    }
  </script>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
