<?php
require_once '../model/reclamation.php';
require_once '../Controller/reclamationC.php';

$error = "";

$reclamation = null;

$reclamationC = new reclamationC();

if (
    isset($_POST["id_utilisateur"]) &&
    isset($_POST["sujet"]) && 
    isset($_POST["statut"]) &&
    isset($_POST["date_rec"])
) {
    if (
        !empty($_POST['id_utilisateur']) &&
        !empty($_POST["sujet"]) && 
        !empty($_POST["statut"]) &&
        !empty($_POST["date_rec"])
    ) {
        
        $reclamation = new reclamation(
            null, 
            $_POST['id_utilisateur'],
            $_POST['sujet'],
            $_POST['statut'],
            $_POST['date_rec']
        );

        
        $reclamationC->ajouterreclamation($reclamation);

        
        header('Location:afficherliste.php');
        exit(); 
    } else {
        $error = "Informations manquantes";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>📝 Ajouter une reclamation</title> 

  <!-- Vendor CSS Files -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="vendor/simple-datatables/style.css" rel="stylesheet">

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

 <!-- ======= Header ======= -->
 <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">NiceAdmin</span>
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
        <a class="nav-link" href="ajouterreclamation.php">
          <i class="bi bi-plus-circle"></i>
          <span>Ajouter une reclamation</span>
        </a>
      </li>
    </ul>
  </aside><!-- End Sidebar -->

  <!-- ======= Main Content ======= -->
  <main id="main" class="main">
    <div class="pagetitle">
      <h1 class="page-title">Ajouter une Nouvelle reclamation 📝</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="afficherliste.php">Accueil</a></li>
          <li class="breadcrumb-item active">Ajouter  une reclamation</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="form-container">
        <div class="card form-card">
          <div class="card-body">
            <h5 class="card-title">Formulaire d'ajout d'une reclamation</h5>

<div class="reclamation-form">
    <form id="reclamation-form" action="" method="POST" >
        <div  class="mb-3">
            <label for="id_utilisateur" class="form-label">ID Utilisateur :</label>
            <input type="number" class="form-control" id="id_utilisateur" name="id_utilisateur" value="" >
            <span id="id_utilisateurError" class="error-message"></span>
        </div>
        <div class="mb-3">
            <label for="sujet" class="form-label">Sujet :</label>
            <input type="text"  class="form-control" id="sujet" name="sujet" value="" >
            <span id="sujetError" class="error-message"></span>
        </div>
        <div class="mb-3">
            <label for="statut" class="form-label">Statut :</label>
            <select id="statut" class="form-control" name="statut" >
                <option value="Pending">Pending</option>
                <option value="Resolved">Resolved</option>
                <option value="Rejected">Rejected</option>
            </select>
            <span id="statutError" class="error-message"></span>
        </div>
        <div class="mb-3">
            <label for="date_rec" class="form-label" >Date de Réclamation :</label>
            <input type="date" class="form-control" id="date_rec" name="date_rec" value="<?php echo date('Y-m-d'); ?>" >
        </div>
        <div class="mb-3">
            <input type="submit" value="Envoyer" class="btn btn-primary" onclick='test()'>
      
            <a href="afficherliste.php" class="btn btn-secondary">Annuler</a>

            



            
        </div>
    </form>
</div>

<script src="script.js"></script>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
  </footer><!-- End Footer -->

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/main.js"></script>


</body>
</html>
