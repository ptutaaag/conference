<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: index.php');
    exit();
}

include("Menu.php");
afficherBanniere();
?>

<html>
<head>
    <title>Vos messages :</title>
</head>

<body>
Votre adresse: <?php echo stripslashes(htmlentities(trim($_SESSION['login']))); ?> <br/><br/>
<?php
$db = new mysqli($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
$sql = 'SELECT Objet, Date, utilisateur.Mail as expediteur, idMessage FROM message, utilisateur WHERE id_destinataire="' . $_SESSION['iduser'] . '" AND id_expediteur=utilisateur.idUtilisateur ORDER BY Date DESC';

$res = mysqli_query($db, $sql) or die(mysqli_connect_error());
$nb = mysqli_num_rows($res);

if ($nb == 0) {
    echo "Vous n'avez pas de message.";
} else {
    while ($data = mysqli_fetch_array($res)) {
        echo $data['Date'], ' - <a href="Lire.php?idMessage=', $data['idMessage'], '">', stripslashes(htmlentities(trim($data['Objet']))), '</a> [ Message de ', stripslashes(htmlentities(trim($data['expediteur']))), ' ]<br/>';
    }
}
mysqli_free_result($res);
mysqli_close($db);
?>
<br/><a href="Envoyer.php">Envoyer un message</a>
</body>
</html>