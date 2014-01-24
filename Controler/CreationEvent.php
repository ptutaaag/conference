<?php
session_start();
include_once("../Model/Evenement.php");
include("../Model/Utilisateur.php");
include_once("../Controler/Menu.php");
include_once("../Vue/CreationEvent.php");

if (!isset($_SESSION['iduser'])&&!isAdmin($_SESSION['iduser']))
{
    header("Location : index.php ");
}

if (isset($_POST['nomEvenement']) && isset($_POST['contenuEvenement']) && isset($_POST['lieuEvenement'])  && isset($_POST['dateDebut'])  && isset($_POST['dateFin']) ) {
if (empty($_POST['nomEvenement']) || empty($_POST['contenuEvenement']) || empty($_POST['lieuEvenement']) || empty($_POST['dateDebut']) || empty($_POST['dateFin'])) {
    echo "Veuillez remplir tout les champs";
}
    else
    {
    if (verifierDate($_POST['dateDebut'], $_POST['dateFin'])==true)
    {
        $res = createEvenement($_POST['dateDebut'], $_POST['dateFin'],$_POST['nomEvenement'],$_POST['contenuEvenement'],$_SESSION['iduser'],$_POST['lieuEvenement']);
        if (isset($res))
            echo "Ajout effectué";
    }
    else
        echo "Il y a un probleme dans les dates";
    }
}

?>
