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
    require_once dirname(__FILE__) . '/../db/manageExpenseFunction.php';
    
    $userId = $loggedTripUser['id'];   
    $updateExpenseId = 0;
    $updateExpenseArray = '';
    
    $tripUserTravellingArray = getAllTripUserTravelling($userId,$connection);
    $expenseCategoryArray = getAllExpenseCategory($connection);
            
    if(isset($_GET['updateExpenseId']))
    {
        $updateExpenseId = $_GET['updateExpenseId'];        
        $updateExpenseArray = getExpenseToUpadate($updateExpenseId,$connection); 
    }
        
    $updateExpenseTripId = isset($updateExpenseArray[0]['tripId']) ? $updateExpenseArray[0]['tripId'] : "";    
    $updateExpenseCategoryId = isset($updateExpenseArray[0]['categoryId']) ? $updateExpenseArray[0]['categoryId'] : "";
    $updateExpenseName = isset($updateExpenseArray[0]['name']) ? $updateExpenseArray[0]['name'] : "";
    $updateExpenseAmount = isset($updateExpenseArray[0]['amount']) ? $updateExpenseArray[0]['amount'] : "";
    $updateExpenseDate = isset($updateExpenseArray[0]['date']) ? userCompatibleDateFormatter($updateExpenseArray[0]['date']) : "";                
?>
<style>
  /* 
Max width before this PARTICULAR table gets nasty
This query will take effect for any screen smaller than 760px
and also iPads specifically.
    */
    @media 
    only screen and (max-width: 760px),
    (min-device-width: 768px) and (max-device-width: 1024px)  {

        /* Force table to not be like tables anymore */
        .tblDiv table, thead, tbody, th, td, tr { 
            display: block; 
        }

        /* Hide table headers (but not display: none;, for accessibility) */
        .tblDiv table thead tr { 
            position: absolute;
            top: -9999px;
            left: -9999px;
        }

        .tblDiv table tr { border: 1px solid #ccc; }

        .tblDiv table td { 
            /* Behave  like a "row" */
            border: none;
            border-bottom: 1px solid #eee; 
            position: relative;
            padding-left: 50%; 
        }

        .tblDiv table td:before { 
            /* Now like a table header */
            
            /* Top/left values mimic padding */
            top: 6px;
            left: 6px;
            width: 45%; 
            padding-right: 10px; 
            white-space: nowrap;
        }

        /*
        Label the data
        */
        
        .tblDiv table td:nth-of-type(1):before { content: "Company"; }
        .tblDiv table td:nth-of-type(2):before { content: "Code"; }
        .tblDiv table td:nth-of-type(3):before { content: "Period"; }
        .tblDiv table td:nth-of-type(4):before { content: "Action"; }
        .tblDiv table td:nth-of-type(5):before { content: "Delete"; }

    }
    /* Smartphones (portrait and landscape) ----------- */
    @media only screen
    and (min-device-width : 320px)
    and (max-device-width : 480px) {
        body { 
            padding: 0; 
            margin: 0; 
            width: 360px; }
    }
    /* iPads (portrait and landscape) ----------- */
    @media only screen and (min-device-width: 768px) and (max-device-width: 1024px) {
        body { 
            width: 100%; 
        }
    }

</style>
<style>
    .box .box-header {
        border-bottom: 0 solid #f4f4f4;
        border-radius: 5px 5px 0 0;
        color: #444;
        position: relative;
    }
    .box {
        background: none repeat scroll 0 0 #ffffff;
        border-radius: 5px;
        border-top: 2px solid #c1c1c1;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        position: relative;
        width: 100%;
    }

    .box .box-body {
        border-radius: 0 0 3px 3px;
        padding: 0px;
    }
</style>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h2 class="hedr">Add Expense</h2>
                </div>
                <div class="box-body">
                    <form name="createExpenseForm" id="createExpenseFormId" action="expense/processors/createExpenseAction.php" method="post">
                        <input type="hidden" name="updateExpenseId" id="updateExpenseId" value="<?php echo $updateExpenseId; ?>">
                        <fieldset>
                            <table width="100%">
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="lbl">Select Trip</label>
                                            <select class="form-control cntrl" name="createExpenseTrip" id="createExpenseTripId">
                                                <option value="">Select Trip</option>
                                                <?php
                                                    $selected = "";
                                                    for($i = 0; $i < count($tripUserTravellingArray); $i++)
                                                    {
                                                        $tripUserTravellingSubArray = $tripUserTravellingArray[$i];
                                                        if(isset($updateExpenseArray)) 
                                                        {
                                                            if($tripUserTravellingSubArray['tripId'] == $updateExpenseArray[0]['tripId'])
                                                            {
                                                                $selected = "selected";
                                                            }
                                                            else
                                                            {
                                                                $selected = "";                                                            
                                                            }
                                                        }
                                                ?>
                                                        <option value="<?php echo $tripUserTravellingSubArray['tripId'] ?>" <?php echo $selected; ?> ><?php echo $tripUserTravellingSubArray['name'] ?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>										
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label class="lbl">Select Category</label>
                                            <select class="form-control cntrl" name="createExpenseCategory" id="createExpenseCategoryId">
                                                <option value="">Select Category</option>
                                                <?php
                                                    $selected = "";
                                                    for($i = 0; $i < count($expenseCategoryArray); $i++)
                                                    {
                                                        $expenseCategorySubArray = $expenseCategoryArray[$i];
                                                        if(isset($updateExpenseArray)) 
                                                        {
                                                            if($expenseCategorySubArray['expenseCategoryId'] == $updateExpenseArray[0]['categoryId'])
                                                            {
                                                                $selected = "selected";
                                                            }
                                                            else
                                                            {
                                                                $selected = "";                                                            
                                                            }
                                                        }
                                                ?>
                                                        <option value="<?php echo $expenseCategorySubArray['expenseCategoryId'] ?>" <?php echo $selected; ?> ><?php echo $expenseCategorySubArray['name'] ?></option>
                                                <?php
                                                    }
                                                ?>
                                                
                                            </select>
                                        </div>										
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="lbl">Expense Name</label>
                                            <input type="text" name="createExpenseName" id="createExpenseNameId" class="form-control" value="<?php echo $updateExpenseName; ?>" placeholder="Expense Name" maxlength="50">
                                        </div>										
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label class="lbl">Amount</label>
                                            <input type="text" name="createExpenseAmount" id="createExpenseAmountId" class="form-control" value="<?php echo $updateExpenseAmount; ?>" placeholder="Amount" maxlength="200">
                                        </div>										
                                    </td>                                    
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="lbl">Date</label>
                                            <input type="text" name="createExpenseDate" id="createExpenseDateId" class="form-control" value="<?php echo $updateExpenseDate; ?>" placeholder="Expense Date">
                                        </div>									
                                    </td>                                    
                                </tr>
                            </table>
                            <div class="box-footer" align="center">
                                <input type="submit" name="createExpenseSubmit" id="createExpenseSubmitId" class="btn btn-primary" value="ADD EXPENSE" />
                            </div>
                        </fieldset>
                    </form>                       
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript" src="expense/js/createExpenseValidation.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
    $("#createExpenseDateId").datepicker({dateFormat: 'dd/mm/yy',  changeMonth: true, changeYear: true, showAnim: "clip"});
    
    $('#createExpenseFormId').livequery(function()
    {
        $("#createExpenseFormId").ajaxForm({
            dataType: 'json',
            success: function(jsonData)
            {
                if (jsonData.success === true)
                {                    
                    var n = noty({
                        text: 'Expense Added Succesfully !',
                        type: 'success',
                        timeout: 2000,
                        layout: 'bottomRight',
                        theme: 'defaultTheme'
                    });
                    $("#divContent").empty();
                    $("#divContent").load("expense/view/createExpense.php");
                }
                else
                {
                    alert("There are some problem");
                }
            }
        });
    });
});
</script>