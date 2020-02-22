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
    require_once dirname(__FILE__) . '/../db/manageExpenseFunction.php';    
    header("Content-Type: text/json; charset=utf-8");
    
    if(isset($_POST['searchExpense']) && $_POST['searchExpense'] == 'Search')
    {
        $userId = $loggedTripUser['id'];
        $searchExpenseTtrip = isset($_POST['searchExpenseTtrip']) ? $_POST['searchExpenseTtrip'] : '';
        $searchExpenseCategory = isset($_POST['searchExpenseCategory']) ? $_POST['searchExpenseCategory'] : '';
        $searchExpenseName = isset($_POST['searchExpenseName']) ? $_POST['searchExpenseName'] : '';
        
        $success = searchExpense($userId,$searchExpenseTtrip,$searchExpenseCategory,$searchExpenseName,$connection);
    }
    elseif(isset($_POST['submitDelete']) && $_POST['submitDelete'] == 'Delete')
    {
        $deleteExpenseId = isset($_POST['deleteExpenseId']) ? $_POST['deleteExpenseId'] : "";        
        $success = deleteExpense($deleteExpenseId,$connection); 
    }
    
    $searchExpenseArray = $success;
    print(json_encode($searchExpenseArray));
        
?>