<?php
session_start();
include 'squelette_html.php';
include 'header.php';
?>
<div id="mid"> 
    <div class="bloc_forms">
        <div id="info_compte">
            <p id="titre_compte">Vos informations</p>
            <?php 
            switch ($_SESSION['connected']) {
                case "1":
                    echo '<p class="info_compte">Prénom : '.$_SESSION['prenom'].'</p>';
                    echo '<p class="info_compte">Nom : '.$_SESSION['nom'].'</p>';
                    echo '<p class="info_compte">Email : '.$_SESSION['email'].'</p>';
                    if ($_SESSION['num_equipe']==1) {
                        echo '<p class="info_compte">Équipe : Aucune équipe attribuée</p>';
                    } else {
                        echo '<p class="info_compte">Équipe : '.$_SESSION['num_equipe'].'</p>';
                    }
                    echo '<p class="info_compte">Téléphone : '.$_SESSION['tel'].'</p>';
                    echo '<p class="info_compte">Niveau d étude : '.$_SESSION['etude'].'</p>';
                    echo '<p class="info_compte">Établissement : '.$_SESSION['ecole'].'</p>';
                    echo '<p class="info_compte">Ville : '.$_SESSION['ville'].'</p>';
                    break;
                case "2":
                    echo '<p class="info_compte">Prénom : '.$_SESSION['prenom'].'</p>';
                    echo '<p class="info_compte">Nom : '.$_SESSION['nom'].'</p>';
                    echo '<p class="info_compte">Email : '.$_SESSION['email'].'</p>';
                    echo '<p class="info_compte">Téléphone : '.$_SESSION['tel'].'</p>';
                    echo '<p class="info_compte">Entreprise : '.$_SESSION['entreprise'].'</p>';
                    break;
                case "3":
                    echo '<p class="info_compte">Prénom : '.$_SESSION['prenom'].'</p>';
                    echo '<p class="info_compte">Nom : '.$_SESSION['nom'].'</p>';
                    echo '<p class="info_compte">Email : '.$_SESSION['email'].'</p>';
                    break;
                default:
                    echo "YA UN BUG VOUS ETES PAS COOONECTÉ";
            }
            
            if ($_SESSION['connected'] != 2){
                echo '<a href="../index.php"><input class="submit" type="button" value="DECONNEXION"></a>';
            } else {
                echo '<div>';
                echo '<a href="../index.php"><input class="submit" type="button" value="DECONNEXION"></a>';
                echo '<a href="./modif_compte_gest.php"><input class="submit" type="button" value="Modifier"></a>';
                echo '</div>';
            }
            ?>
        </div>
        <?php
            if ($_SESSION['connected']==1) {
                echo '<form id="form_hebergement" method="POST" action="modif_compte.php">';
                echo "<p class='titre_hebergement'>Lien d'hébergement de votre code</p>";
                if ($_SESSION['lien_code']=="") {
                    echo "<p>Votre lien n'est pas enregistré</p>";
                } else {
                    echo $_SESSION['lien_code'];
                }
                echo '<br>';
                echo '<p class="titre_hebergement">Inserez votre lien !</p>';
                echo '<input id="insertion_lien" name="lien" type="text" placeholder="insérez votre lien ici !">';
                echo '<br>';
                echo '<input class="submit" type="submit" value="AJOUTER">';
                echo '</form>';
            }
        ?>
    </div>
</div>
<?php
include 'footer.php';
?>