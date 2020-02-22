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
    require_once dirname(__FILE__) . '/../db/tripTravellerFunction.php';
    header("Content-Type: text/json; charset=utf-8");
    
    $userId = $loggedTripUser['id'];
    
    if(isset($_POST['submitTripTraveller']) && $_POST['submitTripTraveller'] == 'Add Traveller')
    {             
        $travellerId = $_POST['travellerId'];
        $loggedUserid = $loggedTripUser['id'];        
        $success = insertTripTraveller($travellerId,$loggedUserid,$connection);                                     
    }
    elseif(isset($_POST['getTravellerUser']) && $_POST['getTravellerUser'] == 'getTravellerUser')
    {    
        $success = getTravellerUserForTrip($userId,$connection);                                     
    }            
    
    $tripTravellerArray = $success;
    print(json_encode($tripTravellerArray));
?>