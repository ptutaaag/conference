<?
session_start();
include_once("../Model/Utilisateur.php");
include_once("../Controler/Menu.php");/**
 * Created by PhpStorm.
 * User: Geoffrey
 * Date: 22/01/14
 * Time: 20:57
 */

if (!isset($_SESSION['iduser']))
{
    header("Location : index.php ");
}

if (isset($_POST['enregistrer'])&&!empty($_POST['amdp'])&&!empty($_POST['nmdp'])&&!empty($_POST['cmdp']))
{
    $mdpa = $_POST['amdp'];
    $mdpn = $_POST['nmdp'];
    $mdpc = $_POST['cmdp'];

    if ($mdpa != getMotDePasse($_SESSION['iduser'])) {
        echo 'Ancien mot de passe éronné.';
    } else if ($mdpn != $mdpc) {
        echo 'Le nouveau mot de passe et la confirmation ne sont pas identiques.';
    } else {
        echo "Changement réussi";
        changerMdp($_SESSION['iduser'],$mdpn);
    }

}

include_once("../Vue/ModifUserMDP.php");