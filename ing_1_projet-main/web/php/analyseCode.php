<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>PyRéNerd</title>
  <link rel="icon" href="../img/ialog.png">
  <link rel="stylesheet" href="../css/main.css">
  <script type="text/javascript" src="../js/FileSaver.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
  <?php
  session_start();
  include 'header.php';
  ?>

  <div id="mid">
    <div id="zone_ana">
    <input type="file" style="margin-right:20px;margin-left:20px" id="fileInput">
    <select id="selectOptions" onchange="handleFonctionSelect()">
      <option onclick="validerChoix()" value="Fonction 1">Fonction 1</option>
      <option onclick="validerChoix()" value="Fonction 2">Fonction 2</option>
    </select>
    <div id="motsChercher" style="display: none;">
      <label for="mots">Mots à chercher :</label>
      <input type="text" id="keywordsInput" name="keywordsInput">
    </div>
    <button class="submit" id="importButton">Analyser</button>
    <button class="submit" id="downloadButton">Télécharger le fichier JSON</button>
    <!-- Faire le graphique -->
    <div class="chart-container" style=" width: 50%; margin:20px ; display:flex ; flex-direction: row;">
      <canvas id="myChart1"></canvas>
      <canvas id="myChart2"></canvas>
    </div>
    </div>
  </div>

  <?php
  include 'footer.php';
  ?>




  <!-- Le script -->
  <script>
    function handleFonctionSelect() {
      var selectElement = document.getElementById("selectOptions");
      var keywordsContainer = document.getElementById("motsChercher");
      if (selectElement.value === "Fonction 2") {
        keywordsContainer.style.display = "block";
      } else {
        keywordsContainer.style.display = "none";
      }
    }
  </script>

  <script>
    function validerChoix() {
      var select = document.getElementById("selectOptions");
      var choix = select.value;
      return choix
    }
  </script>



  <script>
    document.getElementById('importButton').addEventListener('click', () => {
      const fileInput = document.getElementById('fileInput');

      // Vérifiez si un fichier a été sélectionné
      if (fileInput.files.length > 0) {
        const file = fileInput.files[0];

        // Utilisez l'objet FileReader pour lire le contenu du fichier
        const reader = new FileReader();
        reader.onload = handleFileContent;
        reader.readAsText(file);
      }
    });
  </script>


  <script>
    let data;
    function handleFileContent(event) {
      const fileContent = event.target.result;
      var choix = validerChoix();
      if (choix == 'Fonction 1') {
        // Effectuez une demande AJAX à votre API REST en Java
        fetch('http://localhost:8001/api', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: fileContent
          })
          .then(response => response.json())
          .then(result => {
            // Traitez la réponse de l'API REST
            data = result;
            //saveAs(result, 'result.json');
            afficherGraphique(result);
          })
          .catch(error => {
            console.error(error);
          });
      } else if (choix == 'Fonction 2') {
        var keywordsInput = document.getElementById("keywordsInput");
        var keywordsValue = keywordsInput.value.replace(/ /g, '');
        var url = "http://localhost:8001/api?keywords=" + keywordsValue;
        fetch(url, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: fileContent
          })
          .then(response => response.json())
          .then(result => {
            data = result;
            // Traitez la réponse de l'API REST
            afficherGraphique(result);
          })
          .catch(error => {
            console.error(error);
          });

      } else {
        var error = "Choix non valide";
        console.error(error);
      }
      //Télecharger le fichier json 
      var downloadButton = document.getElementById('downloadButton');
      downloadButton.style.display = 'block';
      downloadButton.addEventListener('click', function() {
        var blob = new Blob([JSON.stringify(data)], {
          type: 'application/json'
        });

        saveAs(blob, 'result.json');
      });
    }
  </script>


  <!-- afficher les graphes -->
  <script>
    function afficherGraphique(data) {
      // Récupérer les valeurs des clés du fichier JSON
      var labels = Object.keys(data);
      // Récupérer les valeurs des clés du fichier JSON
      var values = Object.values(data);

      ctx1 = document.getElementById('myChart1');

      let barChart1 = Chart.getChart(ctx1); // Vérifier si une instance existe déjà

      if (barChart1) {
        barChart1.destroy();
      }

      barChart1 = new Chart(ctx1, {
        type: 'bar',
        data: {
          labels: labels,
          datasets: [{
            data: values,
            backgroundColor: 'red',
          }]
        },
        options:{
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              position: 'top'
            }
          },
          layout: {
            padding: {
              left: 10,
              right: 10,
              top: 10,
              bottom: 10
            }
          },
          scales: {
            x: {
              ticks: {
                color: 'black',
                font: {
                  size: 10,
                  weight: 'bold'
                }
              }
            },
            y: {
              ticks: {
                color: 'black',
                font: {
                  size: 10,
                  weight: 'bold'
                }
              }
            }
          },
          canvas: {
            width: '400px',
            height: '600px'
          }
        }
      });
    }
  </script>
