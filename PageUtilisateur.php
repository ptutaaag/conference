<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
    session_start();
    if (!isset($_SESSION['login'])) {
    header ('Location: index.php');
    exit();
    }
	$req="SELECT Nom, Prenom, Mail, Avatar, DateInscription FROM utilisateur WHERE Mail like '".$_SESSION['login']."'";
	$db = new mysqli($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
	$res = mysqli_query($db,$req) or die(mysqli_connect_error());
	while($resultat = mysqli_fetch_object($res))
                {
                    $Nom=$resultat->Nom;
					$Prenom=$resultat->Prenom;
					$Mail=$resultat->Mail;
					$Avatar=$resultat->Avatar;
					$Date=$resultat->DateInscription;
                }
                mysqli_close($db);
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
    <meta http-equiv="Content-Type"
          content="text/html;charset=utf-8" />
<title>Informations Utilisateur</title>
</head>
  <body>
    
    <p>Bienvenue <?php echo $Prenom." ".$Nom; ?> !<br /></p>
	<img src= <?php echo "".$Avatar;?>/>
	<br/>
	<?php
	echo "Nom: ".$Nom."<br/>Prénom: ".$Prenom."<br/>Mail: ".$Mail."<br/>Date d'inscription: ".$Date."<br/>";
	?>
	<a href="ModifUser.php"><input type="button" value="Modifier profil"/></a>
	<a href="index.php"><input type="button" value="Accueil"/></a>
    </body>
    </html>