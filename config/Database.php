<?php
class Database {
  private $host = 'localhost';
  private $db = 'oop_lab';
  private $user = 'root';
  private $pass = '';
  public $pdo;

  public function __construct() {
    try {
      $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->pass);
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      die("Connection has failed: " . $e->getMessage());
    }
  }
}
?>