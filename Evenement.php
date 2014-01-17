<?php
session_start();
require_once("params.inc.php");
$_SESSION['db_host']=$host;
$_SESSION['db_user']=$user;
$_SESSION['db_password']=$password;
$_SESSION['db_dbname']=$dbname;
/**
 * Created by PhpStorm.
 * User: Geoffrey
 * Date: 17/01/14
 * Time: 09:24
 */

class evenement {
    var $dateDeDebut;
    var $dateDeFin;
    var $description;
    var $titre;
    var $lieu;

    function evenement()
    {
    }

    function createEvenement()
    {
         $dateDeDebut=$this->dateDeDebut;
         $dateDeFin=$this->dateDeFin;
         $titre=$this->titre;
         $description=$this->description;
        $lieu = $this->lieu;
        $requete= "INSERT INTO evenement (NomEvent, Description, HeureDebut, HeureFin, Lieu) VALUES ('".$titre."','".$description."','".$dateDeDebut."','".$dateDeFin."','".$lieu."') ";
        $connection = mysqli_connect($_SESSION['db_host'],$_SESSION['db_user'],$_SESSION['db_password'],$_SESSION['db_dbname']);
        $resultat = mysqli_query($connection,$requete) or die ("Erreur lors de l'ajout".$requete);
        return $resultat;
    }

} ?>
