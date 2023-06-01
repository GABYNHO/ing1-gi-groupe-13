<?php

session_start();

include 'squelette_html.php';
include 'header.php';
include '../bdd/bdd.php';

bdd_connexion();



echo '<div id="mid">';

$idProjet = $_POST['idProjet'];
$idDC = $_POST['idDC'];
$desc = $_POST['descriptionPD'];
$image = $_POST['imagePD'];
$cont = $_POST['cooCont'];
$urlF = $_POST['urlF'];
$urlV = $_POST['urlV'];

$idEquipe = $_SESSION['num_equipe'];
$mail = $_SESSION['email'];

echo $idDC . $idProjet . $mail;

$req = "UPDATE Equipe 
            SET idDC = $idDC,
                idProjet = $idProjet
            WHERE emailChef = '$mail'";

if (mysqli_query($bdd, $req)) {
    echo ("ok<br>");

} else {
    echo mysqli_error($bdd);
}

$req = "INSERT INTO ProjetData (idDC, idEquipe, descriptionPD, imagePD, cooCont, urlF, urlV)
        VALUES ('$idDC', '$idEquipe', '$desc', '$image', '$cont', '$urlF', '$urlV')";

if (mysqli_query($bdd, $req)) {
    echo ("ok");
} else {
    echo mysqli_error($bdd);
}


echo "</div>";


bdd_deconnexion();

include 'footer.php';

?>
