<?php

session_start();

include 'squelette_html.php';
include 'header.php';
include '../bdd/bdd.php';

bdd_connexion();
echo '<div id="mid">';
$idProjet = $_POST["idProjet"];
$idDC = $_POST["idDC"];
$mail = $_SESSION['email'];

echo $idProjet . $idDC . $mail ;
echo "<br>";

$req = "INSERT INTO Equipe (emailChef,idDC,idProjet) VALUES ('$mail','$idDC','$idProjet')";
if (mysqli_query($bdd, $req)) {
    echo "OK.";
} else {
    echo mysqli_error($bdd);
}

echo "<br>";

$req = "SELECT idEquipe FROM Equipe WHERE emailChef = '$mail'";
$result = mysqli_query($bdd, $req);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $idEquipe = $row['idEquipe'];
        echo "L'ID d'équipe correspondant à l'email du chef '$mail' est : " . $idEquipe;
    } else {
        echo "Aucun enregistrement trouvé pour l'email du chef '$mail'.";
    }
} else {
    echo "Erreur lors de l'exécution de la requête : " . mysqli_error($bdd);
}

$_SESSION['num_equipe'] = $idEquipe;
echo "<br>";

$descriptionPD = $_POST["descriptionPD"];
$imagePD = $_POST["imagePD"];
$cooCont = $_POST["cooCont"];
$urlF = $_POST["urlF"];
$urlV = $_POST["urlV"];

echo $idEquipe;

$req = "INSERT INTO ProjetData (idDC,idEquipe,descriptionPD,imagePD,cooCont,urlF,urlV) VALUES ('$idDC','$idEquipe','$descriptionPD','$imagePD','$cooCont','$urlF','$urlV')";
mysqli_query($bdd, $req);


echo "</div>";
bdd_deconnexion();
header("Location: mon_equipe.php");
exit;

?>