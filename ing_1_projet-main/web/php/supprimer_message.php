<?php
session_start();
include '../bdd/bdd.php';

// connexion à la base de données
bdd_connexion();
global $bdd;

if (isset($_GET['index'])) {
    $index = $_GET['index'];
    $requete_suppression = "DELETE FROM Messagerie WHERE idMessage = $index";
    mysqli_query($bdd, $requete_suppression);
}
?>
