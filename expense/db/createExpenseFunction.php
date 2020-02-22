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
    
    function insertUpdateTripExpense($updateExpensId,$createUserId,$createExpenseTripId,$createExpenseCategoryId,$createExpenseName,$createExpenseAmount,$createExpenseDate,$connection)
    {
        $success = FALSE;
        if($updateExpensId == 0)
        {
            $query = "insert into expense(userId,tripId,categoryId,name,amount,date,createDate)
                        values('$createUserId',
                                '$createExpenseTripId',
                                '$createExpenseCategoryId',
                                '$createExpenseName',
                                '$createExpenseAmount',
                                '$createExpenseDate',                            
                                CURDATE())";
        }
        else
        {
            $query = "update expense
                      SET tripid = '". $createExpenseTripId . "', 
                      categoryId = '". $createExpenseCategoryId . "',
                      name = '". $createExpenseName . "',
                      amount = '". $createExpenseAmount . "',
                      date = '". $createExpenseDate . "',
                      createDate = CURDATE()
                      where expenseId = " . $updateExpensId;            
        }
        $result = mysqli_query($connection, $query);
        if($result == 1)
        {
            $success = TRUE;
        }
        return $success;
    }
    
    function getAllTripUserTravelling($userId,$connection)
    {
        $query = "select trip.tripId, trip.name from trip inner join traveller on traveller.tripId = trip.tripId where traveller.userId = " . $userId;
        $result = mysqli_query($connection, $query);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $rows;
    }
    
    function getAllExpenseCategory($connection)
    {
        $query = "select * from expense_category";
        $result = mysqli_query($connection, $query);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $rows;
    }
 
?>
