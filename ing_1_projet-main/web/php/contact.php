<?php
session_start();
include 'squelette_html.php';
include 'header.php';
?>
<div id="mid">
<div id="fond_page_contact"> 
	<table class="form_contact" border="0">
		<tbody>
			<form method="get" action="contact_submit.php">
				<p id="titre_contact">Ecrivez-nous</p>

				<tr>
					<td>Date du contact</td><td><input type="date" id="dateC" name="dateC" required></td>
				</tr>
				<tr>
					<td>Nom</td><td><input type="text" id="nom" name="nom" required minlength="1" maxlength="20" size="20" placeholder="Entrez votre nom"></td>
				</tr>
				<tr>
					<td>Prenom</td><td><input type="text" id="prenom" name="prenom" required minlength="1" maxlength="20" size="20" placeholder="Entrez votre prenom"></td>
				</tr>
				<tr>
					<td>Email</td><td><input type="text" id="email" name="email" required minlength="1" maxlength="30" size="20" placeholder="monmail@monsite.org" onInput=verif()><label id="lMail">      Format : monmail@monsite.org</label></td>
				</tr>
				<tr>
					<td>Genre</td><td><input type="radio" name="genre" id="femme" value="femme"><label for="femme">Femme</label>
					<input type="radio" name="genre" id="homme" value="homme"><label for="homme">Homme</label></td>
				</tr>
				<tr>
					<td>Statut</td>
					<td>
						<select name="choix" id="choix" required>
						<option value="">- - Sélectionnez votre statut - -</option>
						<option value="Etudiant">Etudiant</option>
						<option value="Salarié">Salarié</option>
						<option value="Autre">Autre</option>
					</td>
				</tr>
				<tr>
					<td>Sujet</td><td><input type="text" id="sujet" name="sujet" required minlength="1" maxlength="50" size="20" placeholder="Entrez le sujet de votre mail"></td>
				</tr>
				<tr>
					<td>Contenu</td><td><textarea id="contenu" name="contenu" rows="5" cols="50" placeholder="Tapez ici votre mail" required></textarea></td>
				</tr>
				<tr>
					<td></td><td></td><td><input type="submit" class="submit" value="Envoyer"></td><td></td>
				</tr>
			</form>
		</tbody>
	</table>
</div>
</div>
<?php
include 'footer.php';
?>
