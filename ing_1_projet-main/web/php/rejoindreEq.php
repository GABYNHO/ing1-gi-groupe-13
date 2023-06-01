<?php

session_start();

include 'squelette_html.php';
include 'header.php';
include '../bdd/bdd.php';

bdd_connexion();
echo '<div id="mid">';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $idDC = $_POST['idDC'];
    $idProjet = $_POST['idProjet'];

    echo $email . $idDC . $idProjet;

    $req = "SELECT idEquipe FROM Equipe WHERE emailChef = '$email'";
    $result = mysqli_query($bdd, $req);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $idEquipe = $row['idEquipe'];
            echo "L'ID d'équipe correspondant à l'email du chef '$email' est : " . $idEquipe;
        } else {
            header("Location: inscriptionDC.php?erreur=1");
            exit();
        }
    } else {
        header("Location: inscriptionDC.php?erreur=1");
        exit();
    }

    $_SESSION['num_equipe'] = $idEquipe;
    echo "<br>";
    echo $_SESSION['num_equipe'];

}
bdd_deconnexion();
echo "</div>";

include 'footer.php';

header("Location: mon_equipe.php");
exit();

?>