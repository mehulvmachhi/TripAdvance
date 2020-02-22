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

    function getManageTripTraveller($manageTravellerTripId,$connection)
    {
        $query = "select user.userId, user.firstName, user.lastName, user.email, user.imagePath, user.mobile, traveller.travellerId
                    from user inner join traveller on traveller.userId = user.userId where traveller.tripId = " . $manageTravellerTripId;
        $result = mysqli_query($connection, $query);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $rows;
    }

    function deleteTripTraveller($deleteTripTravellerId,$connection)
    {
        $success = FALSE;
        $query = "delete from traveller where travellerId = " . $deleteTripTravellerId;
        $result = mysqli_query($connection, $query);
        if($result == TRUE)
        {
            $success = TRUE;
        }
        return $success;
    }



?>