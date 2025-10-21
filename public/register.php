<?php
require_once __DIR__ . '/../config/Database.php';
$db = new Database();
?>

<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <div class="form-container">
    <h2>Create an Account</h2>
    <form action="register.php" method="POST">
      <input type="text" name="name" placeholder="Full Name" required><br></br>
      <input type="email" name="email" placeholder="Email Address" required><br></br>
      <input type="password" name="password" placeholder="Password" required><br></br>
      <input type="tel" name="phone" id="phone" pattern="[0-9]{10}" maxlength="10" required 
       oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10)" 
       placeholder="Enter phone number"><br></br>

      <script>
      document.getElementById('phone').addEventListener('input', function() {
        const msg = document.getElementById('phone-error');
        if (this.value.length < 10) {
          msg.textContent = "Phone number must be 10 digits.";
        } else {
          msg.textContent = "";
       }
      });
      </script>

      <p id="phone-error" style="color: red; font-size: 13px;"></p>

      <button type="submit" name="register">Register</button><br></br>
      <button type="button" class="btn-secondary" onclick="window.location.href='index.php'">Back to Login</button>
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
  try {
      $stmt = $db->pdo->prepare($query);
      $stmt->execute([$name, $email, $password, $phone, $otp]);

    echo "<script>alert('Registration successful! Your OTP is $otp'); 
    window.location='verify.php?email=$email';</script>";
  } catch (PDOException $e) {
    echo "<script>alert('Registration failed: " . $e->getMessage() . "');</script>";
  }
} 
  ?>
