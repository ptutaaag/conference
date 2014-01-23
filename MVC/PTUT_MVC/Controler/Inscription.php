<?php
session_start(); // this MUST be called prior to any output including whitespaces and line breaks!

require_once("../params.inc.php");
$_SESSION['db_host'] = $host;
$_SESSION['db_user'] = $user;
$_SESSION['db_password'] = $password;
$_SESSION['db_dbname'] = $dbname;


?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
        <title>Page d'inscription</title>

        <style type="text/css">
            <!--
            .error {
                color: #f00;
                font-weight: bold;
                font-size: 1.2em;
            }

            .success {
                color: #00f;
                font-weight: bold;
                font-size: 1.2em;
            }

            fieldset {
                width: 90%;
            }

            legend {
                font-size: 24px;
            }

            .note {
                font-size: 18px;
            -->
        </style>
    </head>
    <body>
    <?php process_si_contact_form(); ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'] . $_SERVER['QUERY_STRING']) ?>"
          id="contact_form">
        <input type="hidden" name="do" value="contact"/>

        <p>
            <strong>Nom:</strong>&nbsp; &nbsp;<?php echo @$_SESSION['ctform']['name_error'] ?><br/>
            <input type="text" name="ct_name" size="35"
                   value="<?php echo htmlspecialchars(@$_SESSION['ctform']['ct_name']) ?>"/>
        </p>

        <p>
            <strong>Prénom:</strong>&nbsp; &nbsp;<?php echo @$_SESSION['ctform']['fname_error'] ?><br/>
            <input type="text" name="ct_fname" size="35"
                   value="<?php echo htmlspecialchars(@$_SESSION['ctform']['ct_fname']) ?>"/>
        </p>

        <p>
            <strong>Email:</strong>&nbsp; &nbsp;<?php echo @$_SESSION['ctform']['email1_error'] ?><br/>
            <input type="text" name="ct_email1" size="35"
                   value="<?php echo htmlspecialchars(@$_SESSION['ctform']['ct_email1']) ?>"/>
        </p>

        <p>
            <strong>Retaper l'Email:</strong>&nbsp; &nbsp;<?php echo @$_SESSION['ctform']['email2_error'] ?><br/>
            <input type="text" name="ct_email2" size="35"
                   value="<?php echo htmlspecialchars(@$_SESSION['ctform']['ct_email2']) ?>"/>
        </p>

        <p>
            <strong>Mot de passe:</strong>&nbsp; &nbsp;<?php echo @$_SESSION['ctform']['pass1_error'] ?><br/>
            <input type="password" name="ct_pass1" size="35"
                   value="<?php echo htmlspecialchars(@$_SESSION['ctform']['ct_pass1']) ?>"/>
        </p>

        <p>
            <strong>Retaper le mot de passe:</strong>&nbsp; &nbsp;<?php echo @$_SESSION['ctform']['pass2_error'] ?><br/>
            <input type="password" name="ct_pass2" size="35"
                   value="<?php echo htmlspecialchars(@$_SESSION['ctform']['ct_pass2']) ?>"/>
        </p>

        <p>
            <img id="siimage" style="border: 1px solid #000; margin-right: 15px"
                 src="../captcha/securimage_show.php?sid=<?php echo md5(uniqid()) ?>" alt="CAPTCHA Image" align="left"/>
            <object type="application/x-shockwave-flash"
                    data="../captcha/securimage_play.swf?bgcol=#ffffff&amp;icon_file=../captcha/images/audio_icon.png&amp;audio_file=../captcha/securimage_play.php"
                    height="32" width="32">
                <param name="movie"
                       value="../captcha/securimage_play.swf?bgcol=#ffffff&amp;icon_file=../captcha/images/audio_icon.png&amp;audio_file=../captcha/securimage_play.php"/>
            </object>
            &nbsp;
            <a tabindex="-1" style="border-style: none;" href="#" title="Refresh Image"
               onclick="document.getElementById('siimage').src = '../captcha/securimage_show.php?sid=' + Math.random(); this.blur(); return false"><img
                    src="../captcha/images/refresh.png" alt="Reload Image" height="32" width="32" onclick="this.blur()"
                    align="bottom" border="0"/></a><br/>
            <strong>Entre le Code:</strong><br/>
            <?php echo @$_SESSION['ctform']['captcha_error'] ?>
            <input type="text" name="ct_captcha" size="12" maxlength="16"/>
        </p>

        <p>
            <br/>
            <input type="submit" value="Inscription"/>
        </p>

    </form>

    </body>
    </html>

<?php

// The form processor PHP code
function process_si_contact_form()
{
    $_SESSION['ctform'] = array(); // re-initialize the form session data

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$_POST['do'] == 'contact') {
        // if the form has been submitted

        foreach ($_POST as $key => $value) {
            if (!is_array($key)) {
                // sanitize the input data
                if ($key != 'ct_message') $value = strip_tags($value);
                $_POST[$key] = htmlspecialchars(stripslashes(trim($value)));
            }
        }

        $name = @$_POST['ct_name']; // name from the form
        $fname = @$_POST['ct_fname'];
        $email1 = @$_POST['ct_email1']; // email from the form
        $email2 = @$_POST['ct_email2']; // email from the form
        $pass1 = @$_POST['ct_pass1']; // url from the form
        $pass2 = @$_POST['ct_pass2'];
        $captcha = @$_POST['ct_captcha']; // the user's entry for the captcha code
        $name = substr($name, 0, 64); // limit name to 64 characters

        $errors = array(); // initialize empty error array

        if (strlen($name) < 1) {
            // name too short, add error
            $errors['name_error'] = 'Nom d\'utilisateur invalide';
        }

        if (strlen($name) < 1) {
            // name too short, add error
            $errors['fname_error'] = 'Prénom d\'utilisateur invalide';
        }

        if (strlen($email1) == 0) {
            // no email address given
            $errors['email1_error'] = 'Adresse Email requise';
        } else if (!preg_match('/^(?:[\w\d]+\.?)+@(?:(?:[\w\d]\-?)+\.)+\w{2,4}$/i', $email1)) {
            // invalid email format
            $errors['email1_error'] = 'l\'adresse Email est invalide';
        } else if ($email1 != $email2) {
            $errors['email2_error'] = 'les adresses Email sont différentes';
        } else if ($email1 == $email2) {
            $req = "SELECT * FROM utilisateur WHERE Mail='" . $email1 . "'";
            $db = mysqli_connect($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
            $res = mysqli_query($db, $req) or die(mysqli_connect_error());
            $nb = mysqli_num_rows($res);

            if ($nb > 0) {
                $errors['email1_error'] = 'L\'adresse email est déjà utilisée!';
            }

            mysqli_close($db);
        }

        if (strlen($pass1) < 8) {
            // message length too short
            $errors['pass1_error'] = 'Mot de passe incorrecte';
        } else if ($pass1 != $pass2) {
            $errors['pass1_error'] = 'Les mots de passe sont différents';
        }

        // Only try to validate the captcha if the form has no errors
        // This is especially important for ajax calls
        if (sizeof($errors) == 0) {
            require_once dirname(__FILE__) . '/captcha/securimage.php';
            $securimage = new Securimage();

            if ($securimage->check($captcha) == false) {
                $errors['captcha_error'] = 'Incorrect security code entered<br />';
            }
        }


        if (sizeof($errors) == 0) {
            // no errors, send the form

            if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $email1)) // On filtre les serveurs qui rencontrent des bogues.
            {
                $passage_ligne = "\r\n";
            } else {
                $passage_ligne = "\n";
            }
            //=====Déclaration des messages au format texte et au format HTML.
            $message_txt = "A message was submitted from the contact form.  The following information was provided.<br /><br />"
                . "Name: $name<br />"
                . "FName: $fname<br />"
                . "Email: $email1<br />"
                . "pass: $pass1<br />"
                . "cpass: sha1($pass1)<br />"
                . "Message:<br />"
                . "<pre>nique ton papa putain de message de merde!</pre>"
                . "<br /><br />IP Address: {$_SERVER['REMOTE_ADDR']}<br />"
                . "Time: " . date('r') . "<br />"
                . "Browser: {$_SERVER['HTTP_USER_AGENT']}<br />";
            $message_html = "<html><head></head><body><b>Salut à tous</b>, voici un e-mail envoyé par un <i>script PHP</i>.</body></html>";
            //==========

            //=====Création de la boundary
            $boundary = "-----=" . md5(rand());
            //==========

            //=====Définition du sujet.
            $sujet = "Test envoie email";
            //=========

            //=====Création du header de l'e-mail.
            $header = "From: \"Ptut AAAG\"<ptut.aaag@gmail.com>" . $passage_ligne;
            $header .= "Reply-to: \"Ptut AAAG\" <ptut.aaag@gmail.com>" . $passage_ligne;
            $header .= "MIME-Version: 1.0" . $passage_ligne;
            $header .= "Content-Type: multipart/alternative;" . $passage_ligne . " boundary=\"$boundary\"" . $passage_ligne;
            //==========

            //=====Création du message.
            $message = $passage_ligne . "--" . $boundary . $passage_ligne;
            //=====Ajout du message au format texte.
            $message .= "Content-Type: text/plain; charset=\"ISO-8859-1\"" . $passage_ligne;
            $message .= "Content-Transfer-Encoding: 8bit" . $passage_ligne;
            $message .= $passage_ligne . $message_txt . $passage_ligne;
            //==========
            $message .= $passage_ligne . "--" . $boundary . $passage_ligne;
            //=====Ajout du message au format HTML
            $message .= "Content-Type: text/html; charset=\"ISO-8859-1\"" . $passage_ligne;
            $message .= "Content-Transfer-Encoding: 8bit" . $passage_ligne;
            $message .= $passage_ligne . $message_html . $passage_ligne;
            //==========
            $message .= $passage_ligne . "--" . $boundary . "--" . $passage_ligne;
            $message .= $passage_ligne . "--" . $boundary . "--" . $passage_ligne;
            //==========

            //=====Envoi de l'e-mail.
            mail($email1, $sujet, $message, $header);

            $req = "INSERT INTO utilisateur VALUES ('', '" . $name . "', '" . $fname . "', '" . $email1 . "', '" . $pass1 . "', 0, 0, '', '" . date("Y-m-d H:i:s") . "')";
            $db = mysqli_connect($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_password'], $_SESSION['db_dbname']);
            $res = mysqli_query($db, $req) or die(mysqli_connect_error());
            mysqli_close($db);


            $_SESSION['ctform']['error'] = false; // no error with form
            $_SESSION['ctform']['success'] = true; // message sent
        } else {
            // save the entries, this is to re-populate the form
            $_SESSION['ctform']['ct_name'] = $name; // save name from the form submission
            $_SESSION['ctform']['ct_fname'] = $fname;
            $_SESSION['ctform']['ct_email1'] = $email1; // save email
            $_SESSION['ctform']['ct_email2'] = $email2; // save email
            $_SESSION['ctform']['ct_pass1'] = $pass1; // save URL
            $_SESSION['ctform']['ct_pass2'] = $pass2; // save email

            foreach ($errors as $key => $error) {
                // set up error messages to display with each field
                $_SESSION['ctform'][$key] = "<span style=\"font-weight: bold; color: #f00\">$error</span>";
            }

            $_SESSION['ctform']['error'] = true; // set error floag
        }
    }
}

$_SESSION['ctform']['success'] = false; // clear success value after running
