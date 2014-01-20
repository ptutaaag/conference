<?php
include_once("Utilisateur.php");

$connection = mysqli_connect($_SESSION['db_host'],$_SESSION['db_user'],$_SESSION['db_password'],$_SESSION['db_dbname']);
$req = "SELECT * FROM utilisateur";
$res = mysqli_query($connection, $req) or die ("Erreur dans la récupération des inscrits");

while ($ligne = mysqli_fetch_object($res))
{
    echo "<div class='BoutonEvenement'><a href='PageUtilisateur.php'>".$ligne->Nom." ".$ligne->Prenom."<a></div>";
}
mysqli_close($connection);
?>
