<!DOCTYPE html>
<head>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <meta http-equiv="Content-Type"
          content="text/html;charset=utf-8"/>
    <title>Shoutbox</title>
</head>

<?php
/**
 * Created by PhpStorm.
 * User: Geoffrey
 * Date: 22/01/14
 * Time: 09:30
 */
session_start();
include("Menu.php");
afficherBanniere();


if (!isset($_SESSION['iduser'])) {
    header("Location : index.php");
}

$connection = mysqli_connect($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);

// Traitement envoi

if (isset($_POST['contenu']) && !empty($_POST['contenu'])) {
    $req = "INSERT INTO shoutbox (idPersonne, Message, DateMessage) VALUES(" . $_SESSION['iduser'] . ",'" . $_POST['contenu'] . "','" . date('Y-m-d H:m:i') . "')";
    mysqli_query($connection, $req) or die ("Il y a un probleme avec l'envoi de message ");
}
echo "<div id='shoutbox'>";
//Reception des messages


$req = "SELECT * FROM shoutbox INNER JOIN utilisateur ON shoutbox.idPersonne = utilisateur.idUtilisateur ORDER BY shoutbox.DateMessage DESC";
$res = mysqli_query($connection, $req);

if (mysqli_num_rows($res) == 0)
    echo "Il n'y a pas de message, soyez le premier à communiquer";

else {

    echo "<ul id=listeShout>";
    while ($ligne = mysqli_fetch_object($res)) {
        echo "<li>";
        echo "<p id= messageShout> $ligne->Message </p>";
        echo "<p id= infoMessage> - par $ligne->Prenom $ligne->Nom le $ligne->DateMessage";
        echo "</li>";
    }
    echo "</ul>";
}


// Formulaire envoi
echo "<div id='shoutAction'>
<form method=post name='formShout'>
<textarea name='contenu' rows = 10 cols=100>Entrez votre message ici</textarea><br/>
<a href='Shoutbox.php'><input type='button' value='Rafraichir' /> </a>
<input type=submit name='envoyer'/>
</form>
</div>";

echo "</div>";
