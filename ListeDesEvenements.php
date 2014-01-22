<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<head>
    <meta http-equiv="Content-Type"
          content="text/html;charset=utf-8"/>
    <title>Liste des évènements</title>
</head>


<?php
include_once("Evenement.php");
include("Menu.php");

afficherBanniere();


$connection = mysqli_connect($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
$req = "SELECT * from evenement inner join utilisateur on evenement.idCreateur = utilisateur.idUtilisateur";
$res = mysqli_query($connection, $req) or die ("Erreur dans la récupération des evenements");

while ($ligne = mysqli_fetch_object($res)) {
    echo "<div class='BoutonEvenement'><a href='PageEvenement.php?id=" . $ligne->idEvenement . "'>" . $ligne->NomEvent . "<a>
    <p> - présenté par " . $ligne->Nom . " " . $ligne->Prenom . "</p></div>";
}
mysqli_close($connection);
?>
