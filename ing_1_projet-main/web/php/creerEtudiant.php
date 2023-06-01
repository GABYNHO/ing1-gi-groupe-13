<?php
session_start();

include 'squelette_html.php';
include 'header.php';
include '../bdd/bdd.php';

bdd_connexion();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $tel = $_POST['tel'];

    // Vérifier si l'email existe déjà dans la base de données
    $reqEmailExiste = "SELECT * FROM Etudiant WHERE email = '$email'";
    $resultatEmailExiste = mysqli_query($bdd, $reqEmailExiste);

    if (mysqli_num_rows($resultatEmailExiste) > 0) {
        echo "L'email existe déjà. Veuillez en choisir un autre.";
    } else {
        // Insérer le nouvel étudiant dans la base de données
        $reqCreerEtudiant = "INSERT INTO Etudiant (email, nom, prenom, tel) VALUES ('$email', '$nom', '$prenom', '$tel')";
        $resultatCreerEtudiant = mysqli_query($bdd, $reqCreerEtudiant);

        if ($resultatCreerEtudiant) {
            echo "L'étudiant a été créé avec succès.";
            header("Location: gererUtilisateurs.php"); // Redirection vers la page "gererUtilisateurs.php"
            exit; // Terminer le script pour éviter toute exécution supplémentaire
        } else {
            echo "Une erreur s'est produite lors de la création de l'étudiant. Veuillez réessayer.";
        }
    }
}

bdd_deconnexion();

include 'footer.php';
?>
