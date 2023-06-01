function validateDate() {
    var dateDebut = document.getElementById('DateDeb').value;
    var dateFin = document.getElementById('DateFin').value;
  
    var dateDebutObj = new Date(dateDebut);
    var dateFinObj = new Date(dateFin);
  
    if (dateDebutObj >= dateFinObj) {
      alert("La date de début doit être inférieure à la date de fin.");
      return false; 
    }
    return true;
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

