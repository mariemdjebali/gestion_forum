<?php

include_once '../controller/typeC.php';

// Vérification de la présence et de la validité de l'ID
if (!isset($_GET["id_type"]) || empty($_GET["id_type"])) {
    die('Erreur : ID non fourni dans l\'URL.');
}

$typeReclamationC = new TypeReclamationC();

// Suppression de l'enregistrement
$typeReclamationC->supprimerTypeReclamation($_GET["id_type"]);

// Redirection vers la liste
header('Location: afficherTypeReclamation.php');
exit();
?>
