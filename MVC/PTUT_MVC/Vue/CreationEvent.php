<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="../dtpicker/jquery.datetimepicker.css"/ >
    <script src="../dtpicker/jquery.js"></script>
    <script src="../dtpicker/jquery.datetimepicker.js"></script>
    <meta http-equiv="Content-Type"
          content="text/html;charset=utf-8"/>
    <title>Création d'un évènement</title>
</head>
<body>
<!-- Script pour les selectionneurs de dates -->
<script>
    $(function(){
        $('#datetimepicker').datetimepicker({
            formatDate:'Y/m/d',
            minDate:'2014/01/10',//yesterday is minimum date(for today use 0 or -1970/01/01)
            maxDate:'2014/01/28'//tommorow is maximum date calendar
        });

        $('#datetimepicker2').datetimepicker({
            formatDate:'Y/m/d',
            minDate:'2014/01/10',//yesterday is minimum date(for today use 0 or -1970/01/01)
            maxDate:'2014/01/28'//tommorow is maximum date calendar
        });
    });

</script>

<!-- Formulaire de creation d'evenement -->
<div id='creationEvenement'>
        <h2> Voulez vous créer un évenement ? </h2>
        <form method='post' name='formCreationEvenement'>
            <span> Nom de l'evenement : </span>
            <br/>
            <input type='text' name='nomEvenement' value='' > </input>
            <br/>
            <span> Contenu de l'evenement : </span>
            <br/>
            <textarea name='contenuEvenement'  rows = 10 cols = 80> </textarea>
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
 </body>


 
 

