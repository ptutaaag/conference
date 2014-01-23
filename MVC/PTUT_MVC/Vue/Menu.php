
<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type"
          content="text/html;charset=utf-8"/>
    <title>Menu</title>
</head>
<body>
<?php echo '<link rel="stylesheet" type="text/css" href="../Style/Style1.css"/>';
echo'
 <div>
    <img src="../Images/imageaccueil.jpg" alt="Image d\'accueil" title="Cliquer pour faire défiler les images"/>
</div>

</div>
<ul id="menu">
    <li><a href="Menu.php">Accueil</a></li>
    <li><a href="ListeEvenement.php">Liste des évènements</a></li>
    <li><a href="ListeDesInscrits.php">Liste des inscrits</a></li>
';

if (isset($_SESSION['iduser'])) {

    echo "<li><a href=\"MaPage.php\">Profil</a></li>";
    echo "<li><a href=\"Message.php\">Messagerie (" . $nb_mess[0] . ")</a></li>";
    echo "<li><a href='Shoutbox.php'>Chat</a></li>";
    echo "<li><a href=\"Contacter.php\">Contact</a></li>";
    echo "<li><a href=\"Deconnexion.php\">Déconnexion</a></li>";
} else {
    echo "<li><a href=\"Connexion.php\">Connexion</a></li>";
    echo "<li><a href=\"Inscription.php\">Inscription</a></li>";
}
?>

</ul>
</div><br/><br/>
</body>