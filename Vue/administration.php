<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
    <title>Page d'administration</title>
</head>
<body>
<form method="post" action="" id="contact_form" enctype="multipart/form-data">
    <p>
        Inscrire des utilisateur: <?php echo "<span style=\"font-weight: bold; color: #f00\">".@$_SESSION['file_error']."</span>" ?><br />
        <input type="hidden" name="MAX_FILE_SIZE" value="104857600">
        <input type="file" name="lfile" id="lfile" value="choisir un fichier"/><br/>
        <input type="text" name="ufile" placeholder="ou sélection un lien" /><br/>
        <input type="submit" name="go" value="inscription" />
    </p>
</form>

<a href = "CreationEvent.php"> Creer un evenement</a>;

</body>
</html>