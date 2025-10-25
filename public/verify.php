<?php
require_once __DIR__ . '/../config/Database.php';
$db = new Database();
$email = $_GET['email'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Verify Account</title>
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
    .verify-card {
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.2);
      padding: 2rem;
      width: 100%;
      max-width: 400px;
      text-align: center;
    }
  </style>
</head>

<body>
  <div class="verify-card">
    <h3 class="text-primary mb-3">Verify Your Account</h3>
    <p class="text-muted">Enter the 6-digit OTP sent to your email.</p>

    <form action="verify.php?email=<?php echo htmlspecialchars($email); ?>" method="POST">
      <div class="mb-3">
        <input type="text" name="otp" class="form-control text-center" placeholder="Enter your OTP" maxlength="6" required>
      </div>

      <button type="submit" name="verify" class="btn btn-primary w-100">Verify</button>
      <a href="index.php" class="btn btn-outline-secondary w-100 mt-2">Back to Login</a>
    </form>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
if (isset($_POST['verify'])) {
  $otp = $_POST['otp'];
  $query = "SELECT * FROM users WHERE email=? AND otp=?";
  $stmt = $db->pdo->prepare($query);
  $stmt->execute([$email, $otp]);

  if ($stmt->rowCount() > 0) {
    $update = "UPDATE users SET verified=1 WHERE email=?";
    $db->pdo->prepare($update)->execute([$email]);
    echo "<script>alert('Account verified! Proceed to login.'); window.location='index.php';</script>";
  } else {
    echo "<script>alert('Invalid OTP. Try again.');</script>";
  }
}
?>
