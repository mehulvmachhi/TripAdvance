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
    require_once dirname(__FILE__) . '/../db/manageTripFunction.php';
    header("Content-Type: text/json; charset=utf-8");

    if(isset($_POST['searchTrip']) && $_POST['searchTrip'] == 'Search')
    {
        $searchTripUserId = isset($_POST['searchTripUserId']) ? $_POST['searchTripUserId'] : '';
        $searchTripName = isset($_POST['searchTripName']) ? $_POST['searchTripName'] : '';
        $searchTripFrom = isset($_POST['searchTripFrom']) ? $_POST['searchTripFrom'] : '';
        $searchTripBetweenFromDate = (isset($_POST['searchTripBetweenFromDate']) && $_POST['searchTripBetweenFromDate'] != '') ? sqlCompatibleDateFormatter($_POST['searchTripBetweenFromDate']):'';
        $searchTripBetweenToDate = (isset($_POST['searchTripBetweenToDate']) && $_POST['searchTripBetweenToDate'] != '') ? sqlCompatibleDateFormatter($_POST['searchTripBetweenToDate']):'';
        $success = searchTrip($searchTripUserId,$searchTripName,$searchTripFrom,$searchTripBetweenFromDate,$searchTripBetweenToDate,$connection);
    }
    elseif(isset($_POST['submitDisable']) && $_POST['submitDisable'] == 'Disable')
    {
        $disalbeTripId = isset($_POST['disalbeTripId']) ? $_POST['disalbeTripId'] : "";
        $success = disableTrip($disalbeTripId,$connection);
    }
    elseif(isset($_POST['submitDelete']) && $_POST['submitDelete'] == 'Delete')
    {
        $deleteTripId = isset($_POST['deleteTripId']) ? $_POST['deleteTripId'] : "";
        $success = deleteTrip($deleteTripId,$connection);
    }

    $manageTripArray = $success;
    // print_r($manageTripArray);exit();
    print(json_encode($manageTripArray));
?>