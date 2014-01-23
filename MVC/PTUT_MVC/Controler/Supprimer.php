<?php
session_start();

/**
 * Created by PhpStorm.
 * User: Geoffrey
 * Date: 22/01/14
 * Time: 23:53
 */
if (!isset($_SESSION['iduser']))
{
    header("Location : index.php ");
}

include_once("../Model/Message.php");

delMessage($_SESSION['iduser'],$_GET['id']);
header("Location : Message.php");