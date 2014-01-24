<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type"
          content="text/html;charset=utf-8"/>
    <title>Connexion</title>
</head>
<body>
<div class='content'>

<div id='shoutbox'>
    <ul id='listeMessageShout'>
        <?php
foreach ($listeShout as $ls => $data)
{
    echo "<li>";
    echo "<p id= messageShout>".$data['Message']."</p>";
    echo "<p id= infoMessage> - par ".$data['Auteur']." le ". $data['Date'];
    echo "</li>";
}
    ?>
    </ul>



<div id='shoutAction'>
        <form method=post name='formShout'>
            <textarea name='contenu' rows = 10 cols=94>Entrez votre message ici</textarea><br/>
            <a href='Shoutbox.php'><input type='button' value='Rafraichir' /> </a>
            <input type=submit name='envoyer'/>
        </form>
    </div>
    </div>
     </div>
</body>