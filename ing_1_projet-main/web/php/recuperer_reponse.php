<?php
session_start();
include 'squelette_html.php';
include 'header.php';
include '../bdd/bdd.php';

bdd_connexion();

echo "<div id=\"mid\">";
echo "<div id=intro style = \"text-align : center; margin-top : 40px\">";
echo "<h1 style = \"font-size : 80px\"> DataBattle </h1>";
echo "</div>";

if ($_SESSION['connected']>1) {
    echo '<div class="questionnaires">';
    
    // Récupérer les réponses avec les détails des questions et équipes associées, triées par idEquipe puis par idQuestion
    $requete_reponses = "SELECT Reponse.*, Question.idQuestion, Question.nomQuest, Equipe.idEquipe 
    FROM Reponse 
    INNER JOIN Question ON Reponse.idQuestion = Question.idQuestion
    INNER JOIN Equipe ON Reponse.idEquipe = Equipe.idEquipe
    ORDER BY Equipe.idEquipe, Question.idQuestion";

    $resultat_reponses = mysqli_query($bdd, $requete_reponses);
    $reponses = mysqli_fetch_all($resultat_reponses, MYSQLI_ASSOC);

    // Afficher les réponses avec la possibilité de saisir une note
    if (!empty($reponses)) {
        echo "<form method=\"GET\">";
        echo "<table>";
        echo "<tr><th>Question</th><th>Équipe</th><th>Réponse</th><th>Note</th></tr>";
        foreach ($reponses as $reponse) {
            echo "<tr>";
            echo "<td>" . $reponse['idQuestion'] . ": " . $reponse['nomQuest'] . "</td>";
            echo "<td>Équipe " . $reponse['idEquipe'] . "</td>";
            echo "<td>" . $reponse['rep'] . "</td>";
            echo "<td><input type=\"text\" name=\"noteQuestion_" . $reponse['idQuestion'] . "_equipe_" . $reponse['idEquipe'] . "\" placeholder=\"Note\"></td>";
            echo "</tr>";
        }
        echo "</table>";

        // Gérer la soumission des notes
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            foreach ($reponses as $reponse) {
                $idQuestion = $reponse['idQuestion'];
                $idEquipe = $reponse['idEquipe'];
                $note = $_POST['noteQuestion_' . $idQuestion . '_equipe_' . $idEquipe];

                // Mettre à jour la colonne 'note' de la table Reponse avec la nouvelle note
                $requete_update_note = "UPDATE Reponse SET note = '$note' WHERE idQuestion = '$idQuestion' AND idEquipe = '$idEquipe'";
                mysqli_query($bdd, $requete_update_note);
            }
        }

        // Afficher le bouton de soumission des notes
        echo "<input class='submit' type=\"submit\" value=\"Soumettre les notes\">";
        echo "</form>";
    } else {
        echo "<p>Aucune réponse trouvée.</p>";
    }
    
    echo '</div>';
}

echo '</div>';

include 'footer.php';
?>
