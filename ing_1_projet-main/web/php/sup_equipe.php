<?php
session_start();

// inclusion pour récupérer la fonction bdd_connexion() et $bdd
include '../bdd/bdd.php';

// connexion à la base de donnée 
bdd_connexion();
global $bdd;

$requete = "UPDATE Etudiant SET idEquipe=1 WHERE idEquipe={$_SESSION['num_equipe']}";
$resultat = mysqli_query($bdd, $requete);

$requete = "DELETE FROM Equipe WHERE idEquipe={$_SESSION['num_equipe']}";
$resultat = mysqli_query($bdd, $requete);

$_SESSION['num_equipe']=1;

header("Location: mon_equipe.php");
?>
