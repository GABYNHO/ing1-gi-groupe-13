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
    $entreprise = $_POST['entreprise'];

    // Vérifier si l'email existe déjà dans la base de données
    $reqEmailExiste = "SELECT * FROM Gestionnaire WHERE email = '$email'";
    $resultatEmailExiste = mysqli_query($bdd, $reqEmailExiste);

    if (mysqli_num_rows($resultatEmailExiste) > 0) {
        echo "L'email existe déjà. Veuillez en choisir un autre.";
    } else {
        // Insérer le nouveau gestionnaire dans la base de données
        $reqCreerGestionnaire = "INSERT INTO Gestionnaire (email, nom, prenom, tel, entreprise) VALUES ('$email', '$nom', '$prenom', '$tel', '$entreprise')";
        $resultatCreerGestionnaire = mysqli_query($bdd, $reqCreerGestionnaire);

        if ($resultatCreerGestionnaire) {
            echo "Le gestionnaire a été créé avec succès.";
            header("Location: gererUtilisateurs.php"); // Redirection vers la page "gererUtilisateurs.php"
            exit; // Terminer le script pour éviter toute exécution supplémentaire
        } else {
            echo "Une erreur s'est produite lors de la création du gestionnaire. Veuillez réessayer.";
        }
    }
}

bdd_deconnexion();

include 'footer.php';
?>
