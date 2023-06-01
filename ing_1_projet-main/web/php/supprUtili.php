<?php

session_start();

include 'squelette_html.php';
include 'header.php';
include '../bdd/bdd.php';

bdd_connexion();

?>

<?php
echo "<div id=\"mid\">";

$email = $_POST['email'];
$type = $_POST['type'];

if ($type == "etudiant") {
    $reqSuppressionEtudiant = "DELETE FROM Etudiant WHERE email = '$email'";
    mysqli_query($bdd, $reqSuppressionEtudiant) or die("Erreur lors de la suppression de l'étudiant : " . mysqli_error($bdd));

    if (mysqli_affected_rows($bdd) > 0) {
        echo "L'étudiant a été supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression de l'étudiant.";
    }
} elseif ($type == "gestionnaire") {
    $reqSuppressionGestionnaire = "DELETE FROM Gestionnaire WHERE email = '$email'";
    mysqli_query($bdd, $reqSuppressionGestionnaire) or die("Erreur lors de la suppression du gestionnaire : " . mysqli_error($bdd));

    if (mysqli_affected_rows($bdd) > 0) {
        echo "Le gestionnaire a été supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression du gestionnaire.";
    }
}


bdd_deconnexion();
echo "</div>";

include 'footer.php';
header('location: ./gererUtilisateurs.php');

?>