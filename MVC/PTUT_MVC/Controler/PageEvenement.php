<?php
session_start();
include_once("../Model/Evenement.php");
include_once("../Model/Utilisateur.php");
include_once("../Controler/Menu.php");/**
 * Created by PhpStorm.
 * User: Geoffrey
 * Date: 22/01/14
 * Time: 20:31
 */


if (isset($_POST['com'])&&!empty($_POST['com']))
{
    commenterEvenement($_SESSION['iduser'],$_POST['com'],$_GET['id']);
}

if (isset($_SESSION['iduser']))
    $admin = isAdmin($_SESSION['iduser']);
else
    $admin=false;
$idASupprimer = $_GET['id'];
$resultat = getInfoEvenement($_GET['id']);
include_once("../Vue/Evenement.php");





$comId = getListeCommentaire($_GET['id']);
if (count($comId)==0)
    echo "Il n'y a pas de commentaire soyez le premier à en mettre un";
else {
foreach ($comId as $i)
{
    $com = getInfoCommentaire($i[0]);
    include("../Vue/ListeCommentaire.php");
}
}
if (isset($_SESSION['iduser']))
    include_once ("../Vue/Commentaire.php");


?>
