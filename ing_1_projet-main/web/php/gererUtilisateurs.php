<?php
session_start();
include 'squelette_html.php';
include 'header.php';
include '../bdd/bdd.php';

bdd_connexion();
?>

<?php
echo "<div id=\"mid\">";

// Affichage des étudiants
$reqEtudiants = "SELECT * FROM Etudiant";
$resultatEtudiants = mysqli_query($bdd, $reqEtudiants);

// Vérifier s'il y a des étudiants
if (mysqli_num_rows($resultatEtudiants) > 0) {
    echo "<h2 style='text-align:center'>Étudiants</h2>";
    echo "<table class='tableauBord'>";
    echo "<tr>";
    echo "<th>Email</th>";
    echo "<th>ID Équipe</th>";
    echo "<th>Nom</th>";
    echo "<th>Prénom</th>";
    echo "<th>Téléphone</th>";
    echo "<th>Actions</th>";
    echo "</tr>";

    // Afficher chaque étudiant dans une ligne du tableau
    while ($row = mysqli_fetch_assoc($resultatEtudiants)) {
        echo "<tr>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['idEquipe'] . "</td>";
        echo "<td>" . $row['nom'] . "</td>";
        echo "<td>" . $row['prenom'] . "</td>";
        echo "<td>" . $row['tel'] . "</td>";
        echo "<td>";

        echo '<form action="supprUtili.php" method="POST">';
        echo '<input type="hidden" name="email" value="' . $row['email'] . '">';
        echo '<input type="hidden" name="type" value="etudiant">';
        echo '<input type="submit" value="Supprimer">';
        echo '</form>';

        echo '<form action="modifierUti.php" method="POST">';
        echo '<input type="hidden" name="email" value="' . $row['email'] . '">';
        echo '<input type="hidden" name="type" value="etudiant">';
        echo '<input type="submit" value="Modifier">';
        echo '</form>';

        echo "</td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "<br>";
} else {
    echo "Aucun étudiant trouvé.";
}

// Formulaire de création d'un nouvel étudiant (caché par défaut)

echo "<button onclick=\"toggleForm('formEtudiant')\">Créer un nouvel étudiant</button>";
echo "<form id='formEtudiant' action='creerEtudiant.php' method='POST' style='display: none;'>";
echo "<h3>Créer un nouvel étudiant :</h3>";

echo "<table class=\"tableauBord\">";
echo "<tr><td>Email:</td><td><input type='text' name='email'></td></tr>";
echo "<tr><td>Nom:</td><td><input type='text' name='nom'></td></tr>";
echo "<tr><td>Prénom:</td><td><input type='text' name='prenom'></td></tr>";
echo "<tr><td>Téléphone:</td><td><input type='text' name='tel'></td></tr>";

echo "</table>";

echo "<input type='submit' value='Créer'>";
echo "</form>";


echo "<br>";

// Affichage des gestionnaires
$reqGestionnaires = "SELECT * FROM Gestionnaire";
$resultatGestionnaires = mysqli_query($bdd, $reqGestionnaires);

// Vérifier s'il y a des gestionnaires
if (mysqli_num_rows($resultatGestionnaires) > 0) {
    echo "<h2 style='text-align:center'>Gestionnaires</h2>";
    echo "<table class='tableauBord'>";
    echo "<tr>";
    echo "<th>Email</th>";
    echo "<th>Nom</th>";
    echo "<th>Prénom</th>";
    echo "<th>Téléphone</th>";
    echo "<th>Entreprise</th>";
    echo "<th>Actions</th>";
    echo "</tr>";

    // Afficher chaque gestionnaire dans une ligne du tableau
    while ($row = mysqli_fetch_assoc($resultatGestionnaires)) {
        echo "<tr>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['nom'] . "</td>";
        echo "<td>" . $row['prenom'] . "</td>";
        echo "<td>" . $row['tel'] . "</td>";
        echo "<td>" . $row['entreprise'] . "</td>";
        echo "<td>";

        echo '<form action="supprUtili.php" method="POST">';
        echo '<input type="hidden" name="email" value="' . $row['email'] . '">';
        echo '<input type="hidden" name="type" value="gestionnaire">';
        echo '<input type="submit" value="Supprimer">';
        echo '</form>';

        echo '<form action="modifierUti.php" method="POST">';
        echo '<input type="hidden" name="email" value="' . $row['email'] . '">';
        echo '<input type="hidden" name="type" value="gestionnaire">';
        echo '<input type="submit" value="Modifier">';
        echo '</form>';

        echo "</td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "<br>";
} else {
    echo "Aucun gestionnaire trouvé.";
}

// Formulaire de création d'un nouveau gestionnaire (caché par défaut)

echo "<button onclick=\"toggleForm('formGestionnaire')\">Créer un nouveau gestionnaire</button>";
echo "<form id='formGestionnaire' action='creerGestionnaire.php' method='POST' style='display: none;'>";
echo "<h3>Créer un nouveau gestionnaire :</h3>";

echo "<table class=\"tableauBord\">";
echo "<tr><td>Email:</td><td><input type='text' name='email'></td></tr>";
echo "<tr><td>Nom:</td><td><input type='text' name='nom'></td></tr>";
echo "<tr><td>Prénom:</td><td><input type='text' name='prenom'></td></tr>";
echo "<tr><td>Téléphone:</td><td><input type='text' name='tel'></td></tr>";
echo "<tr><td>Entreprise:</td><td><input type='text' name='entreprise'></td></tr>";

echo "</table>";

echo "<input type='submit' value='Créer'>";
echo "</form>";


bdd_deconnexion();

echo "</div>";

include 'footer.php';
?>

<script>
    function toggleForm(formId) {
        var form = document.getElementById(formId);
        form.style.display = (form.style.display === 'none') ? 'block' : 'none';
    }
</script>
