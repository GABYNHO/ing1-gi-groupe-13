<?php
session_start();
include 'squelette_html.php';
include 'header.php';

// inclusion pour récupérer la fonction bdd_connexion() et $bdd
include '../bdd/bdd.php';

// connexion à la base de données
bdd_connexion();
global $bdd;

/////// ENVOI MESSAGE
$trop_long = false;
$dateMessage = null;

// Vérifier si un message a été soumis
if (isset($_POST['contenu'])) {
    // Récupérer le contenu du message
    $nouveauMessage = $_POST['contenu'];

    $dateActuelle = date('Y-m-d H:i:s');

    if ($_SESSION['connected']==2) {
        $requete_message = "INSERT INTO Messagerie (messages, dateMessage, emailG) VALUES ('$nouveauMessage', '$dateActuelle', '{$_SESSION['email']}')";
    }
    else{
        $requete_message = "INSERT INTO Messagerie (messages, dateMessage, emailA) VALUES ('$nouveauMessage', '$dateActuelle', '{$_SESSION['email']}')";
    }

    // Exécuter la requête
    mysqli_query($bdd, $requete_message);

    if (!empty($_POST['date-input'])) {

        $date = $_POST['date-input'];

        $annee = date('Y', strtotime($date));
        $mois = date('m', strtotime($date));
        $jour = date('d', strtotime($date));


        if(empty($_POST['time-input'])){
            $minutes = '00';
            $secondes = '00';
            $heure = '00';
        }
        
        else{
        $heure = $_POST['time-input'];
    
        list($heure, $minutes, $secondes) = explode(':', $heure);    
        }

        $dateMessage = $annee . '-' . $mois . '-' . $jour . ' ' . $heure . ':' . $minutes . ':' . $secondes;
        $requete_update_date = "UPDATE Messagerie SET dateMessage = '$dateMessage' WHERE idMessage = LAST_INSERT_ID()";

        // Exécuter la requête d'update
        mysqli_query($bdd, $requete_update_date);
    }

    header('Location: ' . $_SERVER['REQUEST_URI']);
    exit;
}

// Supprimer le message si l'index est passé en paramètre
if (isset($_GET['index'])) {
    $index = $_GET['index'];
    $requete_suppression = "DELETE FROM Messagerie WHERE idMessage = $index";
    mysqli_query($bdd, $requete_suppression);
}

echo '
<div id="mid">
    <div id="titre_messagerie">Messagerie
    </div>
    <div id="zone_text">';

$requete_messages = "SELECT * FROM Messagerie";
$resultat_messages = mysqli_query($bdd, $requete_messages);

while ($message = mysqli_fetch_assoc($resultat_messages)) {

    $requete_date_message = "SELECT dateMessage FROM Messagerie WHERE idMessage = " . $message['idMessage'];
    $resultat_date_message = mysqli_query($bdd, $requete_date_message);
    $dateMessage = mysqli_fetch_assoc($resultat_date_message)['dateMessage'];

    $emailMessage = ($message['emailG']) ? $message['emailG'] : $message['emailA'];



    // Vérifier si la date actuelle de l'ordinateur est supérieure ou égale à la date saisie
    if (isset($dateMessage) && date('Y-m-d H:i:s') >= $dateMessage) {
        echo "<div id='date_message'>";
        $date = $message['dateMessage'];
        $date_formattee = date('Y-m-d', strtotime($date));
        echo '<div>Envoyé par ' . $emailMessage . '</div>';
        echo '<div>' . $date_formattee . '</div>';
        echo "</div>";
        echo "<div id='message'>";

        if (mb_strlen($message['messages']) > 300) {
            $trop_long = true;
        } else {
            while (mb_strlen($message['messages']) > 75) {
                $message_tronque = mb_substr($message['messages'], 0, 75);
                echo $message_tronque;
                echo "<br>";
                $message['messages'] = mb_substr($message['messages'], 75);
            }
            echo $message['messages'];
        }
        // Partie Gestionnaire
        if ($_SESSION['connected'] > 1) {
            echo "<button id='poubelle_messagerie' onclick='supprimerMessage(" . $message['idMessage'] . ")'><img src='../img/poubelle.png' alt='Logo poubelle' style='width: 30px; height: 30px;'></button>";
        }
    } else{

        if (mb_strlen($message['messages']) > 300) {
            $trop_long = true;
        } else {
            // Partie Gestionnaire
            if ($_SESSION['connected'] > 1) {
                echo "<div id='date_message'>";
                $date = $message['dateMessage'];
                $date_formattee = date('Y-m-d', strtotime($date));
                echo '<div>Envoyé par ' . $emailMessage . '</div>';
                echo '<div>' . $date_formattee . '</div>';
                echo "</div>";
                echo "<div id='message'>";
                echo "<div id='message_programmé'> <div> Message non disponible avant la date spécifiée.</div>";
                while (mb_strlen($message['messages']) > 75) {
                    $message_tronque = mb_substr($message['messages'], 0, 75);
                    echo $message_tronque;
                    echo "<br>";
                    $message['messages'] = mb_substr($message['messages'], 75);
                }
                echo $message['messages'];
                echo "</div>";
                echo "<button id='poubelle_messagerie' onclick='supprimerMessage(" . $message['idMessage'] . ")'><img src='../img/poubelle.png' alt='Logo poubelle' style='width: 30px; height: 30px;'></button>";
            } else {
                echo "<div id='date_message2'>";
            }
        }
    }

    echo "</div>";
}

echo "</div>";

if ($_SESSION['connected'] > 1) {
    echo '
    <div>
        <form id="principal_messagerie" method="POST" action="#principal_messagerie">
            <div id="messagerie">
                <textarea id="contenu_messagerie" name="contenu" rows="3" cols="50" placeholder="Tapez ici votre message : moins de 300 caractères" required onInput="restriction(\'contenu_messagerie\', 300)"></textarea>
                <div class="programme_date">
                    <input type="date" id="date-input" name="date-input">
                    <input type="time" id="time-input" name="time-input">
                </div>
            </div>
            <input id="envoyer_message" type="submit" value="ENVOYER">
        </form>
    </div>';
}
?>

<script type="text/javascript" src="../js/messagerie.js"></script>

</div>
<?php
include 'footer.php';
?>
