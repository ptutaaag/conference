<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type"
          content="text/html;charset=utf-8"/>
    <title>Liste Evenement</title>
</head>
<body>
<?php

    echo "<div class='BoutonEvenement'><a href=PageEvenement.php?id=".$event['idEvenement'].">" . $event['Titre'] . "<a>
    <p> - présenté par " . $event['Createur'] . "</p></div>";
?>
</body>
