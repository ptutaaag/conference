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
 * Date: 20/01/14
 * Time: 15:54
 */

function verifDate ($idEvenement, $idAgenda)
{
    $connection = new mysqli($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
    $req = "SELECT  * from evenement where idEvenement = ".$idEvenement;
    $res = mysqli_query($connection,$req);
    $ligne = mysqli_fetch_object($res);
    $debEvent = $ligne->HeureDebut;
    $finEvent = $ligne->HeureFin;



    $timestamp = date_create_from_format('Y-m-d H:i:s', $debEvent);
    $debEvent = date_format($timestamp,'YmdHi');
    $timestamp = date_create_from_format('Y-m-d H:i:s', $finEvent);
    $finEvent = date_format($timestamp,'YmdHi');

    $req = "SELECT  * from evenement where idEvenement = ".$idAgenda;
    $res = mysqli_query($connection,$req);
    $ligne = mysqli_fetch_object($res);
    $debAge = $ligne->HeureDebut;
    $finAge = $ligne->HeureFin;

    $timestamp = date_create_from_format('Y-m-d H:i:s', $debAge);
    $debAge = date_format($timestamp,'YmdHi');
    $timestamp = date_create_from_format('Y-m-d H:i:s', $finAge);
    $finAge = date_format($timestamp,'YmdHi');


    if ($debEvent<$debAge)
    {
        if ($debAge<$finEvent )
            return false;
        return true;

    }


    if ($debEvent<$finAge)
    {
        if ($finEvent>$finAge )
            return false;
        return true;

    }
    return true;
}