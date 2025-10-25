<?php
require_once '../config/Database.php';
$db = new Database();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/style.css">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">

  <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px; border-radius: 10px;">
    <h3 class="text-center text-primary mb-4">Login</h3>

    <form action="index.php" method="POST">
      <div class="mb-3">
        <label for="email" class="form-label fw-semibold">Email</label>
        <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label fw-semibold">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
      </div>

      <button type="submit" name="login" class="btn btn-primary w-100 mb-3">Login</button>

      <p class="text-center mb-0">Don't have an account? 
        <a href="register.php" class="text-decoration-none fw-semibold">Register</a>
      </p>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $stmt = $db->pdo->prepare("SELECT * FROM users WHERE email=?");
  $stmt->execute([$email]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($user && password_verify($password, $user['password'])) {
    if ($user['verified']) {
      session_start();
      $_SESSION['user'] = $user;
      header("Location: dashboard.php");
      exit;
    } else {
      echo "<script>alert('Please verify your account first.'); window.location='verify.php?email=$email';</script>";
    }
  } else {
    echo "<script>alert('Incorrect email or password. Try again');</script>";
  }
}
?>
