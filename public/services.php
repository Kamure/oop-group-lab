<?php
require_once __DIR__ . '/../classes/Service.php';

$serviceObj = new Service();
$services = $serviceObj->getAllServices();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel Services</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/style.css">
</head>
<body class="bg-light">

  <div class="container py-5">
    <h1 class="text-center mb-5">Available Services</h1>

    <div class="row">
      <?php if (!empty($services)): ?>
        <?php foreach ($services as $service): ?>
          <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
              <div class="card-body">
                <h4 class="card-title">
                  <?php echo htmlspecialchars($service['title']); ?>
                </h4>
                <p class="card-text text-muted">
                  <?php echo htmlspecialchars($service['description']); ?>
                </p>
                <p class="fw-bold">
                  Price: Ksh <?php echo htmlspecialchars($service['price']); ?>
                </p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p class="text-center text-danger">No services found.</p>
      <?php endif; ?>
    </div>
  </div>

</body>
</html>
