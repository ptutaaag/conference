<?php
include_once("Evenement.php");

$connection = mysqli_connect($_SESSION['db_host'],$_SESSION['db_user'],$_SESSION['db_password'],$_SESSION['db_dbname']);
$req = "SELECT * from evenement";
$res = mysqli_query($connection, $req) or die ("Erreur dans la récupération des evenements");

while ($ligne = mysqli_fetch_object($res))
{
    echo "<div class='BoutonEvenement'><a href='PageEvenement.php?id=".$ligne->idEvenement."'>".$ligne->NomEvent."<a></div>";
}
mysqli_close($connection);
?>
