<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type"
          content="text/html;charset=utf-8"/>
    <title>Connexion</title>
</head>
<body>
<?php
echo "<div class=contenuEvenement>
    <h1>" . $resultat['Titre'] . "</h1>
    <h3> Description </h3> <P>  " . $resultat['Description'] . "</P>
    <h3> Horaire </h3> <P>  Debut : " . $resultat['Debut'] . "</P>
    Fin : " . $resultat['Fin'] . "</P>
    <h3> Lieu </h3> <P> " . $resultat['Lieu'] . "</P>
    <h3> Maitre de conférence </h3> <P> " .$resultat['Createur']. "</P><br/>
</div>";

if ($admin)
{
    echo "<a href=SupprimerEvenement.php?id=".$idASupprimer.">Supprimer cet evenement</a>";
}
?>



</body>