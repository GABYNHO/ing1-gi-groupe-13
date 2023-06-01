<?php

session_start();

include 'squelette_html.php';
include 'header.php';
include '../bdd/bdd.php';

bdd_connexion();

?>

<?php
echo "<div id=\"mid\">";
echo "<div id=intro style = \"text-align : center; margin-top : 40px\">";

echo "<h1 style = \"font-size : 80px;\"> DataChallenge </h1>";

if ($_SESSION['connected'] === 3) {
    echo "<form action=\"gestionDC.php\" >
        <input class=\"buttonJoli\" type=\"submit\" value=\"Créer/Supprimer des DataChallenges\">
    </form>";
}

if ($_SESSION['connected'] === 2) {
    echo "<form action=\"managDC.php\" >
        <input class=\"buttonJoli\" type=\"submit\" value=\"Gérer le DataChallenge\">
    </form>";
}
echo "";
echo "</div>";

$req_max_idDC = "SELECT MAX(idDC) AS max_idDC FROM DataChallenge";
$resultat_max_idDC = mysqli_query($bdd, $req_max_idDC);
$row_max_idDC = mysqli_fetch_assoc($resultat_max_idDC);
$max_idDC = $row_max_idDC['max_idDC'];


$pds = infosPD($max_idDC);

echo "<div class=\"container\">";

$i = 0;
while ($projets = mysqli_fetch_assoc($pds)) {
    $idPD = $projets['idProjet'];
    $i += 1;

    echo '<div class="div-clickable" onclick="toggleInfo(' . $idPD . ')">';
    echo '<h3>Projet ' . $i . '</h3>';
    echo "<p> {$projets['descriptionPD']} </p>";
    echo '<div id="additional-info-' . $idPD . '" class="additional-info">';
    echo "<p style=\"margin-bottom:15px\">Vidéo présentation du projet : </p>";
    echo "<div class=\"video-player\" data-video-id={$projets['urlV']}></div>";
    echo "<br>";
    echo "<h3>Contacter le porteur de projet : " . $projets['cooCont'];
    echo "<br>";
    echo "<a class=\"download-button\" href={$projets['urlF']}}>Télécharger le fichier</a>";

    // Formulaire pour l'inscription au projet

    $emailChef = $_SESSION['email'];

    $req = "SELECT *
        FROM Equipe
        WHERE emailChef = '$emailChef'";

    $result = mysqli_query($bdd, $req);

    if ($result && mysqli_num_rows($result) > 0) {

        echo "<form action=\"inscriptionDC.php\" method=\"POST\">";
        echo "<input type=\"hidden\" name=\"idProjet\" value=\"{$projets['idProjet']}\">";
        echo "<input type=\"hidden\" name=\"idDC\" value=\"{$projets['idDC']}\">";
        echo "<input type=\"hidden\" name=\"idEquipe\" value=\"{$projets['idEquipe']}\">";
        echo "<input type=\"hidden\" name=\"descriptionPD\" value=\"{$projets['descriptionPD']}\">";
        echo "<input type=\"hidden\" name=\"imagePD\" value=\"{$projets['imagePD']}\">";
        echo "<input type=\"hidden\" name=\"cooCont\" value=\"{$projets['cooCont']}\">";
        echo "<input type=\"hidden\" name=\"urlF\" value=\"{$projets['urlF']}\">";
        echo "<input type=\"hidden\" name=\"urlV\" value=\"{$projets['urlV']}\">";

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
                echo "<input class=\"download-button\" type=\"submit\" value=\"Participer au projet\">";
            }
            else {
                echo"<p>Il faut 3 à 8 membres dans votre équipe pour participer à un DataChallenge !</p>";
            }
        echo "</form>";
        }
    }
    echo '</div>';
    echo '</div>';
}

echo "</div>";


echo "<div id='precDC'>";

$req = "SELECT *
        FROM DataChallenge
        WHERE idDC = ($max_idDC - 1)";
$resultat = mysqli_query($bdd, $req) or die('Pb req : ' . $req);

if ($row = mysqli_fetch_assoc($resultat)) {
    $nomDataChallenge = $row['nom'];
    echo "<h1 style='margin-top:40px;font-size:40px;'>Classement du précédent DataChallenge : " . $nomDataChallenge . "</h4>";
} else {
    echo "Aucun DataChallenge trouvé.";
}



$classement = classementDC($max_idDC - 1);
$equipes = mysqli_fetch_all($classement, MYSQLI_ASSOC);

echo "<div class=\"podium\">";
echo "<div class=\"place\">";
echo "<h1>2eme Place<br></h1>";
echo "<p>Equipe n°{$equipes[1]['idEquipe']}</p>";
echo "</div>";
echo "<div class=\"place\">";
echo "<h1>1ere Place<br></h1>";
echo "<p>Equipe n°{$equipes[0]['idEquipe']}</p>";
echo "</div>";
echo "<div class=\"place\">";
echo "<h1>3ème Place<br></h1>";
echo "<p>Equipe n°{$equipes[2]['idEquipe']}</p>";
echo "</div>";

echo "</div>"; // Fermer la div 'podium'

echo "<h1 style=\"margin-top : 20px\"> Consultez le classement global de toutes les équipes ! </h1>";

echo "<div class=\"scrollable-div\">";
echo "<table class=\"tableauBord\">
    <thead>
        <tr>
            <th>Classement</th>
            <th>ID de l'équipe</th>
            <th>Chef d'équipe</th>
        </tr>
    </thead>
    <tbody>";

$classement = classementDC($max_idDC - 1);
while ($classm = mysqli_fetch_assoc($classement)) {

    echo "<tr>";
    echo "<td>{$classm['classementDC']}</td>";
    echo "<td>{$classm['idEquipe']}</td>";
    $chef = chefEq($classm['idEquipe']);
    $row = mysqli_fetch_assoc($chef);
    $emailChef = $row['emailChef'];
    echo "<td>$emailChef</td>";
    echo "</tr>";
}
echo "</tbody>";
echo "</table>";
echo "</div>";


echo "</div>"; // Fermer la div 'precDC'



bdd_deconnexion();

echo "</div>";

include 'footer.php';

?>
