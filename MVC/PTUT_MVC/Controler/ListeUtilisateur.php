<?php
session_start();
include_once("../Model/Utilisateur.php");
include_once("../Controler/Menu.php");/**
 * Created by PhpStorm.
 * User: Geoffrey
 * Date: 22/01/14
 * Time: 19:34
 */

$idUtilisateur = listeUtilisateurs();
foreach ($idUtilisateur as $id)
{
    $utilisateur = infoUtilisateur($id);
    include("../Vue/ListeUtilisateur.php");
}

