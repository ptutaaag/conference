<?php
session_start();
include_once("../Model/Agenda.php");
include_once("../Controler/Menu.php");

if (!isset($_SESSION['iduser']))
{
    header("Location : index.php ");
}


if (isset($_POST['selectDelete']))
{
    delAgenda($_POST['selectDelete']);
}


if  (isset($_POST['selectAdd']))
{
    $error = addAgenda($_SESSION['iduser'],$_POST['selectAdd']);
    if ($error == false)
    {
        echo "Il y a eu un conflit de date";
    }

}

$aEvent = getEvenementFromAgenda($_SESSION['iduser']);

$canDel = getEvenementCanDel($_SESSION['iduser']);

$canAdd = getEvenementCanAdd($_SESSION['iduser']);
include_once("../Vue/Agenda.php");

















