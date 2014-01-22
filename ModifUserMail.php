<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
    session_start();
    if (!isset($_SESSION['login'])) {
    header ('Location: index.php');
    exit();
    }
	if(isset($_POST['enregistrer'])){
		ChangerMail();
	}
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
    <meta http-equiv="Content-Type"
          content="text/html;charset=utf-8" />
<title>Modification de votre mail</title>
</head>
  <body>
    
    <?php
	$req="Select Mail FROM utilisateur WHERE Mail like '".$_SESSION['login']."'";
	$db = new mysqli($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
	$res = mysqli_query($db,$req) or die(mysqli_connect_error());
	while($resultat = mysqli_fetch_object($res))
                {
                    $Mail=$resultat->Mail;
				}
    mysqli_close($db);
	?>            
    
    
	<form method=post action="" enctype="multipart/form-data">
	Après le changement d'adresse, vous allez être déconnecté.<br/><br/>
	<label for="adresse">Nouvelle adresse mail: </label>
	<input type="mail" name="adresse" id="adresse"/><br/>
	
	<label for="conf">Confirmation mail: </label>
	<input type="mail" name="conf" id="conf"/><br/>

	<?php echo @$_SESSION['mail_error'] ?>
	
	<input type="submit" name="enregistrer" value="Enregistrer" />
	</form>		
	<a href="PageUtilisateur.php"><input type="button" value="Revenir au profil"/></a>
    </body>
    </html>
	
	
	<?php
	function ChangerMail(){
	$amail = @$_POST['adresse'];
    $cmail = @$_POST['conf'];
		if ($amail != $cmail){
        $errors['mail_error'] = 'Adresses mail différentes.';
		}
		else{
			echo "Changement réussi";
			$db = new mysqli($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
			$sql1 = "UPDATE utilisateur SET Mail='".$cmail."' WHERE Mail like '".$_SESSION['login']."'";
			$res = mysqli_query($db,$sql1) or die(mysqli_connect_error());
			mysqli_close($db);
		}
		header ('Location: Deconnexion.php');
}		
?>