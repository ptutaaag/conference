<?php
session_start();
session_unset($_SESSION['iduser']);
session_unset($_SESSION['login']);
session_destroy();
header('Location: index.php');
exit();
?>