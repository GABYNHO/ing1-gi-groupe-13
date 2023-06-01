<?php

session_start();

include 'squelette_html.php';
include 'header.php';
include '../bdd/bdd.php';

bdd_connexion();

?>

<?php
echo "<div id=\"mid\">";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_projets = $_POST["nombre_projets"];
    // Utilisez la variable $nombre_projets pour effectuer les traitements souhaités
    echo "Le nombre de projets sélectionné est : " . $nombre_projets;

    $libelle_dc = $_POST['libelle'];
    $desc_dc = $_POST['desc'];
    $mail_g = $_POST['mail'];
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];
    echo $libelle_dc . $date_debut . $date_fin;

    $sql = "INSERT INTO DataChallenge (nom, descDC, emailGest, dateD, dateF) VALUES ('$libelle_dc', '$desc_dc', '$mail_g', '$date_debut', '$date_fin')";
    if (mysqli_query($bdd, $sql)) {
        $idDC = mysqli_insert_id($bdd);
        echo "Les données ont été insérées avec succès.";

        for ($i = 1; $i <= $nombre_projets; $i++) {
            $libelle_projet = $_POST["libelle_projet" . $i];
            $description_projet = $_POST["description_projet" . $i];
            $image_projet = $_POST["image_projet" . $i];
            $coordonnees_projet = $_POST["coordonnees_projet" . $i];
            $ressources_projet = $_POST["ressources_projet" . $i];
            $url_description_projet = $_POST["url_description_projet" . $i];
            $url_video_projet = $_POST["url_video_projet" . $i];
            // Ajoutez ici d'autres champs pour le projet data $i selon les informations demandées

            $insert_query = "INSERT INTO ProjetData (idDC, idEquipe, descriptionPD, imagePD, cooCont, urlF, urlV)
                            VALUES ($idDC, 1, '$description_projet', '$image_projet', '$coordonnees_projet', '$url_description_projet', '$url_video_projet')";
            if (mysqli_query($bdd, $insert_query)) {
                echo "Les données du projet $i ont été insérées avec succès.";
            } else {
                echo "Erreur lors de l'insertion des données du projet $i : " . mysqli_error($bdd);
            }
        }

        header("Location: gestionDC.php");
        exit();
        
    } else {
        echo "Erreur lors de l'insertion des données dans la table DataChallenge : " . mysqli_error($bdd);
    }
}


bdd_deconnexion();
echo "</div>";
?>
