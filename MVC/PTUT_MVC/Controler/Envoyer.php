<?php
session_start();
include_once("../Model/Message.php");
include_once("../Controler/Menu.php");

if (!isset($_SESSION['iduser']))
{
    header("Location : index.php ");
}

if (isset($_POST['destinataire'])&&isset($_POST['objet'])&&isset($_POST['message']))
{
    if (empty($_POST['objet']))
        echo "L'objet est vide";
    else if (empty($_POST['message']))
        echo "Le message est vide";
    else{
    echo "Le message vient de partir";
    envoiMessage($_SESSION['iduser'],$_POST['destinataire'],$_POST['objet'],$_POST['message']);
    }
}

$nb = getNbMessage($_SESSION['iduser']);
$listeMail = getMail($_SESSION['iduser']);

include_once("../Vue/Envoyer.php");