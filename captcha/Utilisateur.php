<?php
session_start();
require_once("params.inc.php");
$_SESSION['db_host']=$host;
$_SESSION['db_user']=$user;
$_SESSION['db_password']=$password;
$_SESSION['db_dbname']=$dbname;


class utilisateur
{
    var $iduser;
    var $login;
    var $mdp;

    function utilisateur()
    {
        $iduser=null;
        $login=null;
        $mdp=null;
    }



    function connexion($logintmp,$mdptmp)
    {
        $error=false;
        if ($logintmp!=null)
            $login=$logintmp;
        else
            $error=true;
        if ($mdptmp!=null)
            $mdp=$mdptmp;
        else
            $error=true;

        if ($error==false){


            // on crée la requête SQL
            $sql = 'SELECT * FROM utilisateur  where Mail='."\"".$login.'" and Motdepasse='."\"".$mdp."\";";
            // on envoie la requête
            $db2 = new mysqli($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
            $res2 = mysqli_query($db2,$sql)  or die(mysqli_connect_error());
            if(mysqli_num_rows($res2)>0) {
                while($resultat = mysqli_fetch_object($res2))
                {
                    $iduser=$resultat->idUtilisateur;
                }
                mysqli_close($db2);
                return $iduser;

            }
            elseif(mysqli_num_rows($res2) == 0) {
                echo "Mot de passe ou login inconnu !";
                mysqli_close($db2);
                return -1;

            }
        }
        return -1;
    }
}

?>

