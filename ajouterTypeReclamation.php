<?php
require_once '../model/type.php';
require_once '../Controller/typeC.php';
require_once '../Controller/reclamationC.php';

$error = "";

$typeReclamation = null;

$typeReclamationC = new TypeReclamationC();

if (
    isset($_POST["nom_type"]) &&
    isset($_POST["id_rec"])
) {
    if (
        !empty($_POST['nom_type']) &&
        !empty($_POST["id_rec"])
    ) {
        $typeReclamation = new TypeReclamation(
            null, 
            $_POST['nom_type'],
            $_POST['id_rec']
        );

        $typeReclamationC->ajouterTypeReclamation($typeReclamation);

        header('Location:afficherTypeReclamation.php');
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
  <title>📝 Ajouter un Type de Réclamation</title> 

  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="style.css" rel="stylesheet">

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
    .error-message {
      color: red;
      font-size: 0.9rem;
    }
  </style>
</head>
<body>

<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">NiceAdmin</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
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
            <a class="nav-link" href="ajoutertypereclamation.php">
                <i class="bi bi-plus-circle"></i>
                <span>Ajouter un Type de Réclamation</span>
            </a>
        </li>
    </ul>
</aside>

<main id="main" class="main">
    <div class="pagetitle">
        <h1 class="page-title">Ajouter un Nouveau Type de Réclamation 📝</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="afficherTypeReclamation.php">Accueil</a></li>
                <li class="breadcrumb-item active">Ajouter un Type de Réclamation</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="form-container">
            <div class="card form-card">
                <div class="card-body">
                    <h5 class="card-title">Formulaire d'ajout d'un Type de Réclamation</h5>
                    <form id="reclamation-form" action="" method="POST">
                        <div class="mb-3">
                            <label for="nom_type" class="form-label">Nom du Type :</label>
                            <input type="text" class="form-control" id="nom_type" name="nom_type" value="">
                            <span class="error-message" id="nom_typeError"></span>
                        </div>
                        <div class="mb-3">
                            <label for="id_rec" class="form-label">ID Réclamation :</label>
                            <input type="number" class="form-control" id="id_rec" name="id_rec" value="">
                            <span class="error-message" id="id_recError"></span>
                        </div>
                        <div class="mb-3">
                            <input type="submit" value="Envoyer" class="btn btn-primary">
                            <a href="afficherTypeReclamation.php" class="btn btn-secondary">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
</footer>

<script>
function test() {
    document.getElementById('reclamation-form').addEventListener('submit', function (e) {
        let isValid = true;
        const nomType = document.getElementById('nom_type').value.trim();
        const idRec = document.getElementById('id_rec').value.trim();

        // Réinitialiser les messages d'erreur
        document.querySelectorAll('.error-message').forEach(msg => msg.innerText = '');

        // Validation du nom du type
        if (!nomType || nomType.length > 255) {
            document.getElementById('nom_typeError').innerText = "Le nom du type est requis et ne doit pas dépasser 255 caractères.";
            isValid = false;
        }

        // Validation de l'ID Réclamation
        if (!idRec || isNaN(idRec) || parseInt(idRec) <= 0) {
            document.getElementById('id_recError').innerText = "L'ID Réclamation doit être un entier positif.";
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault(); // Empêche l'envoi du formulaire
        }
    });
}

// Appeler la fonction test
test();
</script>

<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>
