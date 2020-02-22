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
        .tblDiv table td:nth-of-type(1):before { content: "Select"; }
        .tblDiv table td:nth-of-type(2):before { content: "Name"; }
        .tblDiv table td:nth-of-type(3):before { content: "Email"; }
        .tblDiv table td:nth-of-type(4):before { content: "Image"; }
        .tblDiv table td:nth-of-type(5):before { content: "Mobile"; }        

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
            <div id="viewTripTravellerDivId" class="box">
                <div class="box-body table-responsive">
                    <div class="tblDiv">
                        <form name="tripTravellerForm" id="tripTravellerFormId" action="traveller/processors/tripTravellerAction.php" method="post">
                            <table id="tripTravellerTableId" class="table tablesorter table-bordered table-opacity" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Select</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Image</th>
                                        <th>Mobile</th>                                    
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
                            <button class="btn btn-primary" name="skipTraveller" id="skipTripTravellerId">Skip</button>
                            <input type="submit" class="btn btn-primary" name="submitTripTraveller" value="Add Traveller"/>
                        </form>
                    </div>
                </div><!-- /.box-body -->
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
    var viewTripTraveller;    
    $(document).ready(function()
    {    
        $("#viewTripTravellerDivId").hide();        

        $('#tripTravellerTableId').livequery(function()
        {
            viewTripTraveller = $('#tripTravellerTableId').dataTable({
                            "autoWidth": false,
                            "scrollY": "200px",
                            "scrollCollapse": true,
                            "paging": false,
                            "bDestroy": true,
                            "bRetrieve": true,
                            "info":     false                       
            });   
        });
        $.ajax(
        {
            type: 'POST',
            url: 'traveller/processors/tripTravellerAction.php',
            data: "getTravellerUser=getTravellerUser",
            dataType: "json",
            cache: false,
            success: function(jsonData) 
            {                  
                viewTripTraveller.fnClearTable();
                $("#viewTripTravellerDivId").show("slow");
                viewTripTraveller.fnDraw();
                setTimeout("viewTripTraveller.fnAdjustColumnSizing();", "600");
                var name = "";
                var imageHtml = "";
                var selectStatus = "";
                $.each(jsonData, function(i, object)
                {   
                    selectStatus = "<td align='center'><input type='checkbox' name='travellerId[]' id='"+object.userId+"' value='"+object.userId+"'></td>";
                    name = object.firstName + " " + object.lastName;
                    if (object.imagePath !== '')
                    {
                        imageHtml = "<td align='center'><img src='data/uploadImage/"+ object.imagePath +"' style='height:70px; width:70px;' /></td>";
                    }
                    else
                    {
                        imageHtml = "<td align='center'><img src='data/uploadImage/NoImage.jpg' style='height:70px; width:70px;' /></td>";
                    }
                    viewTripTraveller.fnAddData([
                        selectStatus,
                        name,
                        object.email,
                        imageHtml,                                               
                        object.mobile                        
                    ]);
                });
            }
        });
        $(document).off("click", "#navigation").on("click", "#navigation", function() 
        {                 
            setTimeout("viewTripTraveller.fnAdjustColumnSizing();", "600");
        });
        
        $('#tripTravellerFormId').livequery(function()
        {
            $("#tripTravellerFormId").ajaxForm({
                dataType: 'json',
                success: function(jsonData)
                {
                    if (jsonData === true)
                    {                    
                        var n = noty({
                            text: 'Traveller Added Succesfully !',
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
        $(document).on("click", "#skipTripTravellerId", function() 
        {
            $("#divContent").empty();
            $("#divContent").load("trip/view/createTrip.php");
        });     
    });
</script>