<?php

require_once dirname(__FILE__) . '/../../include/dbconnect.php';
require_once dirname(__FILE__) . '/../db/registrationFunction.php';

if(isset($_POST['registrationSubmit']) && $_POST['registrationSubmit'] == 'Join in')
{
    $firstName = isset($_POST['registrationFirstName']) ? $_POST['registrationFirstName'] : '';
    $lastName = isset($_POST['registrationLastName']) ? $_POST['registrationLastName'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $email = isset($_POST['registrationEmail']) ? $_POST['registrationEmail'] : '';
    $password = isset($_POST['registrationPassword']) ?$_POST['registrationPassword'] : '';
    $password = md5($password);
    $image = "NoImage.jpg";
    $mobile = isset($_POST['registrationMobile']) ? $_POST['registrationMobile'] : '';    
    
    $success = registerUser($firstName,$lastName,$gender,$email,$password,$image,$mobile,$connection);
    if($success == true)
    {
        header('Location: ../../successRegistration.php');
    }
    else
    {
        $message = '<div><strong>Something went Wrong</strong><br></div>';
        header("Location:../../index.php?Message=".$message);
        exit;
    }
}
?>