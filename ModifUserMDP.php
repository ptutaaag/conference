<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: index.php');
    exit();
}

?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
    <meta http-equiv="Content-Type"
          content="text/html;charset=utf-8"/>
    <title>Modification de votre mot de passe</title>
</head>
<body>

<?php
$req = "Select Motdepasse FROM utilisateur WHERE Mail like '" . $_SESSION['login'] . "'";
$db = new mysqli($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
$res = mysqli_query($db, $req) or die(mysqli_connect_error());
while ($resultat = mysqli_fetch_object($res)) {
    $Motdepasse = $resultat->Motdepasse;
}
mysqli_close($db);

if (isset($_POST['enregistrer'])) {
    ChangerMDP($Motdepasse);
}
?>


<form method=post action="" enctype="multipart/form-data">
    Après le changement de mot de passe, vous allez être déconnecté.<br/><br/>
    <label for="amdp">Ancien mot de passe: </label>
    <input type="password" name="amdp" id="amdp"/><br/>

    <label for="nmdp">Nouveau mot de passe: </label>
    <input type="password" name="nmdp" id="nmdp"/><br/>

    <label for="cmdp">Confirmation du nouveau mot de passe: </label>
    <input type="password" name="cmdp" id="cmdp"/><br/>

    <input type="submit" name="enregistrer" value="Enregistrer"/>
</form>
<a href="PageUtilisateur.php"><input type="button" value="Revenir au profil"/></a>
</body>
</html>


<?php
function ChangerMDP($Motdepasse)
{
    $mdpa = @$_POST['amdp'];
    $mdpn = @$_POST['nmdp'];
    $mdpc = @$_POST['cmdp'];

    if ($mdpa != $Motdepasse) {
        echo 'Ancien mot de passe éronné.';
    } else if ($mdpn != $mdpc) {
        echo 'Le nouveau mot de passe et la confirmation ne sont pas identiques.';
    } else {
        echo "Changement réussi";
        $db = new mysqli($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
        $sql1 = "UPDATE utilisateur SET Motdepasse='" . $mdpc . "' WHERE Mail like '" . $_SESSION['login'] . "'";
        $res = mysqli_query($db, $sql1) or die(mysqli_connect_error());
        mysqli_close($db);
        header('Location: Deconnexion.php');
    }

}

?>