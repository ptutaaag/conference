
<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type"
          content="text/html;charset=utf-8"/>
    <title>Menu</title>
</head>
<?php echo '<link rel="stylesheet" type="text/css" href="../Style/Style1.css"/>';
echo'


</div>
<div id="menu">
<ul>
    <li><a class=button href="Menu.php">Accueil</a></li>
    <li><a class=button href="ListeEvenement.php">Liste des évènements</a></li>
    <li><a class=button href="ListeDesInscrits.php">Liste des inscrits</a></li>
';

if (isset($_SESSION['iduser'])) {

    echo "<li><a class=button href=\"MaPage.php\">Profil</a></li>";
    echo "<li><a class=button href=\"Message.php\">Messagerie (" . $nb_mess[0] . ")</a></li>";
    echo "<li><a class=button href='Shoutbox.php'>Chat</a></li>";
    echo "<li><a class=button href=\"Contacter.php\">Contact</a></li>";
    echo "<li><a class=button href=\"Deconnexion.php\">Déconnexion</a></li>";
} else {
    echo "<li><a class=button href=\"Connexion.php\">Connexion</a></li>";
    echo "<li><a class=button href=\"Inscription.php\">Inscription</a></li>";
}
?>
</ul>
</div>
</div><br/><br/>
