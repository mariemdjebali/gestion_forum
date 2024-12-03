<?php
require_once '../controller/typeC.php';
require_once '../model/type.php';

$error = "";
$typeReclamationC = new typeReclamationC();
$typeReclamation = null;

if (isset($_POST['id_type'])) {
    $id_type = $_POST['id_type'];

    $data = $typeReclamationC->searchtypeReclamation($id_type);
    if (!empty($data)) {
        $data = $data[0];
        $typeReclamation = new typeReclamation(
            $data['id_type'],
            $data['nom_type'],
            $data['id_rec']
        );
    } else {
        $error = "Type de réclamation introuvable.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    if (
        isset($_POST["nom_type"]) &&
        isset($_POST["id_rec"]) &&
        isset($_POST["id_type"])
    ) {
        $typeReclamation = new typeReclamation(
            $_POST["id_type"],
            $_POST["nom_type"],
            $_POST["id_rec"]
        );
        $typeReclamationC->modifierTypeReclamation($typeReclamation);
        header('Location: afficherTypeReclamation.php'); 
        exit();
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>📝 Modifier un Type de Réclamation</title> 

  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Vendor CSS Files -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="vendor/boxicons/css/boxicons.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="style.css" rel="stylesheet">

  <!-- Custom Styles -->
  <style>
    .page-title {
      text-align: center;
      font-size: 2rem;
      margin-bottom: 30px;
      font-weight: bold;
    }
    .form-container {
      display: flex;
      justify-content: center;
    }
    .form-card {
      width: 100%;
      max-width: 600px;
    }
    .form-container .card-body {
      padding: 30px;
    }
  </style>
</head>
<body>
<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">Smart Education</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="modifierTypeReclamation.php?id_type=<?php echo $id_type; ?>">
          <i class="bi bi-pencil-square"></i>
          <span>Modifier un Type de Réclamation</span>
        </a>
      </li>
    </ul>
  </aside><!-- End Sidebar -->

  <!-- ======= Main Content ======= -->
  <main id="main" class="main">
    <div class="pagetitle">
      <h1 class="page-title">Modifier un Type de Réclamation 📝</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="typeReclamationTypeReclamation.php">Accueil</a></li>
          <li class="breadcrumb-item active">Modifier un Type de Réclamation</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="form-container">
        <div class="card form-card">
          <div class="card-body">
            <h5 class="card-title">Formulaire de modification d'un Type de Réclamation</h5>

            <?php if ($error): ?>
                <p style="color: red;"><?= $error ?></p>
            <?php endif; ?>

            <?php if ($typeReclamation): ?>
                <form method="POST" action="modifierTypeReclamation.php">
                    <input type="hidden" name="id_type" value="<?= $typeReclamation->getIdType() ?>">
                    <label for="nom_type" class="form-label">Nom du Type:</label>
                    <input type="text" id="nom_type" class="form-control" name="nom_type" 
                           value="<?= htmlspecialchars($typeReclamation->getNomType()) ?>"><br>
                    <label for="id_rec" class="form-label">ID Réclamation:</label>
                    <input type="number" id="id_rec" class="form-control" name="id_rec" 
                           value="<?= htmlspecialchars($typeReclamation->getIdRec()) ?>" ><br>
                    <button type="submit" name="update" class="btn btn-primary">Mettre à jour</button>
                    <a href="afficherTypeReclamation.php" class="btn btn-secondary">Annuler</a>
                </form>
            <?php else: ?>
                <p>Type de réclamation introuvable.</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>
  </main>
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Smart Education</span></strong>. Tous droits réservés.
    </div>
  </footer><!-- End Footer -->

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/main.js"></script>
</body>
</html>
