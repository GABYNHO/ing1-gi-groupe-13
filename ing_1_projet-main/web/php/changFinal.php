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
    $newEmail = $_POST['newEmail'];
    $newNom = $_POST['newNom'];
    $newPrenom = $_POST['newPrenom'];
    $newTel = $_POST['newTel'];
    // Ajoutez ici les autres variables pour les champs de l'étudiant
    
    $reqModifierEtudiant = "UPDATE Etudiant SET email='$newEmail', nom='$newNom', prenom='$newPrenom', tel='$newTel' WHERE email='$email'";
    mysqli_query($bdd, $reqModifierEtudiant) or die("Erreur lors de la modification de l'étudiant : " . mysqli_error($bdd));

    if (mysqli_affected_rows($bdd) > 0) {
        echo "Les informations de l'étudiant ont été modifiées avec succès.";
    } else {
        echo "Erreur lors de la modification de l'étudiant.";
    }
} elseif ($type == "gestionnaire") {
    $newEmail = $_POST['newEmail'];
    $newNom = $_POST['newNom'];
    $newPrenom = $_POST['newPrenom'];
    $newTel = $_POST['newTel'];
    $newEntreprise = $_POST['newEntreprise'];
    
    $reqModifierGestionnaire = "UPDATE Gestionnaire SET email='$newEmail', nom='$newNom', prenom='$newPrenom', tel='$newTel', entreprise='$newEntreprise' WHERE email='$email'";
    mysqli_query($bdd, $reqModifierGestionnaire) or die("Erreur lors de la modification du gestionnaire : " . mysqli_error($bdd));

    if (mysqli_affected_rows($bdd) > 0) {
        echo "Les informations du gestionnaire ont été modifiées avec succès.";
    } else {
        echo "Erreur lors de la modification du gestionnaire.";
    }
}

bdd_deconnexion();
echo "</div>";

include 'footer.php';
header('location: ./gererUtilisateurs.php');
?>
