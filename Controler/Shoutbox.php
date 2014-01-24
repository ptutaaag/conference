<?php
session_start();
include_once("../Model/Shoutbox.php");
include_once("../Controler/Menu.php");/**
 * Created by PhpStorm.
 * User: Geoffrey
 * Date: 23/01/14
 * Time: 00:44
 */

if (!isset($_SESSION['iduser']))
{
    header("Location : index.php ");
}

if (isset($_POST['contenu'])&&!empty($_POST['contenu']))
{
    sendShout($_SESSION['iduser'],$_POST['contenu']);
}

$listeShout = getShout();
include_once("../Vue/Shoutbox.php");