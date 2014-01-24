<?php
session_start();
include_once("../Model/Utilisateur.php");

include_once("../Controler/Menu.php"); /*
 * Created by PhpStorm.
 * User: Geoffrey
 * Date: 22/01/14
 * Time: 23:59
 */
if (isset($_POST['login'])&&isset($_POST['mdp']))
{
    $result = connexion($_POST['login'],$_POST['mdp']);
    if ($result>0){
    $_SESSION['iduser'] = $result;
    $_SESSION['login'] = $_POST['login'];
        header("Location :Menu.php");
    }
}
include_once("../Vue/Connexion.php");