<?php
session_start();
include_once("../Model/Utilisateur.php");
include_once("../Controler/Menu.php");/**
 * Created by PhpStorm.
 * User: Geoffrey
 * Date: 22/01/14
 * Time: 20:22
 */


$user = infoUtilisateur($_GET['id']);
include_once("../Vue/Utilisateur.php");