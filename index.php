<!DOCTYPE html>
<?php
session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" type="text/css" href="Style/Style1.css"/>
    <title>Agenda</title>
</head>
<body>
<div>
    <img src="Images/imageaccueil.jpg" alt="Image d'accueil" title="Cliquer pour faire défiler les images"/>
</div>

</div>
<ul id="menu">
    <li><a href="index.php">Accueil</a></li>
    <li><a href="ListeDesEvenements.php">Liste des évènements</a></li>
    <li><a href="ListeDesInscrits.php">Liste des inscrits</a></li>
	<?php if(isset($_SESSION['iduser'])){
	echo "<li><a href=\"PageUtilisateur.php\">Membres</a></li>";
	echo "<li><a href=\"MessageUser.php\">Messagerie</a></li>";
	echo "<li><a href=\"Deconnexion.php\">Déconnexion</a></li>";
	}else{
    echo "<li><a href=\"Connexion.php\">Connexion</a></li>";
    echo "<li><a href=\"Inscription.php\">Inscription</a></li>";
	}?>
</ul>
</div><br/>

</body>
</html>