<?php
session_start();
include_once("../Model/Utilisateur.php");

if (!isset($_SESSION['iduser']))
{
    header("Location : index.php ");
}

function inscription(){
    $lfile  = "42";
    $ufile  = @$_POST['ufile'];


    if ($ufile == ""){
        if ($_FILES['lfile']['error'] > 0){
            $_SESSION['file_error'] = 'Aucun fichier sélectioné';
            return;

        } else {
            if ($_FILES['lfile']['size'] > 104857600){
                $_SESSION['file_error'] = 'Le fichier sélectioné est trop lourd';
                return;
            }

            $file = $_FILES['lfile']['tmp_name'];
            $file = str_replace('\\', '\\\\', $file);
        }

    } else {
        if ($_FILES['lfile']['error'] > 0){
            $file = $ufile;

        } else {
            $_SESSION['file_error'] = 'Trop de fichiers sélectionés';
            return;

        }
    }

    $lignes = file($file);

    for( $i = 1 ; $i < count($lignes)-2 ; $i=$i+3 ){
        inscrireUtilisateur($lignes[i],$lignes[i+1],$lignes[i+2],mdp());
    }

    return;
}

function mdp(){
    $chaine = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $nb_caract = 8;
    $pass = "";

    for($i = 1; $i <= $nb_caract; $i++) {
        $nb = strlen($chaine);
        $nb = mt_rand(0,($nb-1));
        $pass.=$chaine[$nb];
    }

    return $pass;

}

include_once("../Vue/administration.php");
