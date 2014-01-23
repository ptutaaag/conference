<?php
session_start();
include_once("../Model/Message.php");
include_once("../Controler/Menu.php");
/**
 * Created by PhpStorm.
 * User: Geoffrey
 * Date: 23/01/14
 * Time: 02:08
 */

if (!isset($_SESSION['iduser']))
{
    header("Location : index.php ");
}

$idAdmin = 1;

if (isset($_POST['objet'])&& isset($_POST['message']))
{
    if (empty($_POST['objet']))
        echo "L'objet est vide";
    else if (empty($_POST['message']))
        echo "Le message est vide";
    else{
        echo "Le message vient de partir";
        envoiMessage($_SESSION['iduser'],$idAdmin,$_POST['objet'],$_POST['message']);
    }
}

include_once("../Vue/Contacter.php");
