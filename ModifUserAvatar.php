<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: index.php');
    exit();
}
if (isset($_POST['enregistrer'])) {
    ChangerAvatar();
}
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
    <meta http-equiv="Content-Type"
          content="text/html;charset=utf-8"/>
    <title>Modification de votre avatar</title>
</head>
<body>

<?php
$req = "Select Avatar FROM utilisateur WHERE Mail like '" . $_SESSION['login'] . "'";
$db = new mysqli($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
$res = mysqli_query($db, $req) or die(mysqli_connect_error());
while ($resultat = mysqli_fetch_object($res)) {
    $Avatar = $resultat->Avatar;
}
mysqli_close($db);
?>


<form method=post action="" enctype="multipart/form-data">
    <label for="avatar">Avatar (format .png, .jpeg, .jpg, .gif): </label>
    <input type="file" name="avatar" id="avatar"/><br/>

    <input type="submit" name="enregistrer" value="Enregistrer"/>
</form>
<a href="PageUtilisateur.php"><input type="button" value="Revenir au profil"/></a>
<a href="index.php"><input type="button" value="Accueil"/></a>
</body>
</html>


<?php
function ChangerAvatar()
{
    $maxwidth = 100;
    $maxheight = 100;
    if (isset($_FILES['avatar'])) {
        if ($_FILES['avatar']['error'] == 0) {
            $extensions_valides = array('png', 'jpeg', 'jpg', 'gif');
            $extension_upload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
            if (in_array($extension_upload, $extensions_valides)) {
                $image_sizes = getimagesize($_FILES['avatar']['tmp_name']);
                if ($image_sizes[0] > $maxwidth OR $image_sizes[1] > $maxheight) {
                    echo 'L\'image est trop grande';
                } else {
                    $nom = "Avatars/" . $_SESSION['iduser'] . "." . $extension_upload;
                    $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $nom);
                    if ($resultat) echo "Transfert réussi";
                    $db = new mysqli($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
                    $sql1 = "UPDATE utilisateur SET Avatar='" . $nom . "' WHERE Mail like '" . $_SESSION['login'] . "'";

                    $res = mysqli_query($db, $sql1) or die(mysqli_connect_error());
                    mysqli_close($db);
                    header('Location: PageUtilisateur.php');
                }
            } else {
                echo 'L\'image n\'est pas au bon format';
            }
        } else {
            echo 'Problème dans l\'envoi de l\'image.';
        }
    } else {
        echo 'L\'image n\'existe pas.';

    }
}

?>