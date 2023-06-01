<div id="barre_nav">
	<a href="accueil.php"><img src="../img/ialog.png" alt="Logo IA_Pau"></a>
    <a class="boutton_header" href="accueil.php">Accueil</a>
	<?php
		if ($_SESSION['connected']==0) {
			echo '<a class="boutton_header" href="datachallenge.php">Info Data Challenge</a>';
			echo '<a class="boutton_header" href="databattle.php">Info Data Battle</a>';
			echo '<a class="boutton_header" href="connexion.php">Connexion</a>';
		} else {
			echo '<a class="boutton_header" href="datachallenge.php">Data Challenge</a>';
			echo '<a class="boutton_header" href="databattle.php">Data Battle</a>';
			echo '<a class="boutton_header" href="messagerie.php">Messagerie</a>';
			if ($_SESSION['connected']==1) {
				echo '<a class="boutton_header" href="mon_equipe.php">Mon Équipe</a>';
			}
			if ($_SESSION['connected']>1) {
				echo '<a class="boutton_header" href="analyseCode.php">Analyse code</a>';
				
			}
			if ($_SESSION['connected']==3) {
				echo '<a class="boutton_header" href="gererUtilisateurs.php">Utilisateurs</a>';

			}
			echo '<a class="boutton_header" href="mon_compte.php">Mon Compte</a>';
		}
	?>
</div>
