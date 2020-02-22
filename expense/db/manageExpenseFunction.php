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
    
    function searchExpense($userId,$searchExpenseTtrip,$searchExpenseCategory,$searchExpenseName,$connection)
    {        
        $tripNameQuery = "";
        $expenseCategoryQuery = "";
        $nameQuery = "";
        
        if($searchExpenseTtrip != NULL && $searchExpenseTtrip != '')
        {
            $tripNameQuery = " and tripId = '" . $searchExpenseTtrip . "'";
        }

        if($searchExpenseCategory != NULL && $searchExpenseCategory != '')
        {
            $expenseCategoryQuery = " and categoryId = '" . $searchExpenseCategory . "'";
        }

        if($searchExpenseName != NULL && $searchExpenseName != '')
        {
            $nameQuery = " and name = '" . $searchExpenseName . "'";
        }
    
        $defaultQuery = "select * from expense 
                        where isActive = 'Yes' and userId = '$userId' " .$tripNameQuery .  $expenseCategoryQuery . $nameQuery .
                        " order by createDate limit 10;";    
        $result = mysqli_query($connection, $defaultQuery);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC); 
        return $rows;
    }
    
    function getExpenseToUpadate($updateExpenseId,$connection)
    {
        $query = "select * from expense where expenseId = " . $updateExpenseId;
        $result = mysqli_query($connection, $query);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $rows;
    }
    
    function deleteExpense($deleteExpenseId,$connection)
    {
        $success = FALSE;

        $query = "delete from expense where expenseId = " .$deleteExpenseId;
        $result = mysqli_query($connection, $query);
        if($result == 1)
        {
            $success = TRUE;
        }
        return $success; 
    }
?>