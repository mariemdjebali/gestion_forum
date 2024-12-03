<?php
require_once '../controller/reclamationC.php';
require_once '../model/reclamation.php';

$error = "";
$reclamationC = new ReclamationC();
$reclamation = null;


if (isset($_POST['id_rec'])) {
    $id_rec = $_POST['id_rec'];

    
    $data = $reclamationC->searchreclamation($id_rec);
    if (!empty($data)) {
        $data = $data[0];
        $reclamation = new Reclamation(
            $data['id_rec'],
            $data['id_utilisateur'],
            $data['sujet'],
            $data['statut'],
            $data['date_rec'] 
        );
    } else {
        $error = "Réclamation introuvable.";
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    if (
        isset($_POST["id_utilisateur"]) &&
        isset($_POST["sujet"]) &&
        isset($_POST["statut"]) &&
        isset($_POST["date_rec"]) &&
        isset($_POST["id_rec"])
    ) {
        $reclamation = new Reclamation(
            $_POST["id_rec"],
            $_POST["id_utilisateur"],
            $_POST["sujet"],
            $_POST["statut"],
            $_POST["date_rec"]
        );
        $reclamationC->modifierreclamation($reclamation);
        header('Location: afficherliste.php'); 
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
  <title>📝 Modifier une Classe</title> 

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
        <span class="d-none d-lg-block">AdminPanel</span>
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
        <a class="nav-link" href="modifierreclamation.php?id_rec=<?php echo $id_rec; ?>">
          <i class="bi bi-pencil-square"></i>
          <span>Modifier une reclamation</span>
        </a>
      </li>
    </ul>
  </aside><!-- End Sidebar -->

  <!-- ======= Main Content ======= -->
  <main id="main" class="main">
    <div class="pagetitle">
      <h1 class="page-title">Modifier une reclamation 📝</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="afficherliste.php">Accueil</a></li>
          <li class="breadcrumb-item active">Modifier une reclamation</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="form-container">
        <div class="card form-card">
          <div class="card-body">
            <h5 class="card-title">Formulaire de modification d'une reclamation</h5>

    <?php if ($error): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>

    <?php if ($reclamation): ?>
        <form method="POST" action="modifierreclamation.php">
            <input type="hidden" name="id_rec" value="<?= $reclamation->getIdRec() ?>">
            <label for="id_utilisateur" class="form-label" >ID Utilisateur:</label>
            <input type="number" id="id_utilisateur" class="form-control" name="id_utilisateur" value="<?= htmlspecialchars($reclamation->getIdUtilisateur()) ?>" required><br>
            <label for="sujet" class="form-label">Sujet:</label>
            <input type="text" id="sujet"  class="form-control" name="sujet" value="<?= htmlspecialchars($reclamation->getSujet()) ?>" required><br>
            <label for="statut" class="form-label">Statut:</label>
            <select id="statut" class="form-control" name="statut" required>
                <option value="Pending" <?= $reclamation->getStatut() === 'Pending' ? 'selected' : '' ?>>Pending</option>
                <option value="Resolved" <?= $reclamation->getStatut() === 'Resolved' ? 'selected' : '' ?>>Resolved</option>
                <option value="Rejected" <?= $reclamation->getStatut() === 'Rejected' ? 'selected' : '' ?>>Rejected</option>
            </select><br>
            <label for="date_rec" class="form-label">Date:</label>
            <input type="date" id="date_rec" class="form-control" name="date_rec" 
                   value="<?= date('Y-m-d', strtotime($reclamation->getDateRec())) ?>" required><br>
            <button type="submit" name="update" class="btn btn-primary" onclick='test()'>Mettre à jour</button>
            
            <a href="afficherliste.php" class="btn btn-secondary">Annuler</a>
        </form>
    <?php else: ?>
        <p>Réclamation introuvable.</p>
    <?php endif; ?>
    <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>AdminPanel</span></strong>. Tous droits réservés.
    </div>
  </footer><!-- End Footer -->

  <!-- Vendor JS Files -->
  <script>
function test(){
  document.getElementById('reclamation-form').addEventListener('submit', function (e) {
    let isValid = true;
    const idUtilisateur = document.getElementById('id_utilisateur').value.trim();
    const sujet = document.getElementById('sujet').value.trim();
    const statut = document.getElementById('statut').value.trim();
    const dateRec = document.getElementById('date_rec').value.trim();
    const currentDate = new Date().toISOString().split('T')[0];

    // Réinitialisation des erreurs
    document.querySelectorAll('.error-message').forEach(msg => msg.innerText = '');

    // Validation
    if (!idUtilisateur || isNaN(idUtilisateur) || parseInt(idUtilisateur) <= 0) {
        document.getElementById('id_utilisateurError').innerText = "L'ID utilisateur doit être un entier positif.";
        isValid = false;
    }
    if (!sujet || sujet.length > 10) {
        document.getElementById('sujetError').innerText = "Le sujet est obligatoire et ne doit pas dépasser 10 caractères.";
        isValid = false;
    }
    if (!['Pending', 'Resolved', 'Rejected'].includes(statut)) {
        document.getElementById('statutError').innerText = "Le statut doit être 'Pending', 'Resolved' ou 'Rejected'.";
        isValid = false;
    }
    if (!dateRec || dateRec > currentDate) {
        alert("La date de réclamation doit être aujourd'hui ou avant.");
        isValid = false;
    }

    if (!isValid) {
        e.preventDefault(); // Empêche l'envoi du formulaire
    }
});

}

</script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/main.js"></script>

</body>
</html>
