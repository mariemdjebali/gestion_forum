<?php
require_once '../Controller/reclamationC.php';
require_once '../controller/typeC.php';

$typeReclamationCo = new TypeReclamationC();
$list = $typeReclamationCo->afficherTypeReclamation();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Dashboard - Type Reclamation Management</title>
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans|Nunito|Poppins" rel="stylesheet">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="style.css" rel="stylesheet">
  <style>
    .page-title {
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 20px;
    }
    .page-title h1 {
      font-size: 2rem;
      font-weight: bold;
      color: #444;
    }
    .btn-add {
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #007bff;
      color: white;
      border-radius: 30px;
      padding: 10px 20px;
      font-size: 1rem;
      text-decoration: none;
      margin: 20px auto;
      width: fit-content;
    }
    .btn-add:hover {
      background-color: #0056b3;
      text-decoration: none;
    }
    .table-container {
      display: flex;
      justify-content: center;
      margin-top: 30px;
    }
    .table {
      background-color: #f9f9f9;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .table th {
      background-color: #007bff;
      color: white;
      text-align: center;
    }
    .table td {
      text-align: center;
    }
    .breadcrumb {
      justify-content: center;
    }
  </style>
</head>
<body>
<header id="header" class="header fixed-top d-flex align-items-center">
  <div class="d-flex align-items-center justify-content-between">
    <a href="index.html" class="logo d-flex align-items-center">
      <img src="assets/img/logo.png" alt="">
      <span class="d-none d-lg-block">NiceAdmin</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div>
  <nav class="header-nav ms-auto"></nav>
</header>

<aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-item">
      <a class="nav-link" href="index.php">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="index.php">
        <i class="bi bi-menu-button-wide"></i>
        <span>Type Reclamation</span>
      </a>
    </li>
  </ul>
</aside>

<main id="main" class="main">
  <div class="pagetitle page-title">
    <h1>📚 Type Reclamation Management</h1>
  </div>
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <a href="ajouterTypeReclamation.php" class="btn btn-add">
              <i class="bi bi-plus-circle"></i> Ajouter un Type Reclamation
            </a>
            <div class="table-container">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">ID Type</th>
                    <th scope="col">Nom Type</th>
                    <th scope="col">ID Reclamation</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($list as $typeReclamation): ?>
                  <tr>
                    <td><?= $typeReclamation['id_type']; ?></td>
                    <td><?= $typeReclamation['nom_type']; ?></td>
                    <td><?= $typeReclamation['id_rec']; ?></td>
                    <td>
                      <form method="POST" action="modifierTypeReclamation.php" style="display: inline-block;">
                        <input type="hidden" name="id_type" value="<?= $typeReclamation['id_type']; ?>">
                        <button type="submit" style="background-color: #ffc107; color: white; padding: 1px 5px; border: none; border-radius: 5px; cursor: pointer; font-size: 14px;">Update</button>
                      </form>
                      <a href="supprimerTypeReclamation.php?id_type=<?= $typeReclamation['id_type']; ?>" style="background-color: #dc3545; color: white; padding: 5px 15px; text-decoration: none; border-radius: 5px; font-size: 14px;">Delete</a>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>
