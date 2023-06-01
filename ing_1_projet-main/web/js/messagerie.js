function supprimerMessage(index) {
    // Envoyer une requête AJAX pour supprimer le message côté serveur
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'supprimer_message.php?index=' + index, true);
    xhr.onload = function () {
    if (xhr.status === 200) {
        // Recharger la page pour mettre à jour les messages
        window.location.reload();
        }
    };
    xhr.send();
}


function alerter(){
    alert("Il manque des informations. Veuillez remplir tous les champs de date et d'heure.");
}


function restriction(id, taille) {
    var textarea = document.getElementById(id);
    var contenuTextarea = textarea.value;

    if (contenuTextarea.length > taille) {
        alert('Message trop long');
        textarea.value = contenuTextarea.substring(0, taille);
    }

    textarea.addEventListener('input', function(event) {
        var value = event.target.value;
        if (value.length > taille) {
            event.preventDefault();
            textarea.value = value.substring(0, taille);
        }
    });
}

