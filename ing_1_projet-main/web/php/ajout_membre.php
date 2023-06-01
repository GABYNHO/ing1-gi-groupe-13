<?php
session_start();

// inclusion pour récupérer la fonction bdd_connexion() et $bdd
include '../bdd/bdd.php';

// connexion à la base de donnée 
bdd_connexion();
global $bdd;

$requete = "SELECT idEquipe FROM Etudiant WHERE email = '" . $_POST['membre'] . "'";
$resultat = mysqli_query($bdd, $requete);

$row = mysqli_fetch_assoc($resultat);
$idEquipe = (int) $row['idEquipe'];
var_dump($idEquipe);
if ($idEquipe==1) {
    if ($_SESSION['num_equipe']==1) {

        $requete = "SELECT COUNT(*)  FROM Equipe";
        $resultat = mysqli_query($bdd, $requete);
        $row = mysqli_fetch_row($resultat);
        $nbl = $row[0];
        $nbl=1+$nbl;
        $_SESSION['num_equipe'] = $nbl;

        var_dump($nbl);
        
        $requete = "INSERT INTO Equipe (idEquipe, emailChef, idDC, idDB, classementDC, classementDB) VALUES ('$nbl', '{$_SESSION['email']}', '1', '1', '0', '0')";
        mysqli_query($bdd, $requete);

        $requete = "UPDATE Etudiant SET idEquipe='" . $nbl . "' WHERE email='" . $_SESSION['email'] . "'";
        mysqli_query($bdd, $requete);
        
        $requete = "UPDATE Etudiant SET idEquipe='" . $nbl . "' WHERE email='" . $_POST['membre'] . "'";
        mysqli_query($bdd, $requete);
        
    } else {
        $requete = "UPDATE Etudiant SET idEquipe='" . $_SESSION['num_equipe'] . "' WHERE email='" . $_POST['membre'] . "'";
        mysqli_query($bdd, $requete);
    }
}
//redirection vers mon compte
header("Location: mon_equipe.php");
?>
