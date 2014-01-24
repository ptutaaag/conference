<?php
include_once("../params.inc.php");

$_SESSION['db_host'] = $host;
$_SESSION['db_user'] = $user;
$_SESSION['db_password'] = $password;
$_SESSION['db_dbname'] = $dbname;
/**
 * Created by PhpStorm.
 * User: Geoffrey
 * Date: 22/01/14
 * Time: 16:22
 */

function getEvenementFromAgenda($idUser)
{
    $connection = mysqli_connect($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
    $req = "SELECT * from agenda INNER JOIN evenement on agenda.idEvenement=evenement.idEvenement where agenda.idUtilisateur =" . $idUser;
    $res = mysqli_query($connection,$req);
    $resultat = array();
    $i=0;
     while ($ligne = mysqli_fetch_object($res))
     {
         $resultat[$i]['id']=$ligne->idEvenement;
         $resultat[$i]['Titre']=$ligne->NomEvent;
         $resultat[$i]['DateDebut']=$ligne->HeureDebut;
         $resultat[$i]['DateFin']=$ligne->HeureFin;
         $i=$i+1;
     }
    return $resultat;
}

function getEvenementCanDel($idUser)
{
    $connection = mysqli_connect($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
    $req = "SELECT * from agenda INNER JOIN evenement on agenda.idEvenement=evenement.idEvenement where agenda.idUtilisateur =" . $idUser;
    $res = mysqli_query($connection,$req);
    $resultat = array();
    $i=0;
    while ($ligne = mysqli_fetch_object($res))
    {
        $resultat[$i]['id']=$ligne->idAgenda;
        $resultat[$i]['Titre']=$ligne->NomEvent;
        $resultat[$i]['DateDebut']=$ligne->HeureDebut;
        $resultat[$i]['DateFin']=$ligne->HeureFin;
        $i=$i+1;
    }
    return $resultat;
}

function getEvenementCanAdd($idUser)
{
    $connection = mysqli_connect($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
    $req = "SELECT * FROM evenement";
    $res = mysqli_query($connection, $req) or die ("Erreur dans la récupération des evenements");
    $resultat = array();
    $i=0;
    while ($ligne = mysqli_fetch_object($res)) {
        $req = "select * from agenda where idEvenement =" . $ligne->idEvenement."and idUtilisateur =".$idUser;
        $res2 = mysqli_query($connection, $req);
        if (mysqli_num_rows($res2) == 0) {

            $resultat[$i]['id']=$ligne->idEvenement;
            $resultat[$i]['Titre']=$ligne->NomEvent;
            $resultat[$i]['DateDebut']=$ligne->HeureDebut;
            $resultat[$i]['DateFin']=$ligne->HeureFin;
            $i=$i+1;
        }
    }
    return $resultat;



}

function addAgenda($idUser,$idEvenement)
{
    $connection = mysqli_connect($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
    $req = "SELECT * FROM agenda where idUtilisateur=".$idUser;
    $res = mysqli_query($connection, $req) or die ("Il y a un probleme");
    $idAAjouter = $idEvenement;
    $bool = true;
    while ($ligne = mysqli_fetch_object($res)) {
        if (verifDate($ligne->idEvenement, $idAAjouter) == false) {
            $bool = false;
        }
    }
    if ($bool != false) {


        $req = "INSERT INTO agenda(idUtilisateur,idEvenement) VALUES(" . $idUser . "," .$idAAjouter . ")";
        $res = mysqli_query($connection, $req) or die ("Il y a un probleme");
    }
    return $bool;
}

function delAgenda($idAgenda)
{
    $connection = mysqli_connect($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
    $req = "DELETE FROM agenda where idAgenda=".$idAgenda;
    mysqli_query($connection,$req);
}

function verifDate($idEvenement, $idAgenda)
{
    $connection = new mysqli($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
    $req = "SELECT  * from evenement where idEvenement = " . $idEvenement;
    $res = mysqli_query($connection, $req);
    $ligne = mysqli_fetch_object($res);
    $debEvent = $ligne->HeureDebut;
    $finEvent = $ligne->HeureFin;


    $timestamp = date_create_from_format('Y-m-d H:i:s', $debEvent);
    $debEvent = date_format($timestamp, 'YmdHi');
    $timestamp = date_create_from_format('Y-m-d H:i:s', $finEvent);
    $finEvent = date_format($timestamp, 'YmdHi');

    $req = "SELECT  * from evenement where idEvenement = " . $idAgenda;
    $res = mysqli_query($connection, $req);
    $ligne = mysqli_fetch_object($res);
    $debAge = $ligne->HeureDebut;
    $finAge = $ligne->HeureFin;

    $timestamp = date_create_from_format('Y-m-d H:i:s', $debAge);
    $debAge = date_format($timestamp, 'YmdHi');
    $timestamp = date_create_from_format('Y-m-d H:i:s', $finAge);
    $finAge = date_format($timestamp, 'YmdHi');


    if ($debEvent <= $debAge) {
        if ($debAge <= $finEvent)
            return false;
        return true;

    }


    if ($debEvent <= $finAge) {
        if ($finEvent >= $finAge)
            return false;
        return true;

    }
    return true;
}