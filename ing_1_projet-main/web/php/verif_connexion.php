<?php
session_start();

// connexion a la base de donné
include "../bdd/bdd.php";
bdd_connexion();
global $bdd;

//récupération des données du form
$statut = $_POST['statut'];
$email = $_POST['email'];
$mdp = $_POST['mdp'];

if ($statut == "etudiant") {
    $sql = "SELECT * FROM Etudiant";
    $result = mysqli_query($bdd, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = $result->fetch_assoc()) {

            if (($row["email"]==$email) && ($row["mdp"]==$mdp)) {
                //connexion réussi
                $_SESSION['connected']=1;
                //on init les variables de session
                $_SESSION['email']=$email;
                $_SESSION['mdp']=$mdp;
                $_SESSION['prenom']=$row["prenom"];
                $_SESSION['nom']=$row["nom"];
                $_SESSION['num_equipe']=$row["idEquipe"];
                $_SESSION['tel']=$row["tel"];
                $_SESSION['ecole']=$row["etablissement"];
                $_SESSION['etude']=$row["niveauE"];
                $_SESSION['ville']=$row["ville"];
                $_SESSION['lien_code']=$row["lien"];

                //redirection vers l'accueil
                header('location: accueil.php');
            }
        }
    }
} elseif ($statut == "gestionnaire") {
    $sql = "SELECT * FROM Gestionnaire";
    $result = mysqli_query($bdd, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = $result->fetch_assoc()) {

            if (($row["email"]==$email) && ($row["mdp"]==$mdp)) {
                //connexion réussi
                $_SESSION['connected']=2;
                //on init les variables de session
                $_SESSION['email']=$email;
                $_SESSION['mdp']=$mdp;
                $_SESSION['prenom']=$row["prenom"];
                $_SESSION['nom']=$row["nom"];
                $_SESSION['tel']=$row["tel"];
                $_SESSION['entreprise']=$row["entreprise"];
                $_SESSION['debActi']=$row["debActi"];
                $_SESSION['finActi']=$row["finActi"];

                //redirection vers l'accueil
                header('location: accueil.php');
            }
        }
    }
} elseif ($statut == "admin") {
    $sql = "SELECT * FROM Administrateur";
    $result = mysqli_query($bdd, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = $result->fetch_assoc()) {
            if (($row["email"]==$email) && ($row["mdp"]==$mdp)) {
                //connexion réussi
                $_SESSION['connected']=3;
                //on init les variables de session
                $_SESSION['email']=$email;
                $_SESSION['mdp']=$mdp;
                $_SESSION['prenom']=$row["prenom"];
                $_SESSION['nom']=$row["nom"];
                $_SESSION['num_equipe']=1;
                
                //redirection vers l'accueil
                header('location: accueil.php');
            }
        }
    }
}

if($_SESSION['connected']==0) {
    //si l'identifiant et le mot de passe ne correspondent pas
    header('location: ./connexion.php');
}

    
