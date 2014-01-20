<?php
include("Evenement.php");


if (isset($_POST['nomEvenement'])==false && isset($_POST['contenuEvenement'])==false && isset($_POST['lieuEvenement'])==false){
echo "
<div id='creationEvenement'>
        <h2> Voulez vous créer un évenement ? </h2>
        <form method='post' name='formCreationEvenement'>
            <span> Nom de l'evenement : </span>
            <br/>
            <input type='text' name='nomEvenement' value='' > </input>
            <br/>
            <span> Contenu de l'evenement : </span>
            <br/>
            <input type='text' name='contenuEvenement'> </input>
            <br/>
            <span> Localisation de l'evenement : </span>
            <br/>
            <input type='text' name='lieuEvenement'> </input>
            <br/>
            <input type='submit' name='valider' value='Créer l'evenement> </input>
        </form>
    </div>
";
}
else {


$eventCree =  new Evenement();
    $timestamp = '31/05/2001 12:22:56';
    $timestamp = date_create_from_format('d/m/Y H:i:s', $timestamp);
    $dd=date_format($timestamp, 'Y-m-d H:i:s');

    $timestamp = '31/05/2021 12:22:56';
   $timestamp = date_create_from_format('d/m/Y H:i:s', $timestamp);
    $df = date_format($timestamp,'Y-m-d H:i:s');

    $eventCree->dateDeDebut =$dd;
    $eventCree->dateDeFin =$df;
    $eventCree->description=$_POST['contenuEvenement'];
    $eventCree->titre=$_POST['nomEvenement'];
    $eventCree->lieu=$_POST['lieuEvenement'];

$idEvenement = $eventCree->createEvenement();




if ($idEvenement>0)
{
    echo "Ajout réussi !";
}



}
?>