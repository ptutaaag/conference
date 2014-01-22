<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<head>
    <meta http-equiv="Content-Type"
          content="text/html;charset=utf-8"/>
    <title>Evenement</title>
</head>

<?php
session_start();
include_once("Evenement.php");
include("Menu.php");

afficherBanniere();


$connection = mysqli_connect($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
$req = "SELECT * FROM evenement inner join utilisateur on evenement.idCreateur = utilisateur.idUtilisateur WHERE idEvenement=" . $_GET['id'];

$res = mysqli_query($connection, $req) or die ("Erreur dans la recuperation de l'evenement");

while ($ligne = mysqli_fetch_object($res)) {
    echo "<div class=contenuEvenement>
    <h1>" . $ligne->NomEvent . "</h1>
    <h3> Description </h3> <P>  " . $ligne->Description . "</P>
    <h3> Horaire </h3> <P>  Debut : " . $ligne->HeureDebut . "</P>
     Fin : " . $ligne->HeureFin . "</P>
     <h3> Lieu </h3> <P> " . $ligne->Lieu . "</P>
     <h3> Maitre de conférence </h3> <P> " . $ligne->Nom . " " . $ligne->Prenom . "</P><br/>
    </div>";


    /* COMMENTAIRE */

    if (isset ($_SESSION['iduser']) && isset($_POST['com']) && !empty($_POST['com'])) {
        $connection = mysqli_connect($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
        $req = "INSERT INTO commentaire(idUtilisateur,Commentaire,idEvenement,DateCommentaire) VALUES(" . $_SESSION['iduser'] . ",'" . $_POST['com'] . "'," . $_GET['id'] . ",'" . date('Y-m-d H:m:i') . "')";
        mysqli_query($connection, $req) or die ("Erreur lors de l'ajout de votre commentaire" . $req);
        echo "Votre commentaire à bien été ajouté";
    }


    $req = "select * from commentaire inner join evenement on commentaire.idEvenement = evenement.idEvenement inner join utilisateur on commentaire.idUtilisateur=utilisateur.idUtilisateur where commentaire.idEvenement=" . $_GET['id'];
    $res = mysqli_query($connection, $req) or die ("Erreur lors du chargement des commentaires" . $req);
    echo "<h2> Commentaires </h2>";
    if (mysqli_num_rows($res) == 0)
        echo "Il n'y a pas de commentaire, soyez le premier à en laisser un";
    while ($ligne = mysqli_fetch_object($res)) {
        echo "<div class=commentaire> <p>" . $ligne->Commentaire . "<br/> à " . $ligne->DateCommentaire . " de " . $ligne->Nom . " " . $ligne->Prenom . "</p> </div>";
    }
    echo "<br/>";


    if (isset($_SESSION['iduser'])) {
        echo "<form method='POST' name='formCommentaire' >
<textarea name=com  rows = 10 cols = 80> </textarea>
<br/>
<input type='submit' name='soumettreCommentaire' value='Commenter'/>
</form>";
    }

}
?>
