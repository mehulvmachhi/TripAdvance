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

function insertUpdateTrip($createTripUserId,$updateTripId,$createTripName,$createTripImageName,$createTripFrom,$createTripTo,$createTripStartDate,$createTripEndDate,$createTripEnable,$connection)
{
    $success = FALSE;
    
    if($updateTripId == 0)
    {            
        $query = "insert into trip(userId,name,imagePath,tripFrom,tripTo,startDate,endDate,createDate,isActive)
                    values('$createTripUserId',
                            '$createTripName',
                            '$createTripImageName',
                            '$createTripFrom',
                            '$createTripTo',
                            '$createTripStartDate',
                            '$createTripEndDate',
                            CURDATE(),
                            '$createTripEnable')"; 
        $result = mysqli_query($connection, $query);
        $lastInsertTripId = mysqli_insert_id($connection);
        $_SESSION['lastInsertTripId'] = $lastInsertTripId;
        if($result == TRUE)
        {
            $success = TRUE;
        }        
    }
    else
    {        
        $query = "update trip
                  SET name = '". $createTripName . "', 
                      imagePath = '". $createTripImageName . "',
                      tripFrom = '". $createTripFrom . "',
                      tripTo = '". $createTripTo . "',
                      startDate = '". $createTripStartDate . "',
                      endDate = '". $createTripEndDate . "',
                      createDate = CURDATE(),
                      isActive = '". $createTripEnable . "' where tripId = " . $updateTripId; 
        $result = mysqli_query($connection, $query);        
        $_SESSION['lastUpdateTripId'] = $updateTripId;
        if($result == TRUE)
        {
            $success = "UPDATE";
        }
    }        
    return $success;    
}

function getTripToUpdate($tripId,$connection)
{    
    $query = "select * from trip where tripId = " . $tripId;
    $result = mysqli_query($connection, $query);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $rows;    
}

/*function getTripToUpdate($tripId,$connection)
{    
    $query = "select trip.tripId, trip.name, trip.imagePath, trip.tripFrom, trip.tripTo, trip.startDate, trip.endDate, trip.createDate, 
              trip.isActive, traveller.userId from trip inner join traveller on traveller.tripId = trip.tripId where trip.tripId = " . $tripId;
    $result = mysqli_query($connection, $query);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
//    print_r($rows);
//    exit();
    return $rows;    
}*/

?>