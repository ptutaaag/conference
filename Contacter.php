<?php
session_start();
include("Menu.php");
afficherBanniere();

if (!isset($_SESSION['login'])) {
    header('Location: index.php');
    exit();
}

if (isset($_POST['go']) && $_POST['go'] == 'Envoyer') {
	if (empty($_POST['objet'])) echo 'L\'objet est vide.';
    else if (empty($_POST['message'])) echo 'Le message est vide.';
    else {

        $db = new mysqli($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
        $objet =mysql_real_escape_string($_POST['objet']);
        $message = mysql_real_escape_string($_POST['message']);
        $sql = 'INSERT INTO message VALUES("", "' . $_SESSION['iduser'] . '", "3", "' . $message . '", "' . $objet . '","' . date("Y-m-d H:i:s") . '",0)';

        mysqli_query($db, $sql) or die(mysqli_connect_error());

        mysqli_close($db);
		echo 'Votre mail a été envoyé avec succès.';
        
        exit();
    }
}
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
    <meta http-equiv="Content-Type"
          content="text/html;charset=utf-8"/>
    <title>Contactez-nous</title>
</head>
<body>
<br/>
<br/>
<p> Vous pouvez nous joindre en cas de problème ou de questions particulières.<br/>Envoyez-nous un mail, nous essayerons d'y répondre le plus rapidement possible.<br/>Merci d'avance.</p><br/><br/>
<form action="Contacter.php" method="post">
        À : admin@admin.fr<br/>
        Objet : <input type="text" name="objet"
                       value="<?php if (isset($_POST['Objet'])) echo stripslashes(htmlentities(trim($_POST['Objet']))); ?>"><br/>
        Message : <textarea
            name="message"><?php if (isset($_POST['Message'])) echo stripslashes(htmlentities(trim($_POST['Message']))); ?></textarea><br/>
        <br/>
		<input type="submit" name="go" value="Envoyer">
    </form>
</body>
</html>
	