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
        .tblDiv table td:nth-of-type(2):before { content: "Image"; }
        .tblDiv table td:nth-of-type(3):before { content: "From"; }
        .tblDiv table td:nth-of-type(4):before { content: "To"; }
        .tblDiv table td:nth-of-type(5):before { content: "Start Date"; }
        .tblDiv table td:nth-of-type(6):before { content: "End Date"; }
        .tblDiv table td:nth-of-type(7):before { content: "Action"; }
        .tblDiv table td:nth-of-type(8):before { content: "Delete"; }
        .tblDiv table td:nth-of-type(9):before { content: "Enable"; }

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
                    <h2 class="hedr">Search Trip</h2>
                </div>
                <div class="box-body">
                    <form name="searchTripForm" id="searchTripFormId" action="trip/processors/manageTripAction.php" method="post" role="form">                        
                        <table width="100%">   
                            <input type="hidden" name="searchTripUserId" id="searchTripUserId" value="<?php echo $loggedTripUser['id']; ?>"
                            <tr>                                             
                                <td> 
                                    <div class="form-group">                                        
                                        <label class="lbl2">Trip Name</label>                                        
                                        <input type="text" name="searchTripName" id="searchTripNameId" class="form-control" placeholder="Trip Name" maxlength='15'>
                                    </div>
                                </td>
                                <td> 
                                    <div class="form-group">
                                        <label class="lbl2">Trip From</label>
                                        <input type="text" name="searchTripFrom" id="searchTripFromId" class="form-control" placeholder="Trip From" maxlength='100'>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td> 
                                    <div class="form-group">
                                        <label class="lbl2">Between From Date</label>
                                        <input type="text" name="searchTripBetweenFromDate" id="searchTripBetweenFromDateId" class="form-control" maxlength='12' placeholder="Between From This Date">
                                    </div>
                                </td>   
                                <td>
                                    <label class="lbl2">To Date</label>
                                    <input type="text" name="searchTripBetweenToDate" id="searchTripBetweenToDateId" class="form-control" maxlength='12' placeholder="To This Date">
                                </td>
                            </tr>
                        </table>
                        <div class="box-footer" align="center">   
                            <input type="submit" name="searchTrip" id="searchTripId" value="Search" class="btn btn-primary" />
                        </div>
                    </form>
                </div>
            </div>
            <div id="viewSearchTripDivId" class="box">
                <div class="box-body table-responsive">
                    <div class="tblDiv">
                        <table id="searchTripTableId" class="table tablesorter table-bordered table-opacity" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Action</th>
                                    <th>Delete</th>
                                    <th>Enable</th>
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
            <div id="disableTripConfirmDialogue" style="display:none">
                <p>
                    <span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 5px 0;">
                    </span>
                    You are about to Disable Trip. Are you sure?
                </p>
                <div id="disableTripMessageId">&nbsp;</div>
            </div>
            <div id="deleteTripConfirmDialogue" style="display:none">
                <p>
                    <span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 5px 0;">
                    </span>
                    You are about to Delete Trip. Are you sure?
                </p>
                <div id="deleteTripMessageId">&nbsp;</div>
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
    var viewSearchTrip;
    $(document).ready(function()
    {    
        $("#viewSearchTripDivId").hide();
        $("#searchTripBetweenFromDateId").datepicker({dateFormat: 'dd/mm/yy', changeMonth: true, changeYear: true, showAnim: "clip", inline: true});
        $("#searchTripBetweenToDateId").datepicker({dateFormat: 'dd/mm/yy', changeMonth: true, changeYear: true, showAnim: "clip", inline: true});

        $('#searchTripTableId').livequery(function()
        {
            viewSearchTrip = $('#searchTripTableId').dataTable({
                            "autoWidth": false,
                            "scrollY": "200px",
                            "scrollCollapse": true,
                            "paging": false,
                            "bDestroy": true,
                            "bRetrieve": true,
                            "info":     false                       
            });   
        });

        $('#searchTripFormId').livequery(function()
        {
            $("#searchTripFormId").ajaxForm({
                dataType: 'json',
                success: function(jsonData)
                {                
//                    alert(jsonData);
                    viewSearchTrip.fnClearTable();
                    $("#viewSearchTripDivId").show("slow");
                    viewSearchTrip.fnDraw();
                    setTimeout("viewSearchTrip.fnAdjustColumnSizing();", "600");
                    var actionHtml = "";
                    var deleteAction = "";
                    var activeStatusImg = "";
                    var imageHtml = "";
                    $.each(jsonData, function(i, object)
                    {   
                        if (object.isActive === 'Yes')
                        {
                            activeStatusImg = "<img src='assests/img/enable.png' id='" + object.tripId + "' class='disableTripClass' />";
                        }
                        else
                        {
                            activeStatusImg = "<img src='assests/img/disableafter.png' />";
                        }
                        actionHtml = "<td align='center'><img src='assests/img/edit.png' id='" + object.tripId + "' class='updateTripClass' />&nbsp;&nbsp;</td>";
                        deleteAction = "<td align='center'><img src='assests/img/delete.png' id='" + object.tripId + "' class='deleteTripClass' /></td>";
                        if (object.imagePath !== '')
                        {
                            imageHtml = "<td align='center'><img src='data/uploadImage/"+ object.imagePath +"' style='height:70px; width:70px;' /></td>";
                        }
                        else
                        {
                            imageHtml = "<td align='center'><img src='data/uploadImage/NoImage.jpg' style='height:70px; width:70px;' /></td>";
                        }

                        viewSearchTrip.fnAddData([
                            object.name,
                            imageHtml,                       
                            object.tripFrom,
                            object.tripTo,
                            $.fn.formatedDATE(object.startDate),
                            $.fn.formatedDATE(object.endDate),                                               
                            actionHtml,
                            deleteAction,
                            activeStatusImg
                        ]);
                    });
                }
            });
        });
        
        $(document).off("click", "#navigation").on("click", "#navigation", function() 
        {                 
            setTimeout("viewSearchTrip.fnAdjustColumnSizing();", "600");
        });

        $(document).on("click", ".updateTripClass", function() 
        {
            var updateTripId = $(this).attr('id');
            var queryParam = "";
            if (updateTripId !== undefined)
                queryParam = "?updateTripId=" + updateTripId;
            $("#divContent").empty();
            $("#divContent").load("trip/view/createTrip.php" + queryParam);
        });

        /* ******************************************* Disable Trip Script Starts ***************************** */
        $(document).on("click", ".disableTripClass", function() 
        {
            disalbeTripId = $(this).attr('id');
            $.fn.openDialogueWithoutTitleBar("disableTripConfirmDialogue");
        });

        $("#disableTripConfirmDialogue").dialog({
            autoOpen: false,
            resizable: false,
            height: 140,
            modal: true,
            buttons:
            {
                "Disable": function()
                {
                    $.ajax({
                                type: 'POST',
                                url: 'trip/processors/manageTripAction.php',
                                data: "submitDisable=Disable&disalbeTripId=" + disalbeTripId,
                                dataType: "json",
                                cache: false,
                                success: function(jsonData) {
                                    if(jsonData === true)
                                    {
                                        $("#searchTripFormId").submit();
                                    }
                                    else
                                    {
                                        $("#disableTripMessageId").replaceWith("<div id='disableTripMessageId'>There are some problems in deleting data.</div>");
                                        setTimeout("$.fn.closeDialogueWithoutTitleBar('disableTripConfirmDialogue')", 3000);
                                        setTimeout('$("#disableTripMessageId").html("&nbsp;")', 3000);
                                    }
                                }
                            });
                    $.fn.closeDialogueWithoutTitleBar("disableTripConfirmDialogue");
                },
                Cancel: function()
                {
                    $.fn.closeDialogueWithoutTitleBar("disableTripConfirmDialogue");
                }
            }
        });
        /* ******************************************* Disable Trip Script Ends ******************************* */

        /* ******************************************* Delete Trip Script Starts ****************************** */
        $(document).on("click", ".deleteTripClass", function() {
            deleteTripId = $(this).attr('id');
            $.fn.openDialogueWithoutTitleBar("deleteTripConfirmDialogue");
        });

        $("#deleteTripConfirmDialogue").dialog({
            autoOpen: false,
            resizable: false,
            height: 140,
            modal: true,
            buttons:
            {
                "Delete": function()
                {
                    $.ajax({
                                type: 'POST',
                                url: 'trip/processors/manageTripAction.php',
                                data: "submitDelete=Delete&deleteTripId=" + deleteTripId,
                                dataType: "json",
                                cache: false,
                                success: function(jsonData) {
                                    if (jsonData === true)
                                    {
                                        $("#searchTripFormId").submit();
                                    }
                                    else
                                    {
                                        $("#deleteTripMessageId").replaceWith("<div id='deleteTripMessageId'>There are some problems in deleting data.</div>");
                                        setTimeout("$.fn.closeDialogueWithoutTitleBar('deleteTripConfirmDialogue')", 3000);
                                        setTimeout('$("#deleteTripMessageId").html("&nbsp;")', 3000);
                                    }
                                }
                            });
                    $.fn.closeDialogueWithoutTitleBar("deleteTripConfirmDialogue");
                },
                Cancel: function()
                {
                    $.fn.closeDialogueWithoutTitleBar("deleteTripConfirmDialogue");
                }
            }
        });
        /* ******************************************* Delete Trip Script Ends ********************************* */
    });
</script>
