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
    require_once dirname(__FILE__) . '/../db/manageTravellerFunction.php';
    require_once dirname(__FILE__) . '/../db/addNewTripTravellerFunction.php';

    $userId = $loggedTripUser['id'];
    $userTripArray = getAllTripUserCreated($userId,$connection);
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
        .tblDiv table td:nth-of-type(2):before { content: "Email"; }
        .tblDiv table td:nth-of-type(3):before { content: "Image"; }
        .tblDiv table td:nth-of-type(4):before { content: "Mobile"; }
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
                    <h2 class="hedr">Manage Traveller</h2>
                </div>
                <div class="box-body">
                    <table width="100%">
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label class="lbl2">Select Trip</label>
                                    <select class="form-control cntrl" name="manageTravellerTrip" id="manageTravellerTripId">
                                        <option value="">Select Trip</option>
                                        <?php
                                            foreach($userTripArray as $key)
                                            {
                                        ?>
                                                <option value="<?php echo $key['tripId'] ?>"><?php echo $key['name'] ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div id="viewTripTravellerDivId" class="box">
                <div class="box-body table-responsive">
                    <div class="tblDiv">
                        <table id="tripTravellerTableId" class="table tablesorter table-bordered table-opacity" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Image</th>
                                    <th>Mobile</th>
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
            <div id="deleteTripTravellerConfirmDialogue" style="display:none">
                <p>
                    <span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 5px 0;">
                    </span>
                    You are about to Delete Trip. Are you sure?
                </p>
                <div id="deleteTripTravellerMessageId">&nbsp;</div>
            </div>
        </div><!-- /.box -->
    </div>
</section>
<style>
.row_selected
{
    background-color: red;
}
</style>
<script type="text/javascript">
    var viewManageTripTraveller;
    var manageTravellerTripId;

    $(document).ready(function()
    {
        $("#viewTripTravellerDivId").hide();

        $('#tripTravellerTableId').livequery(function()
        {
            viewManageTripTraveller = $('#tripTravellerTableId').dataTable({
                            "autoWidth": false,
                            "scrollY": "200px",
                            "scrollCollapse": true,
                            "paging": false,
                            "bDestroy": true,
                            "bRetrieve": true,
                            "info":     false
            });
        });

        $(document).on("change", "#manageTravellerTripId", function()
        {
            manageTravellerTripId = $("#manageTravellerTripId").val();

            $.ajax(
            {
                type: 'POST',
                url: 'traveller/processors/manageTravellerAction.php',
                data: "manageTravellerTripId=" + manageTravellerTripId,
                dataType: "json",
                cache: false,
                success: function(jsonData)
                {
                    // alert(jsonData);
                    viewManageTripTraveller.fnClearTable();
                    $("#viewTripTravellerDivId").show("slow");
                    viewManageTripTraveller.fnDraw();
                    setTimeout("viewManageTripTraveller.fnAdjustColumnSizing();", "600");
                    var name = "";
                    var imageHtml = "";
                    var deleteAction = "";
                    $.each(jsonData, function(i, object)
                    {
                        name = object.firstName + " " + object.lastName;
                        if (object.imagePath !== '')
                        {
                            imageHtml = "<td align='center'><img src='data/uploadImage/"+ object.imagePath +"' style='height:70px; width:70px;' /></td>";
                        }
                        else
                        {
                            imageHtml = "<td align='center'><img src='data/uploadImage/NoImage.jpg' style='height:70px; width:70px;' /></td>";
                        }
                        deleteAction = "<td align='center'><img src='assests/img/delete.png' id='" + object.travellerId + "' class='deleteTripTravellerClass' /></td>";
                        viewManageTripTraveller.fnAddData([
                            name,
                            object.email,
                            imageHtml,
                            object.mobile,
                            deleteAction
                        ]);
                    });
                }
            });
        });

        /* ******************************************* Delete Trip Script Starts ****************************** */
        $(document).on("click", ".deleteTripTravellerClass", function() {
            deleteTripTravellerId = $(this).attr('id');
            $.fn.openDialogueWithoutTitleBar("deleteTripTravellerConfirmDialogue");
        });

        $("#deleteTripTravellerConfirmDialogue").dialog({
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
                                url: 'traveller/processors/manageTravellerAction.php',
                                data: "submitDelete=Delete&deleteTripTravellerId=" + deleteTripTravellerId,
                                dataType: "json",
                                cache: false,
                                success: function(jsonData) {
                                    if(jsonData === true)
                                    {
                                        alert("delete");
                                        $("#searchTripFormId").submit();
                                    }
                                    else
                                    {
                                        $("#deleteTripTravellerMessageId").replaceWith("<div id='deleteTripTravellerMessageId'>There are some problems in deleting data.</div>");
                                        setTimeout("$.fn.closeDialogueWithoutTitleBar('deleteTripTravellerConfirmDialogue')", 3000);
                                        setTimeout('$("#deleteTripTravellerMessageId").html("&nbsp;")', 3000);
                                    }
                                }
                            });
                    $.fn.closeDialogueWithoutTitleBar("deleteTripTravellerConfirmDialogue");
                },
                Cancel: function()
                {
                    $.fn.closeDialogueWithoutTitleBar("deleteTripTravellerConfirmDialogue");
                }
            }
        });
        /* ******************************************* Delete Trip Script Ends ********************************* */

        $(document).off("click", "#navigation").on("click", "#navigation", function()
        {
            setTimeout("viewManageTripTraveller.fnAdjustColumnSizing();", "600");
        });
    });
</script>