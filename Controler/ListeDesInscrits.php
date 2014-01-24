<HEAD> <meta http-equiv="Content-Type"
             content="text/html;charset=utf-8"/></HEAD>
<?php
session_start();
include_once("../Controler/Menu.php");
require_once("../params.inc.php");
    $_SESSION['db_host']=$host;
    $_SESSION['db_user']=$user;
    $_SESSION['db_password']=$password;
    $_SESSION['db_dbname']=$dbname;
    $page = 1;


    if(isset($_POST['go'])){
        permission();
    }

    if(isset($_GET['page'])){
        $page = @$_SESSION['page'];

        switch (@$_GET['page']) {
            case "<<":
                $page = 1;
                break;
            case "<":
                $page = $page < 2 ? 1 : $page-1;
                break;
            case ">":
                $page++;
                break;
            case ">>":
                if(isset($TOTAL_PAGE)){
                    $page = $TOTAL_PAGE;
                } else {
                    $page = 1;
                }
                break;
            default :
                $page = $_GET['page'];
                break;
        }
    } else {
        $page = 1;
    }

    if (!is_numeric($page)){
        $page = 1;
    }

    $MAX_PER_PAGE = 30;

    $_SESSION['page'] = $page;

        $isLogin = 0;
        $isAdmin = 0;
        $db = mysqli_connect($_SESSION['db_host'],$_SESSION['db_user'],$_SESSION['db_password'],$_SESSION['db_dbname']);

        if(isset($_SESSION['login'])){
            $isLogin = 1;
            $req = "SELECT Admin FROM utilisateur WHERE idUtilisateur=".$_SESSION['iduser'];
            $res = mysqli_query($db, $req) or die (mysqli_connect_error());
            $ligne = mysqli_fetch_object($res);
            $isAdmin = $ligne->Admin;
        }

        $req = 'SELECT COUNT(*) as cpt FROM utilisateur';
        $res = mysqli_query($db, $req) or die (mysqli_connect_error());
        $ligne = mysqli_fetch_array($res);
        $count = $ligne['cpt'];
        $first = ($page - 1) * $MAX_PER_PAGE;
        $TOTAL_PAGE = ($count / $MAX_PER_PAGE) + 1;

        $req = 'SELECT * FROM utilisateur LIMIT '.$first.', '.$MAX_PER_PAGE;
		$res = mysqli_query($db, $req) or die ("Erreur dans la récupération des inscrits");
        mysqli_close($db);

        if($isAdmin){
            echo '<span style=\"font-weight: bold; color: #f00\">'.@$_SESSION['sql_error'].'</span><br />';
            echo '<form method="post" action="" id="liste" enctype="multipart/form-data">';
        }

        ?>
            <table class="tab">
                <tr>
                    <th class="">Nom Prénom</th>
                    <?php
                        if($isAdmin){
                            echo '<th class="">Administrateur</th><th class="">Conférencier</th><th class="">Action Admin</th><th class="">Action Conférencier</th>';
                        }
                    ?>
                </tr>
            <?php
                while ($ligne = mysqli_fetch_object($res)){
                    echo "<tr>";
                        if ($isAdmin){
                            echo '<td class=""><a href="PageUtilisateur.php?id='.$ligne->idUtilisateur.'">'.$ligne->Nom.' '.$ligne->Prenom.'</a></td>';
                            $isAChecked = $ligne->Admin == 1 ? 'checked="checked"' : '';
                            $isCChecked = $ligne->Conferencier == 1 ? 'checked="checked"' : '';
                            echo '<td class=""><input type="checkbox" name="admin[]" value="'.$ligne->idUtilisateur.'" disabled="disabled" '.$isAChecked.'/></td>';
                            echo '<td class=""><input type="checkbox" name="confe[]" value="'.$ligne->idUtilisateur.'" disabled="disabled" '.$isCChecked.'/></td>';
                            $isAChecked = $ligne->Admin == 1 ? 'revoke Admin' : 'set Admin';
                            $AChecked = $ligne->Admin == 1 ? 'reva' : 'seta';
                            $isCChecked = $ligne->Conferencier == 1 ? 'revoke Conférencier' : 'set Conférencier';
                            $CChecked = $ligne->Conferencier == 1 ? 'revc' : 'setc';
                            echo '<td class=""><input type="submit" name="go['.$AChecked.']['.$ligne->idUtilisateur.']" value="'.$isAChecked.'"/></td>';
                            echo '<td class=""><input type="submit" name="go['.$CChecked.']['.$ligne->idUtilisateur.']" value="'.$isCChecked.'"/></td>';

                        } else if ($isLogin) {
                            echo "<td class=\"\"><a href='PageUtilisateur.php?id=".$ligne->idUtilisateur."'>".$ligne->Nom." ".$ligne->Prenom."</a></td>";
                        } else {
                            echo "<td class=\"\">".$ligne->Nom." ".$ligne->Prenom."</td>";
                        }
                    echo "</tr>";
                }

            echo "</table>";
        if($isAdmin){
            echo '</form>';
        }

        $min = $page - 3 < 1 ? 1 : $page - 2;
        $max = $page + 2 < 6 ? 6 : $page + 3;

        echo '<form method="get" action="" id="pages" >';
                echo '<input type="submit" name="page" value="<<"/>';
                echo '<input type="submit" name="page" value="<"/>';
            for($i=$min ; $i<$max; $i++){
                echo '<input type="submit" name="page" value="'.$i.'"/>';
            }
                echo '<input type="submit" name="page" value=">"/>';
                echo '<input type="submit" name="page" value=">>"/>';
        echo '</form>';

?>


<?php
    function permission(){
        $reva = @$_POST['go']['reva'];
        $seta = @$_POST['go']['seta'];
        $revc = @$_POST['go']['revc'];
        $setc = @$_POST['go']['setc'];

         if(count($reva) == 1){
            foreach($reva as $key => $value) $req = 'UPDATE utilisateur SET Admin=0 WHERE idUtilisateur='.$key;
        }
        if(count($seta) == 1){
            foreach($seta as $key => $value) $req = 'UPDATE utilisateur SET Admin=1 WHERE idUtilisateur='.$key;
        }
        if(count($revc) == 1){
            foreach($revc as $key => $value) $req = 'UPDATE utilisateur SET Conferencier=0 WHERE idUtilisateur='.$key;
        }
        if(count($setc) == 1){
            foreach($setc as $key => $value) $req = 'UPDATE utilisateur SET Conferencier=1 WHERE idUtilisateur='.$key;
        }

        $db = mysqli_connect($_SESSION['db_host'],$_SESSION['db_user'],$_SESSION['db_password'],$_SESSION['db_dbname']);
        $res = mysqli_query($db, $req) or die (mysqli_connect_error());
        mysqli_close($db);
           
    }
    
?>
