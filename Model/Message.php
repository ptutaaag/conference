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
 * Time: 18:22
 */

function getListeMessage($idUser)
{
    $db = new mysqli($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
    $sql = 'SELECT Objet, Date, utilisateur.Mail as expediteur, idMessage, Message FROM message inner join  utilisateur on message.id_destinataire = utilisateur.idUtilisateur WHERE id_destinataire=' . $idUser . ' ORDER BY Date DESC';
    $resultat = array();
    $i=0;
    $res = mysqli_query($db, $sql) or die(mysqli_connect_error());
    while ($ligne= mysqli_fetch_object($res)){
        $resultat[$i]['Objet']=$ligne->Objet;
        $resultat[$i]['Date']=$ligne->Date;
        $resultat[$i]['Expediteur']=$ligne->expediteur;
        $resultat[$i]['id']=$ligne->idMessage;
        $resultat[$i]['Message']=$ligne->Message;
        $i=$i+1;

    }
    mysqli_free_result($res);
    mysqli_close($db);
    return $resultat;

}

function getMessage($idMessage)
{

    $db = new mysqli($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
    $sql = 'SELECT Objet, Date, Mail , idMessage, Message FROM message inner join utilisateur on message.id_destinataire = utilisateur.idUtilisateur WHERE idMessage=' . $idMessage;
    $resultat = array();
    $res = mysqli_query($db, $sql) or die(mysqli_connect_error());
   $ligne= mysqli_fetch_object($res);
        $resultat['Objet']=$ligne->Objet;
        $resultat['Date']=$ligne->Date;
        $resultat['Expediteur']=$ligne->Mail;
        $resultat['id']=$ligne->idMessage;
        $resultat['Message']=$ligne->Message;
    mysqli_free_result($res);
    mysqli_close($db);
    return $resultat;
}

function envoiMessage($emetteur,$destinataire, $objet, $message)
{
    $db = new mysqli($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
    $sql = 'INSERT INTO message VALUES("", "' . $emetteur . '", "' . $destinataire . '", "' . $message . '", "' . $objet . '","' . date("Y-m-d H:i:s") . '",0)';

    mysqli_query($db, $sql) or die(mysqli_connect_error());

    mysqli_close($db);
}

function lireMessage($idMessage)
{
    $db = new mysqli($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
    $sql1 = 'UPDATE message SET lu=1 WHERE idMessage=' . $idMessage;
    $req2 = mysqli_query($db, $sql1) or die(mysqli_connect_error());
}

function delMessage($idUser,$idMessage)
{
    $db = new mysqli($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);

    $sql = 'DELETE FROM message WHERE id_destinataire="' . $idUser . '" AND idMessage="' . $idMessage . '"';
    $req = mysqli_query($db, $sql) or die(mysqli_connect_error());

    mysqli_close($db);
}

function getNbMessage($idUser)
{
    $req = "SELECT COUNT(lu) FROM message WHERE id_destinataire='" . $idUser . "' AND lu=0";
    $db = new mysqli($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
    $res = mysqli_query($db, $req) or die(mysqli_connect_error());
    $nb_mess = mysqli_fetch_row($res);
    mysqli_close($db);
    return $nb_mess;
}

function getMail($idUser)
{
    $db = new mysqli($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);

    $sql = 'SELECT Mail as nom_destinataire, idUtilisateur as id_destinataire FROM utilisateur WHERE idUtilisateur <> "' . $idUser . '" ORDER BY Mail ASC';

    $req = mysqli_query($db, $sql) or die(mysqli_connect_error());
    $i=0;
    $resultat = array();
    if (mysqli_num_rows($req)==0)
        return 0;
    while ($ligne= mysqli_fetch_object($req)){
        $resultat[$i]['nomDestinataire']=$ligne->nom_destinataire;
        $resultat[$i]['idDestinataire']=$ligne->id_destinataire;
        $i=$i+1;
    }
    return $resultat;
}