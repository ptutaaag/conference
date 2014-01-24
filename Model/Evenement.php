<?php
include_once("../params.inc.php");
$_SESSION['db_host'] = $host;
$_SESSION['db_user'] = $user;
$_SESSION['db_password'] = $password;
$_SESSION['db_dbname'] = $dbname;

 function verifierDate($dateDebut, $dateFin)
	{
		$dd = $dateDebut;
		$df = $dateFin;
		
		$timestamp = date_create_from_format('Y/m/d H:i', $dd);
        $timed = date_format($timestamp, 'YmdHi');

        $timestamp = date_create_from_format('Y/m/d H:i', $df);
        $timef = date_format($timestamp, 'YmdHi');
		
		
		if ($timef > $timed)
		{
			return true; //les dates sont correct
		}
		
		else
		{
			return false; //les dates sont incorrect
		}
	}


    function createEvenement($dateDeDebut, $dateDeFin, $titre, $description, $utilisateur, $lieu)
    {

		$timestamp = date_create_from_format('Y/m/d H:i', $dateDeDebut);
        $dateDeDebut = date_format($timestamp, 'Y-m-d H:i:s');

        $timestamp = date_create_from_format('Y/m/d H:i', $dateDeFin);
        $dateDeFin = date_format($timestamp, 'Y-m-d H:i:s');
        $connection = mysqli_connect($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
        $requete = "INSERT INTO evenement (NomEvent, Description, HeureDebut, HeureFin, Lieu, idCreateur) VALUES ('" . $titre . "','" . $description . "','" . $dateDeDebut . "','" . $dateDeFin . "','" . $lieu . "'," . $utilisateur . ") ";

        $res =  mysqli_query($connection,$requete);
        mysqli_close($connection);
        return $res;

    }

function commenterEvenement($idUser,$com,$idEvenement)
{
    $connection = mysqli_connect($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
    $req = "INSERT INTO commentaire(idUtilisateur,Commentaire,idEvenement,DateCommentaire) VALUES(" . $idUser . ",'" . $com. "'," . $idEvenement . ",'" . date('Y-m-d H:m:i') . "')";
    mysqli_query($connection, $req) or die ("Erreur lors de l'ajout de votre commentaire" . $req);
}

function getListeCommentaire($idEvenement)
{
    $connection = mysqli_connect($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
    $req = "select idCommentaire from commentaire inner join evenement on commentaire.idEvenement = evenement.idEvenement where evenement.idEvenement=$idEvenement";
    $res = mysqli_query($connection, $req) or die ("Erreur lors du chargement des commentaires" . $req);
    while($ligne=mysqli_fetch_array($res))
        $resultat[] = $ligne;
    return $resultat;
}

function getInfoCommentaire($idCommentaire)
{
    $connection = mysqli_connect($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
    $req = "select * from commentaire inner join utilisateur on commentaire.idUtilisateur = utilisateur.idUtilisateur where idCommentaire=". $idCommentaire;
    $res = mysqli_query($connection, $req) or die ("Erreur lors du chargement des commentaires" . $req);
    $ligne=mysqli_fetch_object($res);
    $resultat['Commentaire'] = $ligne->Commentaire;
    $resultat['Date'] = $ligne->DateCommentaire;
    $resultat['Auteur'] = $ligne->Nom." ".$ligne->Prenom;
    return $resultat;
}



function listeDesEvenements()
{
    $connection = mysqli_connect($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
$req = "SELECT idEvenement from evenement ";
$res = mysqli_query($connection, $req) or die ("Erreur dans la récupération des evenements");
$resultat = array();
    while($ligne=mysqli_fetch_array($res))
        $resultat[] = $ligne;
    return $resultat;
}

function getInfoEvenement($idEvenement)
{
    $connection = mysqli_connect($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
    $req = "SELECT * from evenement inner join utilisateur on evenement.idCreateur = utilisateur.idUtilisateur where evenement.idEvenement=".$idEvenement;
$res = mysqli_query($connection, $req) or die ("Erreur dans la récupération des evenements");
    $resultat = array();
    $ligne = mysqli_fetch_object($res);
    $resultat["idEvenement"]=$ligne->idEvenement;
    $resultat["Createur"]=$ligne->Nom." ".$ligne->Prenom;
    $resultat["Debut"]=$ligne->HeureDebut;
    $resultat["Fin"]=$ligne->HeureFin;
    $resultat["Titre"]=$ligne->NomEvent;
    $resultat["Lieu"]=$ligne->Lieu;
    $resultat["Description"]=$ligne->Description;
    return $resultat;
}

function supprimerEvenement($idEvenement)
{
    $db = new mysqli($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
    $sql = "DELETE FROM evenement where idEvenement=".$idEvenement;
    $req = mysqli_query($db, $sql) or die(mysqli_connect_error());

    mysqli_close($db);
}


?>
	

