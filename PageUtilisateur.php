<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
session_start();
include("Menu.php");
afficherBanniere();

if (!isset($_SESSION['login'])) {

    include_once("Utilisateur.php");

    $connection = mysqli_connect($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
    $req = "SELECT * FROM utilisateur";
    $res = mysqli_query($connection, $req) or die ("Erreur dans la récupération des inscrits");

    while ($ligne = mysqli_fetch_object($res)) {
        echo $ligne->Nom . " " . $ligne->Prenom . "<br/>";
    }

    exit();
}
if (!isset($_GET['id']) || $_GET['id'] == $_SESSION['iduser']) {
    $req = "SELECT Nom, Prenom, Mail, Avatar, DateInscription FROM utilisateur WHERE Mail like '" . $_SESSION['login'] . "'";
    $db = new mysqli($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
    $res = mysqli_query($db, $req) or die(mysqli_connect_error());
    while ($resultat = mysqli_fetch_object($res)) {
        $Nom = $resultat->Nom;
        $Prenom = $resultat->Prenom;
        $Mail = $resultat->Mail;
        $Avatar = $resultat->Avatar;
        $Date = $resultat->DateInscription;
    }
    mysqli_close($db);
} else {
    $req = "SELECT Nom, Prenom, Mail, Avatar, DateInscription FROM utilisateur WHERE idUtilisateur like '" . $_GET['id'] . "'";
    $db = new mysqli($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
    $res = mysqli_query($db, $req) or die(mysqli_connect_error());
    while ($resultat = mysqli_fetch_object($res)) {
        $Nom = $resultat->Nom;
        $Prenom = $resultat->Prenom;
        $Mail = $resultat->Mail;
        $Avatar = $resultat->Avatar;
        $Date = $resultat->DateInscription;
    }
    mysqli_close($db);
}
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
    <meta http-equiv="Content-Type"
          content="text/html;charset=utf-8"/>
    <title>Informations Utilisateur</title>
</head>
<body>
<?php
if (!isset($_GET['id']) || $_GET['id'] == $_SESSION['iduser'])
    echo "<p>Bienvenue " . $Prenom . " " . $Nom . "!</p>"; ?> <br/>
<img src="<?php echo $Avatar; ?>"/>
<br/>
<?php
echo "Nom: " . $Nom . "<br/>Prénom: " . $Prenom;
echo "<br/>Mail: " . $Mail;
echo "<br/>Date d'inscription: " . $Date . "<br/>";
if (!isset($_GET['id']) || $_GET['id'] == $_SESSION['iduser']) {

    echo "<li><a href=\"\">Modification</a><ul><li><a href=\"ModifUserMail.php\">Mail</a></li><li><a href=\"ModifUserMDP.php\">Mot de passe</a></li><li><a href=\"ModifUserAvatar.php\">Avatar</a></li></ul></li>";
    echo "<a href=\"Agenda.php\"><input type=\"button\" value=\"Créer un emploi du temp\"\></a>";
}
?>
<a href="index.php"><input type="button" value="Accueil"/></a>
</body>
</html>