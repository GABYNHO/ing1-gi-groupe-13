<?php

session_start();

include 'squelette_html.php';
include 'header.php';
include '../bdd/bdd.php';

bdd_connexion();

echo "<div id='mid'>";

// Récupérer la valeur maximale de l'IDDC
$req_max_idDC = "SELECT MAX(idDC) AS max_idDC FROM DataChallenge";
$resultat_max_idDC = mysqli_query($bdd, $req_max_idDC);
$row_max_idDC = mysqli_fetch_assoc($resultat_max_idDC);
$max_idDC = $row_max_idDC['max_idDC'];

// Requête pour récupérer les informations des équipes par projet avec le filtre sur l'IDDC
$req = "SELECT *
        FROM Equipe
        WHERE idDC = $max_idDC
        ORDER BY idProjet";

$resultat = mysqli_query($bdd, $req);

// Afficher les noms de colonnes
echo "<table class=\"tableauBord\">";
echo "<tr>";
echo "<th>Projet</th>";
echo "<th>Équipe</th>";
echo "<th>Email Chef</th>";
echo "<th>Classement DC</th>";
echo "<th>Lien du Chef d'équipe</th>";
echo "<th>Actions</th>";
echo "</tr>";

// Parcourir les résultats et afficher le tableau des équipes
while ($row = mysqli_fetch_assoc($resultat)) {
    $idProjet = $row['idProjet'];
    $idEquipe = $row['idEquipe'];
    $emailChef = $row['emailChef'];
    $classementDC = $row['classementDC'];
    $lienCodeChef = $_SESSION['lien_code'];

    echo "<tr>
        <td>Projet n°$idProjet</td>
        <td>Equipe n°$idEquipe</td>
        <td>Email Chef: $emailChef</td>
        <td>
            <form action='modifierClassement.php' method='POST'>
                <input type='hidden' name='idEquipe' value='$idEquipe'>
                <input type='text' name='classementDC' value='$classementDC'>
                <input type='submit' value='Modifier'>
            </form>
        </td>
        <td><a href='$lienCodeChef' target='_blank'>Lien vers le GitHub</a></td>
        <td>Envoyer Message</td>
    </tr>";
}

// Fermer le tableau
echo "</table>";

echo "</div>";

include 'footer.php';
?>
