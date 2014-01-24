<?php
session_start();
include_once("../Model/Message.php");
include_once("../Controler/Menu.php");
/**
 * Created by PhpStorm.
 * User: Geoffrey
 * Date: 22/01/14
 * Time: 23:28
 */

if (!isset($_SESSION['iduser']))
{
    header("Location : index.php ");
}

$listeMessage = getListeMessage($_SESSION['iduser']);
include_once("../Vue/Message.php");