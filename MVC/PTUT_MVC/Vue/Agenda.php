<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<head>
    <meta http-equiv="Content-Type"
          content="text/html;charset=utf-8"/>
    <title>Création de l'agenda</title>
</head>
<body>
    <h3> Evenement à supprimer </h3>
    <form method="post">
    <?php
    $i = 0;
    foreach ($canDel as $cd => $infoD)
    {
        $i= $i+1;
        echo "<input type=radio name='selectDelete' value=".$infoD['id'].">".$infoD['Titre']."</input><br/>";
    }
    if ($i!=0)
        echo "<input type='submit' name='valider' value='Valider la suppression'> </input>";
    echo "</form>";
    ?>


    <h3>Evenement à ajouter</h3>
    <form method="post">
    <?php
    $i = 0;
    foreach ($canAdd as $ca => $infoA)
    {
        $i= $i+1;
        echo "<input type=radio name='selectAdd' value=".$infoA['id'].">".$infoA['Titre']."</input><br/>";
    }
    if ($i!=0)
        echo "<input type='submit' name='valider' value='Valider l ajout'> </input>";
    echo "</form>";
    ?>

    <h2> Liste des evenements de votre agenda </h2>
    <?php
    foreach ($aEvent as $ae => $infoE)
    {
        echo "<span>".$infoE['Titre']."</span>";
        echo "<span>".$infoE['DateDebut']." </span>";
        echo "<span>".$infoE['DateFin']."</span>";
        echo "<br/>";
    }
    ?>
</body>