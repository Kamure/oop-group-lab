<?php
require_once __DIR__ . '/../config/Database.php';
$db = new Database();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="assets/style.css">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <style>
    body {
      background: linear-gradient(135deg, #007bff, #6610f2);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .card {
      width: 400px;
      border-radius: 15px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }
  </style>
</head>

<body>
  <div class="card p-4 bg-white">
    <h3 class="text-center mb-3 text-primary">Create an Account</h3>
    
    <form action="register.php" method="POST">
      <div class="mb-3">
        <label class="form-label">Full Name</label>
        <input type="text" name="name" class="form-control" placeholder="Enter your full name" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Email Address</label>
        <input type="email" name="email" class="form-control" placeholder="Enter email address" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Enter password" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Phone Number</label>
        <input type="tel" name="phone" id="phone" class="form-control" pattern="[0-9]{10}" maxlength="10" required
          oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10)"
          placeholder="Enter phone number">
        <div id="phone-error" class="text-danger small mt-1"></div>
      </div>

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

      <button type="submit" name="register" class="btn btn-primary w-100 mb-2">Register</button>
      
      <button type="button" class="btn btn-outline-secondary w-100" onclick="window.location.href='index.php'">
        Back to Login
      </button>
    </form>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
