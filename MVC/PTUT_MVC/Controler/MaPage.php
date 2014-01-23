<?php
session_start();
include_once("../Model/Utilisateur.php");
/**
 * Created by PhpStorm.
 * User: Geoffrey
 * Date: 22/01/14
 * Time: 23:02
 */

include_once("../Controler/Menu.php");

if (!isset($_SESSION['iduser'])&&!isAdmin($_SESSION['iduser']))
{
    header("Location : index.php ");
}

$user = infoUtilisateur($_SESSION['iduser']);
$admin = isAdmin($_SESSION['iduser']);
include_once("../Vue/MaPage.php");


