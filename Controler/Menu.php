<?php
session_start();
include_once("../Model/Message.php");
header('Cache-Control: no-cache');
header('Pragma: nocache');
/**
 * Created by PhpStorm.
 * User: Geoffrey
 * Date: 22/01/14
 * Time: 23:07
 */




$nb_mess = getNbMessage($_SESSION['iduser']);
include_once("../Vue/Menu.php");

