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
 * Time: 18:52
 */

function inscrireUtilisateur($nom,$prenom,$email,$mdp)
{
    $req = "INSERT INTO utilisateur VALUES ('', '".$nom."', '".$prenom."', '".$email."', '".$mdp."', 0, 0, '', '".date("Y-m-d H:i:s")."')";
    $db = mysqli_connect($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
    $res = mysqli_query($db,$req) or die(mysqli_connect_error());
    mysqli_close($db);
}


function connexion($logintmp, $mdptmp)
{
    $error = false;
    if ($logintmp != null)
        $login = $logintmp;
    else
        $error = true;
    if ($mdptmp != null)
        $mdp = $mdptmp;
    else
        $error = true;

    if ($error == false) {


        // on crée la requête SQL
        $sql = 'SELECT * FROM utilisateur  where Mail=' . "\"" . $login . '" and Motdepasse=' . "\"" . $mdp . "\";";
        // on envoie la requête
        $db2 = new mysqli($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
        $res2 = mysqli_query($db2, $sql)  or die(mysqli_connect_error());
        if (mysqli_num_rows($res2) > 0) {
            while ($resultat = mysqli_fetch_object($res2)) {
                $iduser = $resultat->idUtilisateur;
            }
            mysqli_close($db2);
            return $iduser;

        } elseif (mysqli_num_rows($res2) == 0) {
            echo "Mot de passe ou login inconnu !";
            mysqli_close($db2);
            return -1;

        }
    }
    return -1;
}

function listeUtilisateurs()
{
    $connection = mysqli_connect($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
    $req = "SELECT idUtilisateur FROM utilisateur";
    $res = mysqli_query($connection, $req) or die ("Erreur dans la récupération des inscrits");
    $resultat = array();
    while($ligne=mysqli_fetch_object($res))
        $resultat[] = $ligne->idUtilisateur;
    return $resultat;
}

function infoUtilisateur($idUser)
{
    $connection = mysqli_connect($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
    $req = "SELECT * FROM utilisateur where idUtilisateur=".$idUser;
    $res = mysqli_query($connection, $req) or die ("Erreur dans la récupération des inscrits");
    $resultat = array();
    while ($ligne = mysqli_fetch_object($res)) {
        $resultat['Nom']=$ligne->Nom." ".$ligne->Prenom;
        $resultat['Avatar']=$ligne->Avatar;
        $resultat['Mail']=$ligne->Mail;
        $resultat['DateInscription']=$ligne->DateInscription;
        $resultat['Mdp']=$ligne->Motdepasse;
        $resultat['Admin']=$ligne->Admin;
        $resultat['idUtilisateur']=$ligne->idUtilisateur;
        $resultat['Conferencier']=$ligne->Conferencier;


    }
    return $resultat;

}

function changerMdp($idUtilisateur,$newMdp)
{
    $db = new mysqli($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
    $sql1 = "UPDATE utilisateur SET Motdepasse='" . $newMdp . "' WHERE idUtilisateur =" . $idUtilisateur ;
    $res = mysqli_query($db, $sql1) or die(mysqli_connect_error());
    mysqli_close($db);
}

function changerMail($idUtilisateur,$newMail)
{
    $db = new mysqli($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
    $sql1 = "UPDATE utilisateur SET Mail='" . $newMail . "' WHERE idUtilisateur =" . $idUtilisateur ;
    $res = mysqli_query($db, $sql1) or die(mysqli_connect_error());
    mysqli_close($db);
}

function changerAvatar($idUtilisateur,$newAvatar)
{
    $db = new mysqli($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
    $sql1 = "UPDATE utilisateur SET Avatar='" . $newAvatar . "' WHERE idUtilisateur =" . $idUtilisateur ;
    $res = mysqli_query($db, $sql1) or die(mysqli_connect_error());
    mysqli_close($db);
}

function getMotDePasse($idUser)
{
    $req = "Select Motdepasse FROM utilisateur WHERE idUtilisateur=".$idUser;
    $db = new mysqli($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
    $res = mysqli_query($db, $req) or die(mysqli_connect_error());
    while ($resultat = mysqli_fetch_object($res)) {
        $Motdepasse = $resultat->Motdepasse;
    }
    mysqli_close($db);
    return $Motdepasse;
}

function isAdmin($idUser)
{
    $connection = mysqli_connect($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
    $req2 = "SELECT Admin FROM utilisateur WHERE idUtilisateur=".$idUser;
    $res2 = mysqli_query($connection, $req2) or die ("Erreur vous n'etes pas admin");
    $adm = mysqli_fetch_row($res2);
    if ($adm[0]==1)
        return true;
    return false;
}

function isConferencier($idUser)
{
    $connection = mysqli_connect($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
    $req2 = "SELECT Conferencier FROM utilisateur WHERE idUtilisateur=".$idUser;
    $res2 = mysqli_query($connection, $req2) or die ("Erreur vous n'etes pas admin");
    $adm = mysqli_fetch_row($res2);
    if ($adm[0]==1)
        return true;
    return false;
}
