<?php
session_start();
include 'squelette_html.php';
include 'header.php';
include '../bdd/bdd.php';

bdd_connexion();

echo "<div id=\"mid\">";
echo "<div id=intro style = \"text-align : center; margin-top : 40px\">";

echo "<h1 style = \"font-size : 80px\"> DataBattle </h1>";

echo '<div id="zone_db">';
if ($_SESSION['connected'] > 1) {

echo "<form action=\"creerDB.php\" method=\"post\">
        <input class='submit' type=\"submit\" value=\"Créer un dataBattle\">
    </form>";

echo "<form action=\"DB.php\" method=\"post\">
<input class='submit' type=\"submit\" value=\"Visualiser les questions\">
</form>";

echo "<form action=\"recuperer_reponse.php\" method=\"post\">
        <input class='submit' type=\"submit\" value=\"Récupérer les réponses\">
    </form>";
} else if ($_SESSION['connected'] == 1){

        $requete = "SELECT emailChef FROM Equipe WHERE idEquipe = {$_SESSION['num_equipe']}";
        $resultat = mysqli_query($bdd, $requete);
        $row = mysqli_fetch_assoc($resultat);
        $emailChef = $row['emailChef'];
        if ($emailChef==$_SESSION['email']) {
            $requete = "SELECT COUNT(*) AS nb FROM Etudiant WHERE idEquipe={$_SESSION['num_equipe']}";
            $resultat = mysqli_query($bdd, $requete);
            $row = mysqli_fetch_assoc($resultat);
            $nb = intval($row['nb']);
            if (($nb>2) && ($nb<9)) {
                echo "<form action=\"DB.php\" method=\"post\">
                    <input class='submit' type=\"submit\" value=\"Participer à un dataBattle\">
                    </form>";
            } else {
                echo "<p>Votre équipe n'a pas un nombre de participants correct (entre 3 et 8 membres)</p>";
            }
        
        } else {
            echo "<p>Vous devez être le Chef d'une équipe pour participer</p>";
        }
} else {
    echo "<p>Vous devez vous connecter pour acceder à cette page</p>";
}
echo "</div>";
echo "</div>";
echo "</div>";



include 'footer.php';
?>
<script src="../js/databattle.js"> </script>
