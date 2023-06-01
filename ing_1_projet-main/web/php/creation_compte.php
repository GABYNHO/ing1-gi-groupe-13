<?php
session_start();

// inclusion pour récupérer la fonction bdd_connexion() et $bdd
include '../bdd/bdd.php';

// connexion à la base de donnée 
bdd_connexion();
global $bdd;

//le user est maintenant connecté sur sont nouveau compte
$_SESSION['connected']=1;

//récupération des données du form
$email = $_POST['email'];
$num_equipe = 1;
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$tel = $_POST['tel'];
$mdp = $_POST['mdp'];
$ecole = $_POST['ecole'];
$etude = $_POST['etude'];
$ville = $_POST['ville'];
$lien = "";

// encodage du mot de passe
$encode_mdp = $mdp;

// Vérification si l'e-mail est déjà utilisé
$requete_verif_email = "SELECT COUNT(*) AS count FROM Etudiant WHERE email = '$email'";
$resultat_verif_email = mysqli_query($bdd, $requete_verif_email);
$row_verif_email = mysqli_fetch_assoc($resultat_verif_email);
$email_existe = $row_verif_email['count'];

if ($email_existe > 0) {
    // L'e-mail est déjà utilisé, afficher un message d'erreur avec un popup
    echo '<script>alert("L\'e-mail est déjà utilisé. Veuillez en choisir un autre.");</script>';
    // Redirection vers la page précédente
    echo '<script>window.history.go(-1);</script>';
    exit;
}


else{
// Préparer la requête d'insertion
$requete = "INSERT INTO Etudiant (email, idEquipe, nom, prenom, tel, mdp, etablissement, niveauE, ville, lien) VALUES ('$email', '$num_equipe', '$nom', '$prenom', '$tel', '$encode_mdp', '$ecole', '$etude', '$ville', '$lien')";

// Exécuter la requête
mysqli_query($bdd, $requete);

//on init les variables de session
$_SESSION['email']=$email;
$_SESSION['num_equipe']=$num_equipe;
$_SESSION['nom']=$nom;
$_SESSION['prenom']=$prenom;
$_SESSION['tel']=$tel;
$_SESSION['mdp']=$mdp;
$_SESSION['ecole']=$ecole;
$_SESSION['etude']=$etude;
$_SESSION['ville']=$ville;
$_SESSION['lien_code']=$lien;

//redirection vers l'accueil
header("Location: accueil.php");
}
?>
