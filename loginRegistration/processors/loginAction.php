<?php
    if(!isset($_SESSION)) 
    {
        session_start();
    }
    require_once dirname(__FILE__) . '/../../include/dbconnect.php';
    require_once dirname(__FILE__) . '/../db/loginFunction.php';
    
    if(isset($_POST['signin']) && $_POST['signin'] == 'Sign in')
    {
        $email = $_POST['loginEmail'] ;
        $password = isset($_POST['loginPassword']) ? $_POST['loginPassword'] : '';
        $password = md5($password);
        $loggedTripUser = verifyUser($email,$password,$connection);
        if($loggedTripUser != '')
        {
            $_SESSION['loggedTripUser'] = $loggedTripUser;
            header('Location: ../../master.php');
        }
        else 
        {
            $message = '<div style=" margin:0 auto; padding:5px;" align="center"><img src="assests/img/warning.png"height="20"><strong style=" margin-left:5px; color: Pink-orange;">Invalid User</strong><br></div>';
            header("Location:../../index.php?Message=".$message);
            exit();
        }
    }
    else if(isset($_SESSION['loggedTripUser']))
    {
        header("Location:../../master.php");
        exit();
    }
?>
<?php
    if (!isset($_SESSION['loggedTripUser'])) 
    {
        $message = '<div><strong>Invalid User</strong><br></div>';
        header("Location:../index.php?Message=".$message);
        exit;
    }
?>