function toggleInfo(id) {
  var infoElement = document.getElementById(id);
  infoElement.classList.toggle('open');
}

function toggleInfo(divNumber) {
  var info = document.getElementById("additional-info-" + divNumber);
  info.classList.toggle("active");
}

function onYouTubeIframeAPIReady() {
  // Recherche de tous les éléments avec la classe 'video-player'
  var players = document.querySelectorAll('.video-player');

  // Parcourir chaque élément
  for (var i = 0; i < players.length; i++) {
    var playerElement = players[i];
    var videoId = playerElement.getAttribute('data-video-id');

    // Création d'un lecteur vidéo pour chaque élément
    var player = new YT.Player(playerElement, {
      height: '315',
      width: '560',
      videoId: videoId,
    });
  }
}

var projetCount = 0;

function ajouterProjet() {
  projetCount++;

  var container = document.getElementById("projets_container");

  var projetDiv = document.createElement("div");
  projetDiv.id = "projet_" + projetCount;

  var titreProjet = document.createElement("h4");
  titreProjet.textContent = "Projet Data #" + projetCount;
  projetDiv.appendChild(titreProjet);

  var libelleProjet = document.createElement("label");
  libelleProjet.textContent = "Libellé :";
  var inputLibelleProjet = document.createElement("input");
  inputLibelleProjet.type = "text";
  inputLibelleProjet.name = "libelle_projet_" + projetCount;
  projetDiv.appendChild(libelleProjet);
  projetDiv.appendChild(inputLibelleProjet);
  projetDiv.appendChild(document.createElement("br"));

  var descriptionProjet = document.createElement("label");
  descriptionProjet.textContent = "Description :";
  var textareaDescriptionProjet = document.createElement("textarea");
  textareaDescriptionProjet.name = "description_projet_" + projetCount;
  projetDiv.appendChild(descriptionProjet);
  projetDiv.appendChild(textareaDescriptionProjet);
  projetDiv.appendChild(document.createElement("br"));

  var imageProjet = document.createElement("label");
  imageProjet.textContent = "Image :";
  var inputImageProjet = document.createElement("input");
  inputImageProjet.type = "text";
  inputImageProjet.name = "image_projet_" + projetCount;
  projetDiv.appendChild(imageProjet);
  projetDiv.appendChild(inputImageProjet);
  projetDiv.appendChild(document.createElement("br"));

  var emailProjet = document.createElement("label");
  emailProjet.textContent = "E-mail :";
  var inputEmailProjet = document.createElement("input");
  inputEmailProjet.type = "email";
  inputEmailProjet.name = "email_projet_" + projetCount;
  projetDiv.appendChild(emailProjet);
  projetDiv.appendChild(inputEmailProjet);
  projetDiv.appendChild(document.createElement("br"));

  var urlVideoProjet = document.createElement("label");
  urlVideoProjet.textContent = "URL vidéo :";
  var inputUrlVideoProjet = document.createElement("input");
  inputUrlVideoProjet.type = "text";
  inputUrlVideoProjet.name = "url_video_projet_" + projetCount;
  projetDiv.appendChild(urlVideoProjet);
  projetDiv.appendChild(inputUrlVideoProjet);
  projetDiv.appendChild(document.createElement("br"));

  var urlFichiersProjet = document.createElement("label");
  urlFichiersProjet.textContent = "URL fichiers :";
  var inputUrlFichiersProjet = document.createElement("input");
  inputUrlFichiersProjet.type = "text";
  inputUrlFichiersProjet.name = "url_fichiers_projet_" + projetCount;
  projetDiv.appendChild(urlFichiersProjet);
  projetDiv.appendChild(inputUrlFichiersProjet);
  projetDiv.appendChild(document.createElement("br"));

  var boutonSupprimer = document.createElement("button");
  boutonSupprimer.textContent = "Supprimer";
  boutonSupprimer.onclick = function () {
    container.removeChild(projetDiv);
  };

  projetDiv.appendChild(boutonSupprimer);

  container.appendChild(projetDiv);
}


function verifierChamps() {
  var projets = document.querySelectorAll('[id^="projet_"]');
  
  for (var i = 0; i < projets.length; i++) {
    var projet = projets[i];
    var champs = projet.querySelectorAll('input[type="text"], input[type="email"], textarea');

    for (var j = 0; j < champs.length; j++) {
      var champ = champs[j];
      if (champ.value === '') {
        alert('Veuillez remplir tous les champs des projets data.');
        return false; // Empêcher l'envoi du formulaire
      }
    }
  }
  
  return true; // Autoriser l'envoi du formulaire
}

function afficherDetails(idDC) {
  var detailsRow = document.getElementById('details-' + idDC);
  if (detailsRow.style.display === 'none') {
      detailsRow.style.display = 'table-row';
  } else {
      detailsRow.style.display = 'none';
  }
}

