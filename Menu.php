<?php
/**
 * Created by PhpStorm.
 * User: Geoffrey
 * Date: 21/01/14
 * Time: 16:24
 */
function afficherBanniere()
{
    echo '<head><link rel="stylesheet" type="text/css" href="Style/Style1.css"/></head>';
    echo '<div>
    <img src="Images/imageaccueil.jpg" alt="Image d\'accueil" title="Cliquer pour faire défiler les images"/>
</div>';
    echo '
</div>
<ul id="menu">
    <li><a href="index.php">Accueil</a></li>
    <li><a href="ListeDesEvenements.php">Liste des évènements</a></li>
    <li><a href="ListeDesInscrits.php">Liste des inscrits</a></li>';
    if (isset($_SESSION['iduser'])) {
        $req = "SELECT COUNT(lu) FROM message WHERE id_destinataire='" . $_SESSION['iduser'] . "' AND lu=0";
        $db = new mysqli($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
        $res = mysqli_query($db, $req) or die(mysqli_connect_error());
        $nb_mess = mysqli_fetch_row($res);
        mysqli_close($db);
        echo "<li><a href=\"PageUtilisateur.php\">Profil</a></li>";
        echo "<li><a href=\"MessageUser.php\">Messagerie (" . $nb_mess[0] . ")</a></li>";
        echo "<li><a href='Shoutbox.php'>Chat</a></li>";
        echo "<li><a href=\"Deconnexion.php\">Déconnexion</a></li>";
    } else {
        echo "<li><a href=\"Connexion.php\">Connexion</a></li>";
        echo "<li><a href=\"Inscription.php\">Inscription</a></li>";
    }
    echo '
</ul>
</div><br/><br/>';
}