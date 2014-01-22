    <?php
    session_start();
    if (!isset($_SESSION['login'])) {
    header ('Location: index.php');
    exit();
    }
    ?>

    <html>
    <head>
    <title>Lecture de votre message :</title>
    </head>

    <body>
    <a href="MessageUser.php">Retour à vos messages</a><br /><br />
    <?php
    if (!isset($_GET['idMessage']) || empty($_GET['idMessage'])) {
		echo 'Aucun message reconnu.';
    }
    else {
		$db = new mysqli($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);

    $sql = 'SELECT Objet, Date, Message, utilisateur.Mail as expediteur FROM message, utilisateur WHERE id_destinataire="'.$_SESSION['iduser'].'" AND id_expediteur=utilisateur.idUtilisateur AND message.idMessage="'.$_GET['idMessage'].'"';
    $req = mysqli_query($db,$sql) or die(mysqli_connect_error());
    $nb = mysqli_num_rows($req);

    if ($nb == 0) {
		echo 'Aucun message reconnu.';
    }
    else {

	$sql1 = 'UPDATE message SET lu=1 WHERE idMessage='.$_GET['idMessage'];
	$req2 = mysqli_query($db,$sql1) or die(mysqli_connect_error());
	
    $data = mysqli_fetch_array($req);
    echo $data['Date'] , ' - ' , stripslashes(htmlentities(trim($data['Objet']))) , '</a> [ Message de ' , stripslashes(htmlentities(trim($data['expediteur']))) , ' ]<br/><br/>';
    echo nl2br(stripslashes(htmlentities(trim($data['Message']))));

    echo '<br/><br/><a href="Supprimer.php?idMessage=' , $_GET['idMessage'] , '">Supprimer ce message</a>';
    }
    mysqli_free_result($req);
    mysqli_close($db);
    }
    ?>
    </body>
    </html>