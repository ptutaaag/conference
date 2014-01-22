<?php
session_start();
include("Menu.php");
afficherBanniere();

if (!isset($_SESSION['login'])) {
    header('Location: index.php');
    exit();
}

if (isset($_POST['go']) && $_POST['go'] == 'Envoyer') {
    if (empty($_POST['destinataire'])) echo 'Le mail est vide.';
    else if (empty($_POST['objet'])) echo 'L\'objet est vide.';
    else if (empty($_POST['message'])) echo 'Le message est vide.';
    else {

        $db = new mysqli($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
        $objet =mysql_real_escape_string($_POST['objet']);
        $message = mysql_real_escape_string($_POST['message']);
        $sql = 'INSERT INTO message VALUES("", "' . $_SESSION['iduser'] . '", "' . $_POST['destinataire'] . '", "' . $message . '", "' . $objet . '","' . date("Y-m-d H:i:s") . '",0)';

        mysqli_query($db, $sql) or die(mysqli_connect_error());

        mysqli_close($db);

        header('Location: MessageUser.php');
        exit();
    }
}
?>
<html>
<head>
    <title>Envoi d'un message</title>
</head>

<body>
<a href="index.php">Retour à l'accueil</a><br/><br/>
Envoyer un message :<br/><br/>

<?php
$db = new mysqli($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);

$sql = 'SELECT Mail as nom_destinataire, idUtilisateur as id_destinataire FROM utilisateur WHERE idUtilisateur <> "' . $_SESSION['iduser'] . '" ORDER BY Mail ASC';

$req = mysqli_query($db, $sql) or die(mysqli_connect_error());
$nb = mysqli_num_rows($req);

if ($nb == 0) {
    echo 'Vous êtes le seul membre inscrit.';
} else {
    ?>
    <form action="Envoyer.php" method="post">
        À : <select name="destinataire">
            <?php
            while ($data = mysqli_fetch_array($req)) {
                echo '<option value="', $data['id_destinataire'], '">', stripslashes(htmlentities(trim($data['nom_destinataire']))), '</option>';
            }
            ?>
        </select><br/>
        Objet : <input type="text" name="objet"
                       value="<?php if (isset($_POST['Objet'])) echo stripslashes(htmlentities(trim($_POST['Objet']))); ?>"><br/>
        Message : <textarea
            name="message"><?php if (isset($_POST['Message'])) echo stripslashes(htmlentities(trim($_POST['Message']))); ?></textarea><br/>
        <input type="submit" name="go" value="Envoyer">
    </form>

<?php
}
mysqli_free_result($req);
mysqli_close($db);
?>
</select>
<?php

if (isset($erreur)) echo '<br/><br/>', $erreur;
?>
</body>
</html>