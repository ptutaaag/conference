<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type"
          content="text/html;charset=utf-8"/>
    <title>Connexion</title>
</head>
<body>
<div id='shoutbox'>
    <div id='listeMessageShout'>
        <?php
foreach ($listeShout as $ls => $data)
{
    echo "<li>";
    echo "<p id= messageShout>".$data['Message']."</p>";
    echo "<p id= infoMessage> - par ".$data['Auteur']." le ". $data['Date'];
    echo "</li>";
}
    ?>
    </div>



<div id='shoutAction'>
        <form method=post name='formShout'>
            <textarea name='contenu' rows = 10 cols=100>Entrez votre message ici</textarea><br/>
            <a href='Shoutbox.php'><input type='button' value='Rafraichir' /> </a>
            <input type=submit name='envoyer'/>
        </form>
    </div>

     </div>
</body>