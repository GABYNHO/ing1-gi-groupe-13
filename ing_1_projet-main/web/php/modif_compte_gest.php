<?php
session_start();
include 'squelette_html.php';
include 'header.php';
?>
<div id="mid"> 
    <div id="fond_page_connexion">
        <p id="titre_connexion">Modifier vos informations</p>
        <div class="bloc_forms">
            <!-- formulaire d'inscription -->
            <form id="form_inscription" method="POST" action="modifier_information.php">
                <p class="titre_form">Nouveau ? Créez votre compte !</p>
                <table>
                    <tr>
                        <td><label>Nom :</label></td>
                        <td><input type="text" name="nom" id="nom" value="<?php echo $_SESSION['nom']; ?>"><br></td>
                    </tr>
                    <tr>
                        <td><label>Prénom :</label></td>
                        <td><input type="text" name="prenom" id="prenom" value="<?php echo $_SESSION['prenom']; ?>"><br></td>
                    </tr>
                    <tr>
                        <td><label>Téléphone :</label></td>
                        <td><input type="tel" name="tel" id="tel" value="<?php echo $_SESSION['tel']; ?>"><br></td>
                    </tr>
                    <tr>
                        <td><label>Entreprise :</label></td>
                        <td><input type="text" name="entreprise" id="entreprise" value="<?php echo $_SESSION['entreprise']; ?>"><br></td>
                    </tr>
                    <tr>
                        <td><label>Mot de passe :</label></td>
                        <td><input required type="password" name="mdp" id="mot_de_passe" placeholder="Nouveau mot de passe"><br></td>
                        
                    </tr>
                </table>
                <input class="submit" type="submit" value="ENVOYER">
            </form>
        </div>
    </div>
</div>
<?php
include 'footer.php';
?>

    
<script>
    function chiffre() {
    var textarea = document.getElementById("tel-inscription");
    var valeur = textarea.value;
    var nombre = valeur.replace(/[^0-9]/g, ''); // Supprime tous les caractères non numériques
    
    if (valeur !== nombre) {
        textarea.value = nombre;
    }
    }

</script>
