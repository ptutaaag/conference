<?php
/**
 * Created by PhpStorm.
 * User: Geoffrey
 * Date: 23/01/14
 * Time: 09:35
 */
session_start();

if (!isset($_SESSION['iduser']))
{
    header("Location : index.php ");
}

include_once("../Model/Evenement.php");

supprimerEvenement($_GET['id']);
header("Location: ListeEvenement.php");