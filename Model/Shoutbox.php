<?php
include_once("../params.inc.php");
$_SESSION['db_host'] = $host;
$_SESSION['db_user'] = $user;
$_SESSION['db_password'] = $password;
$_SESSION['db_dbname'] = $dbname;

function getShout()
{
    $connection = mysqli_connect($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
    $req = "SELECT * FROM shoutbox INNER JOIN utilisateur ON shoutbox.idPersonne = utilisateur.idUtilisateur ORDER BY shoutbox.DateMessage DESC";
    $res = mysqli_query($connection, $req);
    $resultat = array();
    $i=0;
    while ($ligne = mysqli_fetch_object($res))
    {
        $resultat[$i]['Auteur']=$ligne->Nom." ".$ligne->Prenom;
        $resultat[$i]['Date']=$ligne->DateMessage;
        $resultat[$i]['Message']=$ligne->Message;
        $i=$i+1;
    }
    return $resultat;
}

function sendShout($idUser,$Message)
{

    $connection = mysqli_connect($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
    $req = "INSERT INTO shoutbox (idPersonne, Message, DateMessage) VALUES(" . $idUser . ",'" . $Message . "','" . date('Y-m-d H:m:i') . "')";
    mysqli_query($connection, $req);
}