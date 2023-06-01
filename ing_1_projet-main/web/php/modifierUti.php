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
    $reqEtudiant = "SELECT * FROM Etudiant WHERE email = '$email'";
    $resultatEtudiant = mysqli_query($bdd, $reqEtudiant);
    
    if (mysqli_num_rows($resultatEtudiant) > 0) {
        $rowEtudiant = mysqli_fetch_assoc($resultatEtudiant);
        
        echo "<h2>Modifier les informations de l'étudiant</h2>";
        echo "<form action=\"changFinal.php\" method=\"POST\">";
        echo "<input type=\"hidden\" name=\"email\" value=\"" . $rowEtudiant['email'] . "\">";
        echo "<input type=\"hidden\" name=\"type\" value=\"etudiant\">";
        
        echo "<table class=\"tableauBord\">";
        echo "<tr><td>Email:</td><td><input type=\"text\" name=\"newEmail\" value=\"" . $rowEtudiant['email'] . "\"></td></tr>";
        echo "<tr><td>Nom:</td><td><input type=\"text\" name=\"newNom\" value=\"" . $rowEtudiant['nom'] . "\"></td></tr>";
        echo "<tr><td>Prénom:</td><td><input type=\"text\" name=\"newPrenom\" value=\"" . $rowEtudiant['prenom'] . "\"></td></tr>";
        echo "<tr><td>Téléphone:</td><td><input type=\"text\" name=\"newTel\" value=\"" . $rowEtudiant['tel'] . "\"></td></tr>";
        
        echo "</table>";
        
        echo "<input style='margin-top:10px' type=\"submit\" value=\"Enregistrer\">";
        echo "</form>";
    } else {
        echo "Aucun étudiant trouvé.";
    }
} elseif ($type == "gestionnaire") {
    $reqGestionnaire = "SELECT * FROM Gestionnaire WHERE email = '$email'";
    $resultatGestionnaire = mysqli_query($bdd, $reqGestionnaire);
    
    if (mysqli_num_rows($resultatGestionnaire) > 0) {
        $rowGestionnaire = mysqli_fetch_assoc($resultatGestionnaire);
        
        echo "<h2>Modifier les informations du gestionnaire</h2>";
        echo "<form action=\"changFinal.php\" method=\"POST\">";
        echo "<input type=\"hidden\" name=\"email\" value=\"" . $rowGestionnaire['email'] . "\">";
        echo "<input type=\"hidden\" name=\"type\" value=\"gestionnaire\">";
        
        echo "<table class=\"tableauBord\">";
        echo "<tr><td>Email:</td><td><input type=\"text\" name=\"newEmail\" value=\"" . $rowGestionnaire['email'] . "\"></td></tr>";
        echo "<tr><td>Nom:</td><td><input type=\"text\" name=\"newNom\" value=\"" . $rowGestionnaire['nom'] . "\"></td></tr>";
        echo "<tr><td>Prénom:</td><td><input type=\"text\" name=\"newPrenom\" value=\"" . $rowGestionnaire['prenom'] . "\"></td></tr>";
        echo "<tr><td>Téléphone:</td><td><input type=\"text\" name=\"newTel\" value=\"" . $rowGestionnaire['tel'] . "\"></td></tr>";
        echo "<tr><td>Entreprise:</td><td><input type=\"text\" name=\"newEntreprise\" value=\"" . $rowGestionnaire['entreprise'] . "\"></td></tr>";
        
        echo "</table>";
        
        echo "<input style='margin-top:10px' type=\"submit\" value=\"Enregistrer\">";
        echo "</form>";
    } else {
        echo "Aucun gestionnaire trouvé.";
    }
}

bdd_deconnexion();
echo "</div>";

include 'footer.php';
?>
