<?php

session_start();

include 'squelette_html.php';
include 'header.php';
include '../bdd/bdd.php';

bdd_connexion();

?>

<?php
echo "<div id=\"mid\">";
echo "<form action=\"creerDC.php\" style=margin-bottom:20px;text-align:center;>
        <input type=\"submit\" class=\"buttonJoli\" value=\"Créer un DataChallenge.php\">
    </form>";

$resultat = infosDC();

echo '<table id="data-challenge-table">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email du gestionnaire</th>
            <th>Description</th>
            <th>Date de début</th>
            <th>Date de fin</th>
            <th>Détails</th>
            <th>Supprimer</th>
        </tr>';

while ($row = mysqli_fetch_assoc($resultat)) {
    echo '<tr>';
    echo '<td>' . $row['idDC'] . '</td>';
    echo '<td>' . $row['nom'] . '</td>';
    echo '<td>' . $row['emailGest'] . '</td>';
    echo '<td>' . $row['descDC'] . '</td>';
    echo '<td>' . $row['dateD'] . '</td>';
    echo '<td>' . $row['dateF'] . '</td>';
    echo '<td><button class="button-details" onclick="afficherDetails(' . $row['idDC'] . ')">Détails</button></td>';
    echo '<td><a style="text-decoration : none" class="button-details" href="supprimerDataChallenge.php?idDC=' . $row['idDC'] . '">Supprimer</a></td>';    echo '</tr>';
    echo '<tr id="details-' . $row['idDC'] . '" class="details-row" style="display: none;">';
    echo '<td colspan="8">';

    // Récupérer les détails du projetData
    $detailsProjetData = infosPD($row['idDC']);
    while ($rowPD = mysqli_fetch_assoc($detailsProjetData)) {
        echo 'ID Projet : ' . $rowPD['idProjet'] . '<br>';
        echo 'Description : ' . $rowPD['descriptionPD'] . '<br>';
        echo 'Image : ' . $rowPD['imagePD'] . '<br>';
        echo 'Coordonnées : ' . $rowPD['cooCont'] . '<br>';
        echo 'URL Fichier : ' . $rowPD['urlF'] . '<br>';
        echo 'URL Vidéo : ' . $rowPD['urlV'] . '<br>';
        echo '<br>';
    }

    echo '</td>';
    echo '</tr>';
}

echo '</table>';

bdd_deconnexion();
echo "</div>";

include 'footer.php';

?>