<?php
session_start();
include 'squelette_html.php';
include 'header.php';
?>
<div id="mid"> 
    <div id="fond_page_connexion">
        <p id="titre_connexion">REJOIGNEZ IA PAU !</p>
        <div class="bloc_forms">
            <!-- formulaire d'inscription -->
            <form id="form_inscription" method="POST" action="creation_compte.php">
                <p class="titre_form">Nouveau ? Créez votre compte !</p>
                <table>
                    <tr>
                        <td><label>Nom :</label></td>
                        <td><input required type="text" id="nom-inscription" name="nom" placeholder="insérez votre nom"></td>
                    </tr>
                    <tr>
                        <td><label>Prénom :</label></td>
                        <td><input required type="text" id="prenom-inscription" name="prenom" placeholder="insérez votre prénom"></td>
                    </tr>
                    <tr>
                        <td><label>Email :</label></td>
                        <td><input required type="text" id="email-inscription" name="email" placeholder="insérez votre email"></td>
                    </tr>
                    <tr>
                        <td><label>Téléphone :</label></td>
                        <td><input required type="text" id="tel-inscription" name="tel" placeholder="insérez votre numéro de téléphone" onInput="chiffre()"></td>
                    </tr>
                    <tr>
                        <td><label>Niveau d'Étude :</label></td>
                        <td>
                            <select id="niv_etude" name="etude">
                                <option value="L1">Licence 1</option>
                                <option value="L2">Licence 2</option>
                                <option value="L3">Licence 3</option>
                                <option value="M1">Master 1</option>
                                <option value="M2">Master 2</option>
                                <option value="D">Doctorat</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Ecole :</label></td>
                        <td><input required type="text" id="ecole-inscription" name="ecole" placeholder="insérez votre école"></td>
                    </tr>
                    <tr>
                        <td><label>Ville :</label></td>
                        <td><input required type="text" id="ville-inscription" name="ville" placeholder="insérez votre ville"></td>
                    </tr>
                    <tr>
                        <td><label>Mot de passe :</label></td>
                        <td><input required type="password" id="mdp-inscription" name="mdp" placeholder="insérez votre mot de passe"></td>
                    </tr>
                </table>
                <input class="submit" type="submit" value="ENVOYER">
            </form>
            
            <!-- formulaire de connexion -->
            <form id="form_connexion" method="POST" action="verif_connexion.php">
                <p class="titre_form">Déjà membre ? Connectez-vous !</p>
                <table>
                    <tr>
                        <td><label>Statut :</label></td>
                        <td>
                            <input id="etudiant" type="radio" value="etudiant" name="statut"> Étudiant
                            <input id="gestionnaire" type="radio" value="gestionnaire" name="statut"> Gestionnaire
                            <input id="admin" type="radio" value="admin" name="statut"> Admin
                        </td>
                    </tr>
                    <tr>
                        <td><label>Email :</label></td>
                        <td><input required type="text" id="email-connexion" name="email" placeholder="insérez votre email"></td>
                    </tr>
                    <tr>
                        <td><label>Mot de passe :</label></td>
                        <td><input required type="password" id="mdp-connexion" name="mdp" placeholder="insérez votre mot de passe"></td>
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
