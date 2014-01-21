<DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="dtpicker/jquery.datetimepicker.css"/ >
    <script src="dtpicker/jquery.js"></script>
    <script src="dtpicker/jquery.datetimepicker.js"></script>

</head>
<?php
include("Evenement.php");
/**
 * Created by PhpStorm.
 * User: Geoffrey
 * Date: 17/01/14
 * Time: 10:07
 */

$idUser = 1;

if (isset($_POST['nomEvenement'])==false && isset($_POST['contenuEvenement'])==false && isset($_POST['lieuEvenement'])==false){

    $connection= mysqli_connect($_SESSION['db_host'],$_SESSION['db_user'],$_SESSION['db_password'],$_SESSION['db_dbname']);
    $req = "SELECT * from Conference";
    $res = mysqli_query($connection,$req) or die("Impossible de trouver une conférence");
$d1=$d2=date('Y-m-d H:i:s');

    while ($ligne = mysqli_fetch_object(($res)))
    {
        $d1 = $ligne->DateDebut;
        $d2 = $ligne->DateFin;
    }

    $timestamp = date_create_from_format('Y-m-d H:i:s', $d1);
    $d1 = date_format($timestamp,'Y/m/d');

    $timestamp = date_create_from_format('Y-m-d H:i:s', $d2);
    $d2 = date_format($timestamp,'Y/m/d');

    echo "<script>
    $(function(){
 $('#datetimepicker').datetimepicker({
 formatDate:'Y/m/d',
 minDate:'$d1',//yesterday is minimum date(for today use 0 or -1970/01/01)
 maxDate:'$d2'//tommorow is maximum date calendar
});

 $('#datetimepicker2').datetimepicker({
 formatDate:'Y/m/d',
 minDate:'$d1',//yesterday is minimum date(for today use 0 or -1970/01/01)
 maxDate:'$d2'//tommorow is maximum date calendar
});
});
</script>";

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
            <span>Date de debut:</span>
           <br/>
           <input type='text' name='dateDebut' id='datetimepicker'> </input>
        <br/>
        <span>Date de fin:</span>
           <br/>
           <input type='text' name='dateFin' id='datetimepicker2'> </input>
           <br/>
            <input type='submit' name='valider' value='Créer l'evenement> </input>
            </form>

    </div>
";
}
else {




    $dd=$_POST['dateDebut'];
    $df=$_POST['dateFin'];

    $timestamp = date_create_from_format('Y/m/d H:i', $dd);
    $timed = date_format($timestamp,'YmdHi');

    $timestamp = date_create_from_format('Y/m/d H:i', $df);
    $timef = date_format($timestamp,'YmdHi');


if ($timef>$timed)
{

        $eventCree =  new Evenement();
   $timestamp = date_create_from_format('Y/m/d H:i', $dd);
    $dd = date_format($timestamp,'Y-m-d H:i:s');

    $timestamp = date_create_from_format('Y/m/d H:i', $df);
    $df = date_format($timestamp,'Y-m-d H:i:s');

    $eventCree->dateDeDebut =$dd;
    $eventCree->dateDeFin =$df;
    $eventCree->description=$_POST['contenuEvenement'];
    $eventCree->titre=$_POST['nomEvenement'];
    $eventCree->lieu=$_POST['lieuEvenement'];
    $eventCree->utilisateur=$idUser;

$idEvenement = $eventCree->createEvenement();

}

    else
        echo "Erreur dans les dates";



if ($idEvenement>0)
{
    echo "Ajout réussi !";

}



}
?>