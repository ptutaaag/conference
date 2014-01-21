<?php
require_once("params.inc.php");
require_once('Utilisateur.php');
?>
    <!DOCTYPE html>

    <html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=UTF-8"/>
        <link type="text/css" rel="stylesheet" href="Style1.css"/>
        <title> Connexion </title>
    </head>

    <body>
<?php
    $user = new utilisateur();
    $login = $_POST['login'];
    $mdp = $_POST['mdp'];
    $iduser = $user->connexion($login, $mdp);

    //si connexion a marché
    if ($iduser > 0) {
        $_SESSION['iduser'] = $iduser;
        $_SESSION['login'] = $login;
        echo $_SESSION['iduser'];

        header('Location: index.php');
    } else {
        echo "
    <div id='loginForm'>
        <h2> Bienvenue sur le site </h2>
        <form method='post' name='formConnec'>
            <span> Login : </span>
            <br/>
            <input type='text' name='login' value='' > </input>
            <br/>
            <span> Mot de passe : </span>
            <br/>
            <input type='password' name='mdp'> </input>
            <br/>
            <input type='submit' name='valider' value='Connexion'> </input>
        </form>
    </div> ";
    }
?>