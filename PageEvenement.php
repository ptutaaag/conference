<?php
include_once("Evenement.php");


$connection = mysqli_connect($_SESSION['db_host'],$_SESSION['db_user'],$_SESSION['db_password'],$_SESSION['db_dbname']);
$req = "SELECT * FROM evenement inner join utilisateur on evenement.idCreateur = utilisateur.idUtilisateur WHERE idEvenement=".$_GET['id'];

$res = mysqli_query($connection,$req) or die ("Erreur dans la recuperation de l'evenement");

while ($ligne = mysqli_fetch_object($res))
{
    echo "<div class=contenuEvenement>
    <span>".$ligne->NomEvent."</span><br/>
    <span>".$ligne->Description."</span><br/>
    <span>".$ligne->HeureDebut."</span><br/>
    <span>".$ligne->HeureFin."</span><br/>
    <span>".$ligne->Lieu."</span><br/>
    <span>".$ligne->Nom."</span><br/>
    <span>".$ligne->Prenom."</span><br/>
    </div>";
}

?>
