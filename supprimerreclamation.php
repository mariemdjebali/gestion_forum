<?php

include_once '../controller/reclamationC.php';


if (!isset($_GET["id_rec"]) || empty($_GET["id_rec"])) {
    die('Error: ID not provided in the URL.');
}

$reclamationC = new reclamationC();


$reclamationC->supprimerreclamation($_GET["id_rec"]);

// Redirection vers la liste
header('Location: afficherliste.php');
exit();
?>

