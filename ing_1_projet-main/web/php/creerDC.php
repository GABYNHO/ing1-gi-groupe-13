<?php

session_start();

include 'squelette_html.php';
include 'header.php';
include '../bdd/bdd.php';

bdd_connexion();

?>

<html>

<head>
    <div id="mid">
        <title>Formulaire Data Challenge</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
    $(document).ready(function () {
        $("#nombre_projets").change(function () {
            var nombreProjets = $(this).val();
            var projetsContainer = $("#projets_container");
            projetsContainer.empty();

            for (var i = 1; i <= nombreProjets; i++) {
                var projetHtml = `
                    <h2>Projet Data ${i} :</h2>
                    <table class="tableauBord">
                        <tr>
                            <td>
                                <label for="libelle_projet${i}">Libellé :</label>
                            </td>
                            <td>
                                <input type="text" name="libelle_projet${i}" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="description_projet${i}">Description sommaire :</label>
                            </td>
                            <td>
                                <textarea name="description_projet${i}" required></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="image_projet${i}">Image liée au projet ou au porteur du projet :</label>
                            </td>
                            <td>
                                <input type="text" name="image_projet${i}" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="coordonnees_projet${i}">Coordonnées des contacts liés au porteur de projet :</label>
                            </td>
                            <td>
                                <input type="text" name="coordonnees_projet${i}" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="ressources_projet${i}">Liste de ressources spécifiques au projet :</label>
                            </td>
                            <td>
                                <input type="text" name="ressources_projet${i}" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="url_description_projet${i}">URL d'accès aux fichiers de description et des données du Data Challenge :</label>
                            </td>
                            <td>
                                <input type="text" name="url_description_projet${i}" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="url_video_projet${i}">URL vidéo de présentation du projet :</label>
                            </td>
                            <td>
                                <input type="text" name="url_video_projet${i}" required>
                            </td>
                        </tr>
                        <tr> <hr> </tr>
                    </table>
                `;
                projetsContainer.append(projetHtml);
            }
        });
    });
</script>

        <script>
            function validateForm() {
                var dateDebut = document.getElementById("date_debut").value;
                var dateFin = document.getElementById("date_fin").value;

                if (dateDebut >= dateFin) {
                    alert("La date de début doit être inférieure à la date de fin.");
                    return false;
                }
            }
        </script>
</head>

<body>
    <div style="margin-left:10%;margin-bottom:20px">
        <h1>Formulaire Data Challenge</h1>
        <form action="traitementDC.php" method="POST" onsubmit="return validateForm();">
            <table class="tableauBord">
                <tr>
                    <td>
                        <label for="libelle">Libellé :</label>
                    </td>
                    <td>
                        <input type="text" name="libelle" id="libelle" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="mail">Mail du gestionnaire :</label>
                    </td>
                    <td>
                        <input type="text" name="mail" id="mail" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="desc">Description du DataChallenge :</label>
                    </td>
                    <td>
                        <input type="text" name="desc" id="desc" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="date_debut">Date de début :</label>
                    </td>
                    <td>
                        <input type="date" name="date_debut" id="date_debut" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="date_fin">Date de fin :</label>
                    </td>
                    <td>
                        <input type="date" name="date_fin" id="date_fin" required>
                    </td>
                </tr>
            </table>

            <h2>Actions pour les Projets Data :</h2>
            <label for="nombre_projets">Nombre de projets à créer :</label>
            <select id="nombre_projets" name="nombre_projets">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select><br>

            <div id="projets_container">
                <h2>Projet Data 1 :</h2>
                <table class="tableauBord">
                    <tr>
                        <td>
                            <label for="libelle_projet1">Libellé :</label>
                        </td>
                        <td>
                            <input type="text" name="libelle_projet1" id="libelle_projet1" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="description_projet1">Description sommaire :</label>
                        </td>
                        <td>
                            <textarea name="description_projet1" id="description_projet1" required></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="image_projet1">Image liée au projet ou au porteur du projet :</label>
                        </td>
                        <td>
                            <input type="text" name="image_projet1" id="image_projet1" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="coordonnees_projet1">Coordonnées des contacts liés au porteur de projet
                                :</label>
                        </td>
                        <td>
                            <input type="text" name="coordonnees_projet1" id="coordonnees_projet1" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="ressources_projet1">Liste de ressources spécifiques au projet :</label>
                        </td>
                        <td>
                            <input type="text" name="ressources_projet1" id="ressources_projet1" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="url_description_projet1">URL d'accès aux fichiers de description et des données
                                du Data Challenge :</label>
                        </td>
                        <td>
                            <input type="text" name="url_description_projet1" id="url_description_projet1" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="url_video_projet1">URL vidéo de présentation du projet :</label>
                        </td>
                        <td>
                            <input type="text" name="url_video_projet1" id="url_video_projet1" required>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="submit-row">
                <input type="submit" value="Soumettre">
            </div>
        </form>
</body>
</div>

</html>
