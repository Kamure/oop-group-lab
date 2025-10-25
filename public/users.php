<?php
require_once __DIR__ . '/../classes/User.php';
require_once __DIR__ . '/../classes/Service.php';

$userObj = new User();
$serviceObj = new Service();

$users = $userObj->getAllUsers();
$services = $serviceObj->getAllServices();
?>
<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Users & Services Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold text-white" href="#">OOP PHP Lab</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
          <li class="nav-item"><a class="nav-link active" href="users.php">Users</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container-fluid py-4 fullscreen-container">
    <div class="row g-4">
      
      <!-- Users Table -->
      <div class="col-12 col-lg-6">
        <div class="card shadow border-0 h-100">
          <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Registered Users</h5>
          </div>
          <div class="card-body table-responsive">
            <?php if (count($users) > 0): ?>
              <table class="table table-hover align-middle">
                <thead class="table-dark">
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Verified</th>
                    <th>Registered</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($users as $index => $user): ?>
                    <tr>
                      <td><?= $index + 1 ?></td>
                      <td><?= htmlspecialchars($user['name']) ?></td>
                      <td><?= htmlspecialchars($user['email']) ?></td>
                      <td><?= htmlspecialchars($user['phone']) ?></td>
                      <td>
                        <?php if ($user['verified']): ?>
                          <span class="badge bg-success">Verified</span>
                        <?php else: ?>
                          <span class="badge bg-danger">Pending</span>
                        <?php endif; ?>
                      </td>
                      <td><?= date("M d, Y", strtotime($user['created_at'])) ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            <?php else: ?>
              <p class="text-muted">No users found.</p>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <!-- Services Table -->
      <div class="col-12 col-lg-6">
        <div class="card shadow border-0 h-100">
          <div class="card-header bg-success text-white">
            <h5 class="mb-0">Available Goods & Services</h5>
          </div>
          <div class="card-body table-responsive">
            <?php if (count($services) > 0): ?>
              <table class="table table-hover align-middle">
                <thead class="table-dark">
                  <tr>
                    <th>#</th>
                    <th>Service</th>
                    <th>Description</th>
                    <th>Price</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($services as $index => $service): ?>
                    <tr>
                      <td><?= $index + 1 ?></td>
                      <td><?= htmlspecialchars($service['title']) ?></td>
                      <td><?= htmlspecialchars($service['description']) ?></td>
                      <td>Ksh <?= htmlspecialchars($service['price']) ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            <?php else: ?>
              <p class="text-muted">No services available.</p>
            <?php endif; ?>
          </div>
        </div>
      </div>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
