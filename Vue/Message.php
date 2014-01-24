<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type"
          content="text/html;charset=utf-8"/>
    <title>Messagerie</title>
</head>

<body>
<?php
echo "Votre adresse:". $_SESSION['login'];
echo "<br/><br/>";




$bool = false;
    foreach($listeMessage as $lm => $message)
    {
        $bool = true;
        echo $message['Date'].' - <a href="Lire.php?id='.$message['id'].'">'.$message['Objet'].'</a> [ Message de '.$message['Expediteur'].']<br/>';
    }
    if( $bool == false)
        echo "Vous n'avez pas de message";

?>
<br/><a href="Envoyer.php">Envoyer un message</a>
</body>
</html>