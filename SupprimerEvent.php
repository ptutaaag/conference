<?php
session_start();
include("Menu.php");
afficherBanniere();

if (!isset($_SESSION['login'])) {
    header('Location: index.php');
    exit();
}

if (!isset($_GET['idEvent']) || empty($_GET['idEvent'])) {
    header('Location: ListeDesEvenements.php');
    exit();
} else {
    $db = new mysqli($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
    $sql = 'DELETE FROM evenement WHERE idCreateur="' . $_SESSION['iduser'] . '" AND idEvenement="' . $_GET['idEvent'] . '"';
    $req = mysqli_query($db, $sql) or die(mysqli_connect_error());

    mysqli_close($db);

    header('Location: ListeDesEvenements.php');
    exit();
}
?>