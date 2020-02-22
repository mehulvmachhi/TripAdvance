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
    require_once dirname(__FILE__) . '/../db/createTripFunction.php';    
    header("Content-Type: text/json; charset=utf-8");
    
    $imagePath = "";
    $imagePaths = array();
    
    if(isset($_POST['submitCreateTrip']) && $_POST['submitCreateTrip'] == 'Create Trip')
    {
        $createTripUserId = isset($_POST['createTripUserId']) ? $_POST['createTripUserId'] : '';
        $updateTripId = isset($_POST['updateTripId']) ? $_POST['updateTripId'] : '';        
        $createTripName = isset($_POST['createTripName']) ? $_POST['createTripName'] : '';                
        if(isset($_FILES['images']))
        {            
            $allowedExts = array("jpg", "jpeg", "gif", "png", "JPG", "JPEG", "GIF", "PNG");
            //multiple file upload handling
            while(list($key,$value) = each($_FILES['images']['name']))
            {                
                $tempArray = explode(".",$value);
                $extension = end($tempArray);
                $imageType = $_FILES["images"]["type"][$key];
                 if(!empty($value) &&
                  ($imageType == "image/gif"||$imageType == "image/jpeg"||$imageType == "image/png"||$imageType == "image/jpg"||$imageType == "image/pjpeg")&& 
                  in_array($extension, $allowedExts)) // this will check if any blank field is entered
                {   
                    $currImageName = $value; 
                    $imagePath = "../../data/uploadImage/".$currImageName;  // upload directory path is set
                    $imagePaths[]= $currImageName;
                    copy($_FILES['images']['tmp_name'][$key], $imagePath); //  upload the file to the server
                    //chmod("$add",0777);  // set permission to the file.
                }
                else
                {
                    $imagePaths[] = '';
                }
            }
            $imagePath = $imagePaths[0];
        }
        $createTripImageName = $imagePath;        
        $createTripFrom = isset($_POST['createTripFrom']) ? $_POST['createTripFrom'] : '';
        $createTripTo = isset($_POST['createTripTo']) ? $_POST['createTripTo'] : '';
        $createTripStartDate = (isset($_POST['createTripStartDate']) && $_POST['createTripStartDate'] != '') ? sqlCompatibleDateFormatter($_POST['createTripStartDate']):'1901/1/1';
        $createTripEndDate = (isset($_POST['createTripEndDate']) && $_POST['createTripEndDate'] != '') ? sqlCompatibleDateFormatter($_POST['createTripEndDate']):'1901/1/1';
        if(isset($_POST['createTripEnable']) && $_POST['createTripEnable'] == 'on')
        {
            $createTripEnable = "Yes";
        }
        else
        {
            $createTripEnable = "No";
        }         
        $success = insertUpdateTrip($createTripUserId,$updateTripId,$createTripName,$createTripImageName,$createTripFrom,$createTripTo,$createTripStartDate,$createTripEndDate,$createTripEnable,$connection); 
    }    
    
    $tripArray["success"] = $success;
    print(json_encode($tripArray)); 
?>