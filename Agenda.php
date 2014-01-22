<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<head>
    <meta http-equiv="Content-Type"
          content="text/html;charset=utf-8"/>
    <title>Création de l'agenda</title>
</head>

<?php
session_start();
include("Evenement.php");
include("VerifAjoutAgenda.php");
include("Menu.php");
/**
 * Created by PhpStorm.
 * User: Geoffrey
 * Date: 20/01/14
 * Time: 13:53
 */

afficherBanniere();


$idUser = $_SESSION['iduser'];


$connection = mysqli_connect($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);


$req = "SELECT * FROM evenement";
$res = mysqli_query($connection, $req) or die ("Erreur dans la récupération des evenements");
echo "<form method='post' name='formAgenda'>";
while ($ligne = mysqli_fetch_object($res)) {
    $req = "select * from agenda where idEvenement =" . $ligne->idEvenement;
    $res2 = mysqli_query($connection, $req);
    if (mysqli_num_rows($res2) == 0) {
        echo "<input type='radio' name='choixEvent' value='$ligne->idEvenement' >$ligne->NomEvent</input>";
        echo "<br/>";
    }
}

echo "<input type='submit' name='valider' value='Ajouter les evenements séléctionné'> </input>";
echo "</form>";


if (isset($_POST['choixEvent'])) {
    $req = "SELECT * FROM agenda";
    $res = mysqli_query($connection, $req) or die ("Il y a un probleme");
    $idAAjouter = $_POST['choixEvent'];
    $bool = true;
    while ($ligne = mysqli_fetch_object($res)) {
        if (verifDate($ligne->idEvenement, $idAAjouter) == false) {
            $bool = false;
        }
    }


    if ($bool != false) {


        $req = "INSERT INTO agenda(idUtilisateur,idEvenement) VALUES(" . $idUser . "," . $_POST['choixEvent'] . ")";
        $res = mysqli_query($connection, $req) or die ("Il y a un probleme");

        echo " L'ajout à été effectué avec succès";
    }
}

$req = "SELECT * from evenement INNER JOIN agenda on agenda.idEvenement=evenement.idEvenement where agenda.idUtilisateur =" . $idUser;
$res = mysqli_query($connection, $req) or die ("Erreur dans le récupération de l'agenda");
while ($ligne = mysqli_fetch_object($res)) {

    echo "<span>$ligne->NomEvent </span>";
    echo "<span>$ligne->HeureDebut </span>";
    echo "<span>$ligne->HeureFin </span>";
    echo "<br/>";
}





