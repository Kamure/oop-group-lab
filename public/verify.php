<?php
require_once __DIR__ . '/../config/database.php';
$db = new Database();
$email = $_GET['email'] ?? '';
?>

<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <title>Verify Account</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <div class="form-container">
    <h2>Enter OTP</h2>
    <form action="verify.php?email=<?php echo $email; ?>" method="POST">
      <input type="text" name="otp" placeholder="Enter your OTP" required><br></br>
      <button type="submit" name="verify">Verify</button>
    </form>
  </div>
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
