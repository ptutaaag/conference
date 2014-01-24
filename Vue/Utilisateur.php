<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
    <meta http-equiv="Content-Type"
          content="text/html;charset=utf-8"/>
    <title>Informations Utilisateur</title>
</head>
<body>
<?php
    echo "<p>Bienvenue " . $user['Nom']. "!</p>"; ?> <br/>
<img src="<?php echo $user['Avatar']; ?>"/>
<br/>
<?php
echo "Nom: " . $user['Nom'];
echo "<br/>Mail: ".$user['Mail'];
echo "<br/>Date d'inscription: " . $user['DateInscription'] . "<br/>";
?>
</body>
</html>