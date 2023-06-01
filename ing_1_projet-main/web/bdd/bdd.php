<?php
require_once 'bdd_data.php';

// fonction de connexion à la base de donnés
function bdd_connexion()
{
    global $bdd, $serveur, $utilisateur, $mot_de_passe, $base_de_donnees;
    $bdd = mysqli_connect($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);
    // Vérifier la connexion
    if (!$bdd) {
        die("La connexion à la base de données a échoué : " . mysqli_connect_error());
    } else {
        return true;
    }
}

// fonction de deconnexion à la base de donnés
function bdd_deconnexion()
{
    global $bdd;
    // Fermer la connexion à la base de données
    mysqli_close($bdd);
}


function classementDC(int $idDC)
{
    global $bdd;
    $req = "SELECT *
            FROM Equipe
            WHERE idDC = $idDC
            ORDER BY classementDC";
    $resultat = mysqli_query($bdd, $req) or die('Pb req : ' . $req);
    return $resultat;
}


function infosDC()
{
    global $bdd;
    $req = "SELECT *
            FROM DataChallenge
            ORDER BY idDC ASC";
    $resultat = mysqli_query($bdd, $req) or die('Pb req : ' . $req);
    return $resultat;
}






function infosPD(int $idDC)
{
    global $bdd;
    $req = "SELECT * FROM ProjetData WHERE idDC = $idDC ";
    $resultat = mysqli_query($bdd, $req) or die('Pb req : ' . $req);
    return $resultat;
}

function chefEq(int $idEq)
{
    global $bdd;
    $req = "SELECT emailChef FROM Equipe WHERE idEquipe = $idEq";
    $resultat = mysqli_query($bdd, $req) or die('Pb req : ' . $req);
    return $resultat;
}
function supprimerDataChallenge($idDC)
{
    global $bdd;

    // Vérifier si l'équipe 1 existe, sinon la créer
    $reqVerifEquipe1 = "SELECT COUNT(*) AS countEquipe1 FROM Equipe WHERE idEquipe = 1";
    $result = mysqli_query($bdd, $reqVerifEquipe1);
    $row = mysqli_fetch_assoc($result);
    $countEquipe1 = $row['countEquipe1'];

    if ($countEquipe1 == 0) {
        // Créer l'équipe 1
        $reqCreationEquipe1 = "INSERT INTO Equipe (idEquipe, emailChef) VALUES (1, '')";
        mysqli_query($bdd, $reqCreationEquipe1) or die("Erreur lors de la création de l'équipe 1 : " . mysqli_error($bdd));
    }

    // Mettre à jour l'idEquipe des étudiants appartenant à une équipe liée à l'idDC en 1
    $reqMajIdEquipe = "UPDATE Etudiant
    SET idEquipe = 1
    WHERE idEquipe IN (
        SELECT idEquipe
        FROM Equipe
        WHERE idDC = $idDC
    )";
    mysqli_query($bdd, $reqMajIdEquipe) or die("Erreur lors de la mise à jour de l'idEquipe des étudiants : " . mysqli_error($bdd));

    // Supprimer les projets data associés au DataChallenge
    $reqSuppressionProjetData = "DELETE FROM ProjetData WHERE idDC = $idDC";
    mysqli_query($bdd, $reqSuppressionProjetData) or die("Erreur lors de la suppression des projets data : " . mysqli_error($bdd));

    // Supprimer les équipes associées au DataChallenge
    $reqSuppressionEquipes = "DELETE FROM Equipe WHERE idDC = $idDC";
    mysqli_query($bdd, $reqSuppressionEquipes) or die("Erreur lors de la suppression des équipes : " . mysqli_error($bdd));

    // Supprimer le DataChallenge lui-même
    $reqSuppressionDataChallenge = "DELETE FROM DataChallenge WHERE idDC = $idDC";
    mysqli_query($bdd, $reqSuppressionDataChallenge) or die("Erreur lors de la suppression du DataChallenge : " . mysqli_error($bdd));

    // Vérifier si les suppressions ont réussi
    if (mysqli_affected_rows($bdd) > 0) {
        echo "Le DataChallenge, les projets data associés et les équipes ont été supprimés avec succès.";
    } else {
        echo "Erreur lors de la suppression du DataChallenge, des projets data associés et des équipes.";
    }
}






?>
