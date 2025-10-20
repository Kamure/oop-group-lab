<?php
require_once __DIR__ . '/../config/Database.php';
$db = new Database();
?>

<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="form-container">
    <h2>Create Account</h2>
    <form action="register.php" method="POST">
      <input type="text" name="name" placeholder="Full Name" required>
      <input type="email" name="email" placeholder="Email Address" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="text" name="phone" placeholder="Phone Number" required>
      <button type="submit" name="register">Register</button>
    </form>
  </div>
</body>
</html>

<?php
if (isset($_POST['register'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $phone = $_POST['phone'];
  $otp = rand(100000, 999999); 

  $query = "INSERT INTO users (name, email, password, phone, otp) VALUES (?, ?, ?, ?, ?)";
  $stmt = $db->pdo->prepare($query);
  $stmt->execute([$name, $email, $password, $phone, $otp]);

  echo "<script>alert('Registration successful! Your OTP is $otp (demo only).'); 
  window.location='verify.php?email=$email';</script>";
}
?>
