<?php
session_start();
include 'squelette_html.php';
include 'header.php';
include '../bdd/bdd.php';

bdd_connexion();

if (isset($_POST['question1']) && isset($_POST['question2']) && isset($_POST['question3']) && isset($_POST['question4'])) {
  $dateD = $_POST['DateDeb'];
  $dateF = $_POST['DateFin'];
  $descQuestionnaire = $_POST['descQuestionnaire'];

  $requete_questionnaire = "INSERT INTO Questionnaire (descQuestionnaire, idDB, idEquipe, dateD, dateF) VALUES ('$descQuestionnaire', '1', '1', '$dateD', '$dateF')";

  // Exécuter la requête pour le questionnaire
  mysqli_query($bdd, $requete_questionnaire);

  // Récupérer l'idQuestionnaire du questionnaire créé
  $idQuestionnaire = mysqli_insert_id($bdd);

  $q1 = $_POST['question1'];
  $q2 = $_POST['question2'];
  $q3 = $_POST['question3'];
  $q4 = $_POST['question4'];
  $q5 = $_POST['question5'];

  $requete_question1 = "INSERT INTO Question (idQuestionnaire, nomQuest) VALUES ('$idQuestionnaire', '$q1')";
  $requete_question2 = "INSERT INTO Question (idQuestionnaire, nomQuest) VALUES ('$idQuestionnaire', '$q2')";
  $requete_question3 = "INSERT INTO Question (idQuestionnaire, nomQuest) VALUES ('$idQuestionnaire', '$q3')";
  $requete_question4 = "INSERT INTO Question (idQuestionnaire, nomQuest) VALUES ('$idQuestionnaire', '$q4')";
  $requete_question5 = "INSERT INTO Question (idQuestionnaire, nomQuest) VALUES ('$idQuestionnaire', '$q5')";

  // Exécuter les requêtes pour les questions
  mysqli_query($bdd, $requete_question1);
  mysqli_query($bdd, $requete_question2);
  mysqli_query($bdd, $requete_question3);
  mysqli_query($bdd, $requete_question4);
  mysqli_query($bdd, $requete_question5);

  // Effectuer la redirection pour éviter la répétition de l'action
  header('Location: ' . $_SERVER['REQUEST_URI']);
  exit;
}

echo "<div id=\"mid\">";
echo "<div id=intro style = \"text-align : center; margin-top : 40px\">";
echo "<h1 style = \"font-size : 80px\"> DataBattle </h1>";
echo "</div>";
echo '<body>';
if ($_SESSION['connected'] > 1) {
  echo'<div id="modal" class="modal">
      <form id="creerDB" method="POST" onsubmit="return validateDate()">
      <div id="questionnaire">
      <h2 id="quest">Créer un questionnaire</h2>
      <div id="question">
        <label class="text"> Description du questionnaire :</label>
        <textarea id="descQuestionnaire" name="descQuestionnaire" placeholder="Entrez la description du questionnaire" oninput="restriction(\'descQuestionnaire\', 200)"></textarea>
      </div>
      <div id="question">
        <label class="text"> Question 1 * :</label>
        <input id="question1" type="text" name="question1"
          placeholder="Entrez votre première question" required>
      </div>
      <div id="question">
        <label class="text"> Question 2 * :</label>
        <input id="question2" type="text" name="question2"
          placeholder="Entrez votre deuxième question" required>
      </div>
      <div id="question">
        <label  class="text"> Question 3 * :</label>
        <input id="question3" type="text" name="question3"
          placeholder="Entrez votre troisième question" required>
      </div>
      <div id="question">
        <label  class="text"> Question 4 * :</label>
        <input id="question4" type="text" name="question4"
          placeholder="Entrez votre quatrième question" required>
      </div>
      <div id="question">
        <label  class="text"> Question 5 * :</label>
        <input id="question5" type="text" name="question5"
          placeholder="Entrez votre cinquième question" required>
      </div>
      </div>
      <div class="dateD">
        <label  class="text"> Date de début * :</label>
        <input id="DateDeb" type="date" name="DateDeb"
          placeholder="Entrez une date" required>
      </div>
      <div class="dateF">
        <label  class="text"> Date de fin * :</label>
        <input id="DateFin" type="date" name="DateFin"
          placeholder="Entrez une date" required>
      </div>
      <p class="nb"> N.B: Toutes les questions avec * sont obligatoires</p>
      <div class="bouton">
        <input class="submit" type="submit" value="Envoyer">
      </div>
        
    </form>';
}
echo '</div>';
echo '</div>';
echo'</body>';

include 'footer.php';
?>

<script src="../js/databattle.js"></script>
