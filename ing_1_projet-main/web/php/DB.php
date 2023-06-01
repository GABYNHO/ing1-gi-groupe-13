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

echo '<div class="questionnaires">';
    
// Récupérer la date actuelle
$dateActuelle = date('Y-m-d');

// Récupérer les questionnaires où dateD < dateActuelle et dateActuelle < dateF
$requete_questionnaires = "SELECT * FROM Questionnaire WHERE dateD < '$dateActuelle' AND '$dateActuelle' < dateF";
$resultat_questionnaires = mysqli_query($bdd, $requete_questionnaires);
$questionnaires = mysqli_fetch_all($resultat_questionnaires, MYSQLI_ASSOC);

// Afficher les questionnaires
if (!empty($questionnaires)) {
    $_SESSION['a_répondu'] = 1;
    foreach ($questionnaires as $questionnaire) {
        echo "<div class=\"questionnaire\">";
        echo "QUESTIONNAIRE " . $questionnaire['idQuest'] . " (Date de début: " . $questionnaire['dateD'] . ", Date de fin: " . $questionnaire['dateF'] . ")";
        echo "<br>";
        echo "<br>";

        echo $questionnaire['descQuestionnaire'];
        echo "<br>";
        echo "<br>";

        // Récupérer les questions associées à l'idQuestionnaire
        $idQuestionnaire = $questionnaire['idQuest'];
        $requete_questions = "SELECT * FROM Question WHERE idQuestionnaire = '$idQuestionnaire'";
        $resultat_questions = mysqli_query($bdd, $requete_questions);
        $questions = mysqli_fetch_all($resultat_questions, MYSQLI_ASSOC);

        // Afficher les questions dans un formulaire
        if (!empty($questions)) {
            echo "<form method=\"POST\">";
            foreach ($questions as $question) {
                echo "<div>";
                echo "Question " . $question['idQuestion'] . ": " . $question['nomQuest'];
                echo "</div>";
                if ($_SESSION['connected'] == 1) {
                    echo "<div>";
                    echo "<input type=\"text\" name=\"reponseQuestion" . $question['idQuestion'] . "\" placeholder=\"Réponse\">";
                    echo "</div>";
                }
                echo "<br>";
            }
            echo "<input type=\"hidden\" name=\"idQuestionnaire\" value=\"" . $questionnaire['idQuest'] . "\">";
            if ($_SESSION['connected'] == 1) {
                echo "<input class='submit' type=\"submit\" value=\"Soumettre\">";
            }
            echo "</form>";

            // Vérifier si des réponses ont été soumises
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if ($_POST['idQuestionnaire'] === $questionnaire['idQuest']) {
                    foreach ($_POST as $name => $value) {
                        if (strpos($name, 'reponseQuestion') === 0) {
                            $idQuestion = substr($name, strlen('reponseQuestion'));
                            $reponse = $_POST[$name];

                            $idEquipe = $_SESSION['num_equipe'];

                            // Vérifier si l'étudiant a déjà répondu à cette question
                            $requete_exist_reponse = "SELECT * FROM Reponse WHERE idQuestion = '$idQuestion' AND idEquipe = '$idEquipe'";
                            $resultat_exist_reponse = mysqli_query($bdd, $requete_exist_reponse);
                            $existing_response = mysqli_fetch_assoc($resultat_exist_reponse);

                            if ($existing_response) {
                                // Mise à jour de la réponse existante
                                $requete_update_reponse = "UPDATE Reponse SET rep = '$reponse' WHERE idQuestion = '$idQuestion' AND idEquipe = '$idEquipe'";
                                mysqli_query($bdd, $requete_update_reponse);
                            } else {
                                // Insertion d'une nouvelle réponse
                                $requete_insert_reponse = "INSERT INTO Reponse (idQuestion, idEquipe, rep) VALUES ('$idQuestion', '$idEquipe', '$reponse')";
                                mysqli_query($bdd, $requete_insert_reponse);
                            }
                        }
                    }
                    echo "Réponses soumises avec succès";
                }
            }
        } else {
            echo "<p>Aucune question trouvée pour ce questionnaire</p>";
        }

        echo "</div>";
    }
} else {
    echo "<p>Aucun questionnaire disponible pour le moment</p>";
}

echo '</div>';

echo '</div>';

include 'footer.php';
?>
