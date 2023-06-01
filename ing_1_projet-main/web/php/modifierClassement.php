<?php
session_start();

include '../bdd/bdd.php';

bdd_connexion();

if (isset($_POST['idEquipe']) && isset($_POST['classementDC'])) {
    $idEquipe = $_POST['idEquipe'];
    $classementDC = $_POST['classementDC'];

    // Mettre à jour le classement DC dans la base de données
    $req_update_classement = "UPDATE Equipe SET classementDC = '$classementDC' WHERE idEquipe = $idEquipe";
    mysqli_query($bdd, $req_update_classement);
}

bdd_deconnexion();

// Rediriger vers managDC.php
header("Location: managDC.php");
exit();
?>
