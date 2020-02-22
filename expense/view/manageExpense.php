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
    header("Content-Type: text/json; charset=utf-8");
    
    $userId = $loggedTripUser['id'];
    $tripUserTravellingArray = getAllTripUserTravelling($userId,$connection);
    $expenseCategoryArray = getAllExpenseCategory($connection);   
    
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

        .tblDiv table td:nth-of-type(1):before { content: "Name"; }
        .tblDiv table td:nth-of-type(2):before { content: "Amount"; }
        .tblDiv table td:nth-of-type(3):before { content: "Date"; }        
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
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h2 class="hedr">Search Expense</h2>
                </div>
                <div class="box-body">
                    <form name="searchExpenseForm" id="searchExpenseFormId" action="expense/processors/manageExpenseAction.php" method="post" role="form">                        
                        <table width="100%">   
                            <tr>                                             
                                <td> 
                                    <div class="form-group">                                        
                                        <label class="lbl2">Select Trip</label>                                        
                                        <select class="form-control cntrl" name="searchExpenseTtrip" id="searchExpenseTtripId">
                                            <option value="">Select Trip</option>
                                            <?php
                                                foreach($tripUserTravellingArray as $key)
                                                {                                                                                                    
                                            ?>
                                                    <option value="<?php echo $key['tripId'] ?>"><?php echo $key['name'] ?></option>
                                            <?php
                                                }
                                            ?>                                            
                                        </select>
                                    </div>
                                </td>
                                <td> 
                                    <div class="form-group">                                        
                                        <label class="lbl2">Select Category</label>                                        
                                        <select class="form-control cntrl" name="searchExpenseCategory" id="searchExpenseCategoryId">
                                            <option value="">Select Category</option>
                                            <?php
                                                foreach($expenseCategoryArray as $key)
                                                {
                                            ?>
                                                    <option value="<?php echo $key['expenseCategoryId'] ?>"><?php echo $key['name'] ?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </td>
                                <td> 
                                    <div class="form-group">
                                        <label class="lbl2">Expense Name</label>
                                        <input type="text" name="searchExpenseName" id="searchExpenseNameId" class="form-control" placeholder="Expense Name" maxlength='100'>
                                    </div>
                                </td>
                            </tr>                            
                        </table>
                        <div class="box-footer" align="center">   
                            <input type="submit" name="searchExpense" id="searchExpenseId" value="Search" class="btn btn-primary" />
                        </div>
                    </form>
                </div>
            </div>
            <div id="viewSearchExpenseDivId" class="box">
                <div class="box-body table-responsive">
                    <div class="tblDiv">
                        <table id="searchExpenseTableId" class="table tablesorter table-bordered table-opacity" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Date</th>                                    
                                    <th>Action</th>
                                    <th>Delete</th>                                    
                                </tr>
                            </thead>
                            <tbody>
    <!--                            <tr style="background-color: red ;">
                                    <td align="center">test</td>
                                    <td align="center">sajid</td>
                                    <td align="center">234525</td>
                                    <td align="center">anand</td>                                
                                    <td align="center"><img src="../lib/img/delete.png" width="20" height="20"></td>
                                    <td align="center"><img src="../lib/img/delete.png" width="20" height="20"></td>
                                </tr>                                                      -->
                            </tbody>
                        </table>
                    </div>
                </div><!-- /.box-body -->
            </div>            
            <div id="deleteExpenseConfirmDialogue" style="display:none">
                <p>
                    <span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 5px 0;">
                    </span>
                    You are about to Delete Expense. Are you sure?
                </p>
                <div id="deleteExpenseMessageId">&nbsp;</div>
            </div>
        </div><!-- /.box -->
    </div>
</section>
<style>
.row_selected {
    background-color: red;
}
</style>
<script type="text/javascript">
    var viewSearchExpense;
    $(document).ready(function()
    {    
        $("#viewSearchExpenseDivId").hide();

        $('#searchExpenseTableId').livequery(function()
        {
            viewSearchExpense = $('#searchExpenseTableId').dataTable({
                            "autoWidth": false,
                            "scrollY": "200px",
                            "scrollCollapse": true,
                            "paging": false,
                            "bDestroy": true,
                            "bRetrieve": true,
                            "info":     false                       
            });   
        });

        $('#searchExpenseFormId').livequery(function()
        {
            $("#searchExpenseFormId").ajaxForm({
                dataType: 'json',
                success: function(jsonData)
                {                
//                    alert(jsonData);
                    viewSearchExpense.fnClearTable();
                    $("#viewSearchExpenseDivId").show("slow");
                    viewSearchExpense.fnDraw();
                    setTimeout("viewSearchExpense.fnAdjustColumnSizing();", "600");
                    var actionHtml = "";
                    var deleteAction = "";
                    $.each(jsonData, function(i, object)
                    {                
                        actionHtml = "<td align='center'><img src='assests/img/edit.png' id='" + object.expenseId + "' class='updateExpenseClass' />&nbsp;&nbsp;</td>";
                        deleteAction = "<td align='center'><img src='assests/img/delete.png' id='" + object.expenseId + "' class='deleteExpenseClass' /></td>";                        
                        viewSearchExpense.fnAddData([                            
                            object.name,                       
                            object.amount,
                            $.fn.formatedDATE(object.date),                                               
                            actionHtml,
                            deleteAction
                        ]);
                    });
                }
            });
        });
        
        $(document).off("click", "#navigation").on("click", "#navigation", function() 
        {                 
            setTimeout("viewSearchExpense.fnAdjustColumnSizing();", "600");
        });
        
        $(document).on("click", ".updateExpenseClass", function() {
            var updateExpenseId = $(this).attr('id');
            var queryParam = "";
            if (updateExpenseId !== undefined)
                queryParam = "?updateExpenseId=" + updateExpenseId;
            $("#divContent").empty();
            $("#divContent").load("expense/view/createExpense.php" + queryParam);
        });
        
        /* ******************************************* Disable Expense Script Starts ***************************** */
        $(document).on("click", ".deleteExpenseClass", function() 
        {
            deleteExpenseId = $(this).attr('id');
            $.fn.openDialogueWithoutTitleBar("deleteExpenseConfirmDialogue");
        });

        $("#deleteExpenseConfirmDialogue").dialog({
            autoOpen: false,
            resizable: false,
            height: 140,
            modal: true,
            buttons:
            {
                "Delete": function()
                {
                    $.ajax(
                            {
                                type: 'POST',
                                url: 'expense/processors/manageExpenseAction.php',
                                data: "submitDelete=Delete&deleteExpenseId=" + deleteExpenseId,
                                dataType: "json",
                                cache: false,
                                success: function(jsonData) 
                                {
                                    if (jsonData === true)
                                    {
                                        $("#searchExpenseFormId").submit();
                                    }
                                    else
                                    {
                                        $("#deleteExpenseMessageId").replaceWith("<div id='deleteExpenseMessageId'>There are some problems in deleting data.</div>");
                                        setTimeout("$.fn.closeDialogueWithoutTitleBar('deleteExpenseConfirmDialogue')", 3000);
                                        setTimeout('$("#deleteExpenseMessageId").html("&nbsp;")', 3000);
                                    }
                                }
                            });
                    $.fn.closeDialogueWithoutTitleBar("deleteExpenseConfirmDialogue");
                },
                Cancel: function()
                {
                    $.fn.closeDialogueWithoutTitleBar("deleteExpenseConfirmDialogue");
                }
            }
        });
        /* ******************************************* Disable Expense Script Ends ******************************* */                
    });
</script>