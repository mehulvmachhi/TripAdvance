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
    
    function insertTripTraveller($travellerId,$loggedUserid,$connection)
    {
        $success = FALSE;
        $member_list = array();        
        if(isset($_SESSION['lastInsertTripId']))
        {
            $lastInsertTripId = $_SESSION['lastInsertTripId'];
        }
        
        if(!empty($travellerId)) 
        {
            foreach($travellerId as $check) 
            {
                array_push($member_list, $check);
            }            
            array_push($member_list, $loggedUserid);
        }
                
        foreach($member_list as $members)
        {            
            $query = "INSERT INTO traveller(userId,tripId,createDate) VALUES ('$members',$lastInsertTripId,CURDATE())";    
            $result = mysqli_query($connection, $query);
        }
                
        if($result == 1)
        {
            $success = TRUE;
        }
        return $success;
    }
    
    function getTravellerUserForTrip($userId,$connection)
    {
        $query = "select * from user where isActive = 'Yes' and userId != " . $userId;
        $result = mysqli_query($connection, $query);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $rows;
    }                        
    
   /* function getUserByTrip($userId,$connection)
    {
        $query = "select * from user where isActive = 'Yes' and userId != " . $userId;
        $result = mysqli_query($connection, $query);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $rows;
    }*/
    
?>