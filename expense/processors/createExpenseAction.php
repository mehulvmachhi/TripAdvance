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
    require_once dirname(__FILE__) . '/../db/createExpenseFunction.php';    
    header("Content-Type: text/json; charset=utf-8");
    
    if(isset($_POST['createExpenseSubmit']) && $_POST['createExpenseSubmit'] == 'ADD EXPENSE')
    {        
        $createUserId = $loggedTripUser['id'];
        $updateExpensId = isset($_POST['updateExpenseId']) ? $_POST['updateExpenseId'] : '';
        $createExpenseTripId = isset($_POST['createExpenseTrip']) ? $_POST['createExpenseTrip'] : '';
        $createExpenseCategoryId = isset($_POST['createExpenseCategory']) ? $_POST['createExpenseCategory'] : '';        
        $createExpenseName = isset($_POST['createExpenseName']) ? $_POST['createExpenseName'] : '';
        $createExpenseAmount = isset($_POST['createExpenseAmount']) ? $_POST['createExpenseAmount'] : '';
        $createExpenseDate = (isset($_POST['createExpenseDate']) && $_POST['createExpenseDate'] != '') ? sqlCompatibleDateFormatter($_POST['createExpenseDate']) : '1901/1/1';
        
        $success = insertUpdateTripExpense($updateExpensId,$createUserId,$createExpenseTripId,$createExpenseCategoryId,$createExpenseName,$createExpenseAmount,$createExpenseDate,$connection);                
    }    
    
    $expenseArray["success"] = $success;
    print(json_encode($expenseArray));
        
?>