<?php
require_once __DIR__ . '/../config/Database.php';

class Service {
  private $db;

  public function __construct() {
    $this->db = (new Database())->pdo;
  }


  public function getAllServices() {
    return $this->db->query("SELECT * FROM services")->fetchAll(PDO::FETCH_ASSOC);
  }

 
  public function addItem($title, $description, $price) {
    $stmt = $this->db->prepare("INSERT INTO services (title, description, price) VALUES (?, ?, ?)");
    return $stmt->execute([$title, $description, $price]);
  }
}
?>