<?php
session_start();
include 'squelette_html.php';
include 'header.php';

// inclusion pour récupérer la fonction bdd_connexion() et $bdd
include '../bdd/bdd.php';

// connexion à la base de donnée 
bdd_connexion();
global $bdd;
?>
<div id="mid"> 
    <?php
    if ($_SESSION['num_equipe']==1) {
        echo "<div id='rectangle'>";
        echo '<form class="form_membre" method="POST" action="ajout_membre.php">';
        echo "<p>Vous n'avez pas d'équipe ? Créez en une en ajoutant le premier membre !</p>";
        echo '<input id="insertion_lien" name="membre" type="text" placeholder="insérez votre lien ici !">';
        echo '<br>';
        echo '<input class="submit" type="submit" value="AJOUTER">';
        echo '</form>';
        echo '</div>';
    } else {
        echo "<div id='rectangle'>";
        echo '<form class="form_membre" method="POST" action="ajout_membre.php">';
        echo '<h1>Equipe' . $_SESSION['num_equipe'] . '</h1>';
        echo "<p>Ajoutez un membre a votre équipe !</p>";
        echo '<input id="insertion_lien" name="membre" type="text" placeholder="insérez votre lien ici !">';
        echo '<br>';
        echo '<input class="submit" type="submit" value="AJOUTER">';
        echo '</form>';

        $requete = "SELECT email, nom, prenom
                    FROM Etudiant
                    JOIN Equipe ON Etudiant.idEquipe=Equipe.idEquipe
                    WHERE Equipe.idEquipe = '" . $_SESSION['num_equipe'] . "'";
        $resultat = mysqli_query($bdd, $requete);
        // Vérification si des résultats ont été obtenus
        if ($resultat && mysqli_num_rows($resultat) > 0) {
            // Boucle pour parcourir les résultats
            echo "<p id='titre_equipe'>Composition de votre équipe :</p>";
            while ($row = mysqli_fetch_assoc($resultat)) {
                echo "Email : " . $row['email'] . "<br>";
                echo "Nom : " . $row['nom'] . "<br>";
                echo "Prénom : " . $row['prenom'] . "<br>";
                echo "<br>";
            }
        }
        $requete = "SELECT emailChef FROM Equipe WHERE idEquipe = {$_SESSION['num_equipe']}";
        $resultat = mysqli_query($bdd, $requete);
        $row = mysqli_fetch_assoc($resultat);
        $emailChef = $row['emailChef'];
        if ($emailChef==$_SESSION['email']) {
            echo '<form class="form_membre" method="POST" action="sup_equipe.php">';
            echo '<input class="submit" type="submit" value="SUPPRIMER ÉQUIPE">';
            echo '</form>';
        }
        echo '</div>';

        echo "<div style='margin-top:10px;padding-top:30px' id='rectangle'>";
        $numEquipe = $_SESSION['num_equipe'];
        $chef = chefEq($_SESSION['num_equipe']);

        if ($chef && mysqli_num_rows($chef) > 0) {
            $row = mysqli_fetch_assoc($chef);
            $emailChef = $row['emailChef'];
            echo "L'e-mail du chef d'équipe est : " . $emailChef;
        } else {
            echo "Aucun chef d'équipe trouvé pour l'équipe avec l'ID : " . $idEquipe;
        }

        echo "<h3>Votre projet Data : </h3><br>";

        $req = "SELECT * FROM ProjetData 
                    WHERE idDC = (SELECT idDC FROM Equipe WHERE emailChef = '$emailChef')
                    AND idEquipe = $numEquipe";
        $resultat = mysqli_query($bdd, $req);
        while ($projets = mysqli_fetch_assoc($resultat)) {
            echo '<h3>Description du projet : </h3>';
            echo "<p> {$projets['descriptionPD']} </p>";
            echo "<h3> Coordonnées pour contacter le porteur du projet : </h3><p>" . $projets['cooCont'] . "</p>";
            echo "<h3> Lien vers les ressources : </h3><a class=\"download-button\" href={$projets['urlF']}}>Télécharger le fichier</a>";
        }
    }


    echo "</div>";
    
    ?>
</div>
<?php
include 'footer.php';
?>


