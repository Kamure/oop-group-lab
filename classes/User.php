<?php
require_once __DIR__ . '/../config/Database.php';

class User {
  private $db;

  public function __construct() {
    $this->db = (new Database())->pdo;
  }

  public function register($name, $email, $password, $phone, $otp) {
    $stmt = $this->db->prepare("INSERT INTO users (name, email, password, phone, otp) VALUES (?, ?, ?, ?, ?)");
    return $stmt->execute([
      $name,
      $email,
      password_hash($password, PASSWORD_DEFAULT),
      $phone,
      $otp
    ]);
  }

  public function verifyOTP($email, $otp) {
    $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ? AND otp = ?");
    $stmt->execute([$email, $otp]);
    if ($stmt->rowCount() > 0) {
      $update = $this->db->prepare("UPDATE users SET verified = 1 WHERE email = ?");
      $update->execute([$email]);
      return true;
    }
    return false;
  }

  public function getAllUsers() {
    return $this->db->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
  }
}
?>