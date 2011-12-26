<?php
	/* Page principale du site */

	/* TODO Chargement des paramètres du site web par un include d'une autre page
	qui se chargera de lire le fichier de paramètres XML */

	/* NOTE Tout ce qui est traitement d'entrée utilisateur doit aller ici
	Idem pour login/etc, vu que les session_start() et création de cookies doivent être
	utilisés avant l'envoie du header de page */
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/html4/loose.dtd">

<html>
	<head>
		<title></title>
		<link href="style.css" rel="stylesheet" type="text/css" />

		<!-- TODO Rajouter les meta-tags ici -->		
	</head>

	<body>
<?php
		
		/* La page sera divisée en plusieurs onglets, chaque onglet ayant un ID particulier passé par GET
		pour afficher seulement la partie souhaitée par l'utilisateur.
		On pourrait utiliser JQuery pour avoir plusieurs onglets sans recharger la page,
		mais il n'est pas utile de charger toutes les informations de l'utilisateur 
		si on n'en as pas besoin ! */

?>
	</body>
</html>
