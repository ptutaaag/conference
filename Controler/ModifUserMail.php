<?php
session_start();
include_once("../Model/Utilisateur.php");
include_once("../Controler/Menu.php");/**
 * Created by PhpStorm.
 * User: Geoffrey
 * Date: 22/01/14
 * Time: 20:57
 */

if (!isset($_SESSION['iduser']))
{
    header("Location : index.php ");
}

if (isset($_POST['enregistrer']) && !empty($_POST['adresse']) && !empty ($_POST['conf']))  {
$amail = $_POST['adresse'];
$cmail = $_POST['conf'];
if ($amail != $cmail) {
    echo 'Adresses mail différentes.';
} else {
    echo "Changement réussi";
    changerMail($_SESSION['iduser'],$cmail);
    }
}

include_once("../Vue/ModifUserMail.php");