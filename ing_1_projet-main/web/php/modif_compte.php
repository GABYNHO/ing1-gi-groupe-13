<?php 
session_start();

// inclusion pour récupérer la fonction bdd_connexion() et $bdd
include '../bdd/bdd.php';

// connexion à la base de donnée 
bdd_connexion();
global $bdd;

$lien=$_POST['lien'];
$_SESSION['lien_code']=$lien;

// Préparer la requête d'insertion
$requete = "UPDATE Etudiant SET lien='$lien' WHERE email='" . $_SESSION['email'] . "'";
// Exécuter la requête
mysqli_query($bdd, $requete);

//redirection vers l'accueil
header("Location: mon_compte.php");

