<?php
session_start();
include 'squelette_html.php';
include 'header.php';

// inclusion pour récupérer la fonction bdd_connexion() et $bdd
include '../bdd/bdd.php';

// connexion à la base de données
bdd_connexion();
global $bdd;

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$tel = $_POST['tel'];
$entreprise = $_POST['entreprise'];
$mdp = $_POST['mdp'];
$email = $_SESSION['email'];



// Préparer la requête d'insertion
$requete = "UPDATE Gestionnaire SET nom='$nom', prenom='$prenom', tel='$tel', entreprise='$entreprise', mdp='$mdp' WHERE email='$email'";

// Exécuter la requête
mysqli_query($bdd, $requete);

$_SESSION['nom'] = $nom;
$_SESSION['prenom'] = $prenom;
$_SESSION['tel'] = $tel;
$_SESSION['entreprise'] = $entreprise;
$_SESSION['mdp'] = $mdp;

//redirection vers l'accueil
header("Location: mon_compte.php");
?>
