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

    function searchTrip($searchTripUserId,$searchTripName,$searchTripFrom,$searchTripBetweenFromDate,$searchTripBetweenToDate,$connection)
    {    
        $nameQuery = "";
        $tripFromQuery = "";
        $dateQuery = "";

        if($searchTripName != NULL && $searchTripName != '')
        {
            $nameQuery = " and name = '" . $searchTripName . "'";
        }

        if($searchTripFrom != NULL && $searchTripFrom != '')
        {
            $tripFromQuery = " and tripFrom = '" . $searchTripFrom . "'";
        }

        if($searchTripBetweenFromDate and $searchTripBetweenToDate != NULL && $searchTripBetweenFromDate and $searchTripBetweenToDate != '')
        {
            $dateQuery = " and startDate BETWEEN '" . $searchTripBetweenFromDate . "' and '" . $searchTripBetweenToDate . "'";
        }
        $defaultQuery = "select tripId, userId, name, imagePath, tripFrom, tripTo, startDate, endDate, isActive
                        from trip 
                        where (isActive = 'Yes' OR isActive = 'No') and userId = '$searchTripUserId' " .$nameQuery .  $tripFromQuery . $dateQuery .
                        " order by createDate;";        
        $result = mysqli_query($connection, $defaultQuery);        
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC); 
        return $rows;    
    }

    function disableTrip($disalbeTripId,$connection)
    {
        $success = FALSE;
        $query = "update trip set isActive = 'No' where tripId = " .$disalbeTripId;
        $result = mysqli_query($connection, $query);
        if($result == 1)
        {
            $success = TRUE;
        }
        return $success; 
    }

    function deleteTrip($deleteTripId,$connection)
    {
        $success = FALSE;

        $query = "delete from trip where tripId = " .$deleteTripId;
        $result = mysqli_query($connection, $query);
        if($result == 1)
        {
            $success = TRUE;
        }
        return $success; 
    }
?>