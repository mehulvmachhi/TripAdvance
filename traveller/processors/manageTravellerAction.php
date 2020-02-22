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
    require_once dirname(__FILE__) . '/../db/manageTravellerFunction.php';
    header("Content-Type: text/json; charset=utf-8");

    if(isset($_POST['manageTravellerTripId']) && $_POST['manageTravellerTripId'] != '')
    {
        $manageTravellerTripId = $_POST['manageTravellerTripId'];
        $success = getManageTripTraveller($manageTravellerTripId,$connection);
    }
    elseif(isset($_POST['submitDelete']) && $_POST['submitDelete'] == 'Delete')
    {
        $deleteTripTravellerId = $_POST['deleteTripTravellerId'];
        $success = deleteTripTraveller($deleteTripTravellerId,$connection);
    }

    $manageTripTravellerArray = $success;
    // print_r($manageTripTravellerArray);exit();
    print(json_encode($manageTripTravellerArray));

?>