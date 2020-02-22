<?php    
    if(!isset($_SESSION))
    {
        session_start();
    }
    $loggedTripUser = isset($_SESSION['loggedTripUser']) ? $_SESSION['loggedTripUser'] : array();
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
    require_once dirname(__FILE__) . '/../db/createTripFunction.php';
    
    $updateTripEnable = 'checked = true';
    $updateTripImageName = 'NoImage.jpg';
    $updateTripId = 0;
    $updateTripArray = '';
    
    if(isset($_GET['updateTripId']))
    {
        $updateTripId = $_GET['updateTripId'];
        
        $updateTripArray = getTripToUpdate($updateTripId,$connection);
         
        $updateTripisActive = isset($updateTripArray[0]['isActive']) ? $updateTripArray[0]['isActive'] : "";
        if($updateTripisActive == 'Yes')
        {
            $updateTripEnable = 'checked = true';            
        }
        else 
        {
            $updateTripEnable = '';
        }
        
        $updateTripImageName = isset($updateTripArray[0]['imagePath']) ? $updateTripArray[0]['imagePath'] : "";
        if($updateTripImageName != '')
        {
            $updateTripImageName = isset($updateTripArray[0]['imagePath']) ? $updateTripArray[0]['imagePath'] : "";
        }
        else 
        {
            $updateTripImageName = 'NoImage.jpg';
        }                                       
    } 
    
    $updateTripName = isset($updateTripArray[0]['name']) ? $updateTripArray[0]['name'] : "";
    $updateTripFrom = isset($updateTripArray[0]['tripFrom']) ? $updateTripArray[0]['tripFrom'] : "";
    $updateTripTo = isset($updateTripArray[0]['tripTo']) ? $updateTripArray[0]['tripTo'] : "";
    $updateTripStartDate = isset($updateTripArray[0]['startDate']) ? userCompatibleDateFormatter($updateTripArray[0]['startDate']) : "";
    $updateTripEndDate = isset($updateTripArray[0]['endDate']) ? userCompatibleDateFormatter($updateTripArray[0]['endDate']) : "";
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
                    <h2 class="hedr">Create Trip</h2>
                </div>
                <div class="box-body">
                    <form name="createTripForm" id="createTripFormId" enctype="multipart/form-data" action="trip/processors/createTripAction.php" method="post" role="form">                        
                        <input type="hidden" name="createTripUserId" id="createTripUserId" value="<?php echo $loggedTripUser['id']; ?>" />
                        <input type="hidden" name="updateTripId" id="updateTripId" value="<?php echo $updateTripId; ?>" />
                        <fieldset>
                            <table width="100%">                                                                 
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="lbl">Name</label>
                                            <input type="text" class="form-control" name="createTripName" id="createTripNameId" placeholder="Trip Name" maxlength="30" value="<?php echo $updateTripName; ?>">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label class="lbl">Image</label>
                                            <image id="update_trip_image" src="data/uploadImage/<?php echo $updateTripImageName; ?>" width="140" height="140" style="float:left;"/><br>
                                            <input type="file" name="images[]" id="createTripImageId">
                                        </div>
                                    </td>
                                </tr>
                                <tr>                                                
                                    <td>
                                        <div class="form-group">
                                            <label class="lbl">Trip From</label>
                                            <input type="text" class="form-control" name="createTripFrom" id="createTripFromId" placeholder="Trip From" maxlength="40" value="<?php echo $updateTripFrom; ?>">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label class="lbl">Trip To</label>
                                            <input type="text" class="form-control" name="createTripTo" id="createTripToId" placeholder="Trip To" maxlength="40" value="<?php echo $updateTripTo; ?>">
                                        </div>
                                    </td>                                                
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="lbl">Start Date</label>
                                            <input type="text" class="form-control" name="createTripStartDate" id="createTripStartDateId" placeholder="Start Date" value="<?php echo $updateTripStartDate; ?>">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label class="lbl">End Date</label>
                                            <input type="text" class="form-control" name="createTripEndDate" id="createTripEndDateId" placeholder="End Date" value="<?php echo $updateTripEndDate; ?>">
                                        </div>
                                    </td>                                    
                                </tr>                                                                                                                              
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="lbl">Enable - Disable</label>
                                            <input type="checkbox" name="createTripEnable" id="createTripEnableId" <?php echo $updateTripEnable; ?>/>
                                        </div>										
                                    </td>
                                </tr>
                            </table>
                            <div class="box-footer" align="center">
                                <input type="submit" class="btn btn-primary" name="submitCreateTrip" id="submitCreateTripId" value="Create Trip"/>
                            </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</section>
<script type="text/javascript" src="trip/js/createTripValidation.js"></script>
<script type="text/javascript">
$(document).ready(function()
{      
    $("#createTripStartDateId").datepicker({dateFormat: 'dd/mm/yy',  changeMonth: true, changeYear: true, showAnim: "clip", inline: true});
    $("#createTripEndDateId").datepicker({dateFormat: 'dd/mm/yy',  changeMonth: true, changeYear: true, showAnim: "clip", inline: true});
    
    $('#createTripFormId').livequery(function()
    {
        $("#createTripFormId").ajaxForm({
            dataType: 'json',
            success: function(jsonData)
            {
                if (jsonData.success === true)
                {                    
                    var n = noty({
                        text: 'Trip Created Succesfully !',
                        type: 'success',
                        timeout: 2000,
                        layout: 'bottomRight',
                        theme: 'defaultTheme'
                    });
                    $("#divContent").empty();
                    $("#divContent").load("traveller/view/tripTraveller.php");
                }
                else if(jsonData.success === 'UPDATE')
                {
                    var n = noty({
                        text: 'Trip Updated Succesfully !',
                        type: 'success',
                        timeout: 2000,
                        layout: 'bottomRight',
                        theme: 'defaultTheme'
                    });
                    $("#divContent").empty();
                    $("#divContent").load("trip/view/createTrip.php");
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