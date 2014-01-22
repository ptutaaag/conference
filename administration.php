<?php
    session_start(); // this MUST be called prior to any output including whitespaces and line breaks!

    require_once("params.inc.php");
    $_SESSION['db_host']=$host;
    $_SESSION['db_user']=$user;
    $_SESSION['db_password']=$password;
    $_SESSION['db_dbname']=$dbname;
    
    if(isset($_POST['go'])){
        inscription();
    }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
  <title>Page d'administration</title>
</head>
<body>
    <form method="post" action="" id="contact_form" enctype="multipart/form-data">
        <p>
            Inscrire des utilisateur: &nbsp; &nbsp;<?php echo "<span style=\"font-weight: bold; color: #f00\">".@$_SESSION['file_error']."</span>" ?><br />
            <input type="hidden" name="MAX_FILE_SIZE" value="104857600"> 
            <input type="file" name="lfile" id="lfile" value="choisir un fichier"/><br/>
            <input type="text" name="ufile" placeholder="ou sélection un lien" /><br/>
            <input type="submit" name="go" value="inscription" />
        </p>
    </form>

</body>
</html>

<?php
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
            $req = "INSERT INTO utilisateur VALUES ('', '".$lignes[$i]."', '".$lignes[$i+1]."', '".$lignes[$i+2]."', '".mdp()."', 0, 0, '', '".date("Y-m-d H:i:s")."')";
            $db = mysqli_connect($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
            $res = mysqli_query($db,$req) or die(mysqli_connect_error());
            mysqli_close($db);

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
?>