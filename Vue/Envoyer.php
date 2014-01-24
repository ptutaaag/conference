<!DOCTYPE html>
<html>
<head>
    <title>Envoi d'un message</title>
    <meta http-equiv="Content-Type"
          content="text/html;charset=utf-8"/>
</head>

<body>
Envoyer un message :<br/><br/>

<?php
if ($nb == 0) {
    echo 'Vous êtes le seul membre inscrit.';
} else {
    ?>
    <form action="Envoyer.php" method="post">
        À : <select name="destinataire">
            <?php
            foreach($listeMail as $lm => $data) {
                echo '<option value="', $data['idDestinataire'], '">', $data['nomDestinataire'], '</option>';
            }
            ?>
        </select><br/>
        Objet : <input type="text" name="objet"
                       value=""><br/>
        Message : <textarea
            name="message"></textarea><br/>
        <input type="submit" name="go" value="Envoyer">
    </form>
</body>
</html>
<?php }; ?>