<?php
session_start();
include("Menu.php");
afficherBanniere();

if (!isset($_SESSION['login'])) {
    header('Location: index.php');
    exit();
}

if (!isset($_GET['idMessage']) || empty($_GET['idMessage'])) {
    header('Location: MessageUser.php');
    exit();
} else {
    $db = new mysqli($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);

    $sql = 'DELETE FROM message WHERE id_destinataire="' . $_SESSION['iduser'] . '" AND idMessage="' . $_GET['idMessage'] . '"';
    $req = mysqli_query($db, $sql) or die(mysqli_connect_error());

    mysqli_close($db);

    header('Location: MessageUser.php');
    exit();
}
?>