<?php
include '../bdd/bdd.php';
bdd_connexion();

if (isset($_GET['idDC'])) {
    $idDC = $_GET['idDC'];
    echo $idDC;
    supprimerDataChallenge($idDC);
}

bdd_deconnexion();
header('location: ./gestionDC.php');
exit;
?>
