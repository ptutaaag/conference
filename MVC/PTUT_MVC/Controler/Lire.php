<?php
session_start();
include_once("../Model/Message.php");
include_once("../Controler/Menu.php");

if (!isset($_SESSION['iduser']))
{
    header("Location : index.php ");
}

$data = getMessage($_GET['id']);
lireMessage($_GET['id']);
include_once("../Vue/Lire.php");
