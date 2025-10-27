<?php
require_once __DIR__ . '/../classes/Service.php';
$serviceObj = new Service();

if (isset($_POST['add'])) {
  $title = $_POST['title'];
  $description = $_POST['description'];
  $price = $_POST['price'];

  if ($serviceObj->addItem($title, $description, $price)) {
    echo "<script>alert('Service added successfully'); window.location='services.php';</script>";
  } else {
    echo "<script>alert('Failed to add service');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Service</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">
    <h2 class="mb-4 text-center text-primary">Add New Service</h2>
    <form method="POST" class="shadow p-4 bg-white rounded">
      <div class="mb-3">
        <label class="form-label fw-semibold">Title</label>
        <input type="text" name="title" class="form-control" placeholder="Service title" required>
      </div>
      <div class="mb-3">
        <label class="form-label fw-semibold">Description</label>
        <textarea name="description" class="form-control" placeholder="Service description" required></textarea>
      </div>
      <div class="mb-3">
        <label class="form-label fw-semibold">Price (Ksh)</label>
        <input type="number" name="price" class="form-control" placeholder="e.g. 1500" required>
      </div>
      <button type="submit" name="add" class="btn btn-success w-100">Add Service</button>
      <a href="services.php" class="btn btn-outline-secondary w-100 mt-2">Back to Services</a>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>