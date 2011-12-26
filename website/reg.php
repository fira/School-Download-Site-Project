<?php
	/* Affichage de la page par popup de fenêtre modale JQuery
	Donc pas de header de page */

	
	/* NOTE: Si il n'est pas possible d'ouvrir des liens a l'intérieur de la fenêtre modale,
	il faudrait alors renvoyer l'utilisateur sur la page d'index pour le traitement de l'inscription
	plutôt que sur cette page (vu qu'elle ne contiens pas le header/footer) */
	

	/* Validation de l'inscription */
	if(isset($_POST['user'], $_POST['password'], $_POST['email'], $_POST['firstname'], $_POST['lastname'])) {
	
		/*
		 TODO Séquence d'inscription: 
			Vérification des valeurs des fields
			Connection a la BDD 
			Envoi de la requête d'ajout d'utilisateur (utilisation de la fonction de la BDD)
			Confirmation de l'ajout de l'entrée
			Affichage d'un splash-screen pour informer l'utilisateur de l'inscription réussie
			Si possible, log-in l'utilisateur, fermer automatiquement la fenêtre modale, et rafraichir la page
		*/




	/* Si on n'a pas déjà validé le formulaire, alors on l'affiche */
	} else {
?>

	<form action='reg.php' method='post'>

		<fieldset>
			<legend>Login Information</legend><br/>
			<table class='regtable'>
				<tr>
					<td class='regcol'>User Name:</td>
					<td class='regcol'><input type='text' name='user'/></td>
				</tr>
				<tr>
					<td class='regcol'>Password:</td>
					<td class='regcol'><input type='password' name='password'/></td>
				</tr>
			</table>
		</fieldset>
		<br/><br/>

		<fieldset>
			<legend>Personal Information</legend><br/>
			<table class='regtable'>
				<tr>
					<td class='regcol'>E-mail Address:</td>
					<td><input type='text' name='email'></td>
				</tr>
				<tr>
					<td class='regcol'>First Name:</td>
					<td><input type='text' name='firstname'></td>
				</tr>
				<tr>
					<td class='regcol'>Last Name:</td>
					<td><input type='text' name='lastname'></td>
				</tr>
			</table>
		</fieldset>
		<br/><br/>

	<input class='regbutton' type='submit' value='Go!'/>	
	</form>

<?php } ?> 
