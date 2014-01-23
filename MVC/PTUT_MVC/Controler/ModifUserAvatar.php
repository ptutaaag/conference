<?php
session_start();
include_once("../Model/Utilisateur.php");
include_once("../Controler/Menu.php");
/**
 * Created by PhpStorm.
 * User: Geoffrey
 * Date: 22/01/14
 * Time: 21:14
 */

if (!isset($_SESSION['iduser'])) {
    header("Location : index.php ");
}

include_once("../Vue/ModifUserAvatar.php");

if (isset($_POST['enregistrer'])) {
    $uavatar = @$_POST['uavatar'];
    $maxwidth = 100;
    $maxheight = 100;

    if ($uavatar == "") {
        if ($_FILES['avatar']['error'] > 0) {
            echo 'Aucun fichier sélectioné';
            return;
        } else if ($_FILES['avatar']['error'] == 0) {
            $extensions_valides = array('png', 'jpeg', 'jpg', 'gif');
            $extension_upload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
            if (in_array($extension_upload, $extensions_valides)) {
                $image_sizes = getimagesize($_FILES['avatar']['tmp_name']);
                if ($image_sizes[0] > $maxwidth OR $image_sizes[1] > $maxheight) {
                    echo 'L\'image est trop grande';
                } else {
                    $nom = "../Avatars/" . $_SESSION['iduser'] . "." . $extension_upload;
                    $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $nom);
                    if ($resultat) {
                        echo "Transfert réussi";
                    } else {
                        return;
                    }
                }
            } else {
                echo 'L\'image n\'est pas au bon format';
            }
        }
    } else {
        if ($_FILES['avatar']['error'] > 0) {
            $nom = $uavatar;
        } else {
            echo 'Trop de fichiers sélectionés';
            return;
        }


    }
    changerAvatar($_SESSION['iduser'], $nom);
    header('Location: MaPage.php');
}





