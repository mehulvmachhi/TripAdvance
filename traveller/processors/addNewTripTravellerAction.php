<?php
    if(!isset($_SESSION))
    {
        session_start();
    }
    $loggedTripUser = isset($_SESSION['loggedTripUser']) ?$_SESSION['loggedTripUser'] : array();
?>
<?php
    if (!isset($_SESSION['loggedTripUser']))
    {
        header("Location:../../index.php");
        exit;
    }
?>
<?php

    require_once dirname(__FILE__) . '/../../include/dbconnect.php';
    require_once dirname(__FILE__) . '/../../include/commonPhpFunction.php';
    header("Content-Type: text/json; charset=utf-8");

    $userId = $loggedTripUser['id'];

    if(isset($_POST['submitUserTripId']) && $_POST['submitUserTripId'] != '')
    {

    }
?>