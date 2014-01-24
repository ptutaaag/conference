<!DOCTYPE html>
<html>
<head>
    <title>Lecture de votre message :</title>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8"/>
</head>

<body>
<a href="Message.php">Retour à vos messages</a><br/><br/>
<?php
        echo $data['Date'], ' - ', $data['Objet'], ' - [ Message de ', $data['Expediteur'], ' ]<br/><br/>';
        echo $data['Message']; echo "<br/>";
        echo "<a href=Supprimer.php?id=".$data['id'].">Supprimer le message</a>";
?>
</body>
</html>