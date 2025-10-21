<?php
require_once '../config/database.php';
$db = new Database();
?>

<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <div class="form-container">
    <h2>Login</h2>
    <form action="index.php" method="POST">
      <label for="email">Email:</label>
      <input type="email" name="email" placeholder="Email" required><br></br>

      <label for="password">Password:</label>
      <input type="password" name="password" placeholder="Password" required><br></br>

      <button type="submit" name="login">Login</button><br></br>
      <p>Don't have an account? <a href="register.php">Register</a></p>
    </form>
  </div>
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
    } else {
      echo "<script>alert('Please verify your account first.'); window.location='verify.php?email=$email';</script>";
    }
  } else {
    echo "<script>alert('Incorrect email or password. Try again');</script>";
  }
}
?>
