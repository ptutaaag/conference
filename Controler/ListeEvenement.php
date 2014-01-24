<?php
session_start();
include_once("../Model/Evenement.php");
include_once("../Controler/Menu.php");
/**
 * Created by PhpStorm.
 * User: Geoffrey
 * Date: 22/01/14
 * Time: 19:32
 */

$idevenements = listeDesEvenements();
foreach ($idevenements as $id){
    $i= $id[0];
    $event = getInfoEvenement($i) ;
    include("../Vue/ListeEvenement.php");
}




