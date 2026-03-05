<?php 

    session_start();
    require_once 'config/db.php';
    if (!isset($_SESSION['admin_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location: signin.php');
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { min-height: 100vh; display: flex; }
    .sidebar { width: 220px; background: #212529; color: white; }
    .sidebar a { color: white; text-decoration: none; display: block; padding: 10px 20px; }
    .sidebar a:hover { background: #343a40; }
    .content { flex: 1; padding: 20px; }
  </style>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar d-flex flex-column">
    <h3 class="text-center py-3">Admin Panel</h3>
    <a href="#">Dashboard</a>
    <a href="#">Manage Products</a>
    <a href="#">Manage CPU/GPU/Brand</a>
    <a href="#">Manage Users</a>
    <a href="#">Price Updates</a>
    <a href="#">Reviews</a>
    <a href="logout.php">Logout</a>
  </div>

  <!-- Main Content -->
  <div class="content">
    <h2>Dashboard Overview</h2>

    <div class="row mt-4">
      <div class="col-md-3 mb-3">
        <div class="card text-center bg-primary text-white">
          <div class="card-body">
            <h5 class="card-title">Users</h5>
            <p class="card-text fs-3">120</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="card text-center bg-success text-white">
          <div class="card-body">
            <h5 class="card-title">Products</h5>
            <p class="card-text fs-3">85</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="card text-center bg-warning text-dark">
          <div class="card-body">
            <h5 class="card-title">Price Alerts</h5>
            <p class="card-text fs-3">5</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="card text-center bg-danger text-white">
          <div class="card-body">
            <h5 class="card-title">Pending Reviews</h5>
            <p class="card-text fs-3">8</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Manage Products Example -->
    <div class="mt-5">
      <h4>Product List</h4>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Brand</th>
            <th>Model</th>
            <th>Type</th>
            <th>Release Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Dell</td>
            <td>XPS 15</td>
            <td>Laptop</td>
            <td>2026-01-10</td>
            <td>
              <button class="btn btn-sm btn-primary">Edit</button>
              <button class="btn btn-sm btn-danger">Delete</button>
            </td>
          </tr>
          <!-- More products -->
        </tbody>
      </table>
      <button class="btn btn-success">Add New Product</button>
    </div>
  </div>
</body>
</html>