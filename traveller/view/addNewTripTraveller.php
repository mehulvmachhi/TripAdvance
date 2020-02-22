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
    require_once dirname(__FILE__) . '/../db/addNewTripTravellerFunction.php';

    $userId = $loggedTripUser['id'];
    $userTripArray = getAllTripUserCreated($userId,$connection);
?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h2 class="hedr">Add Trip Traveller</h2>
                </div>
                <div class="box-body">
                    <table width="100%">
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label class="lbl2">Select Trip</label>
                                    <select class="form-control cntrl" name="userTrip" id="userTripId">
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
            <div id="viewAddNewTripTravellerDivId" class="box">
                <div class="box-body table-responsive">
                    <div class="tblDiv">
                        <form name="addNewTripTravellerForm" id="addNewTripTravellerFormId" action="#" method="post">
                            <table id="addNewTripTravellerTableId" class="table tablesorter table-bordered table-opacity" cellspacing="0" width="100%">
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
                                   <!-- <tr style="background-color: red ;">
                                        <td align="center">test</td>
                                        <td align="center">sajid</td>
                                        <td align="center">234525</td>
                                        <td align="center">anand</td>
                                        <td align="center"><img src="../lib/img/delete.png" width="20" height="20"></td>
                                        <td align="center"><img src="../lib/img/delete.png" width="20" height="20"></td>
                                    </tr> -->
                                </tbody>
                            </table>
                            <input type="submit" class="btn btn-primary" name="submitAddTraveller" value="Add Traveller"/>
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
    var viewAddNewTripTraveller;
    var userTripId;

    $(document).ready(function()
    {
        $("#viewAddNewTripTravellerDivId").hide();

        $('#addNewTripTravellerTableId').livequery(function()
        {
            viewAddNewTripTraveller = $('#addNewTripTravellerTableId').dataTable({
                            "autoWidth": false,
                            "scrollY": "200px",
                            "scrollCollapse": true,
                            "paging": false,
                            "bDestroy": true,
                            "bRetrieve": true,
                            "info":     false
            });
        });

        $(document).on("change", "#addTravellerTripId", function()
        {
            userTripId = $("#userTripId").val();

            $.ajax(
            {
                type: 'POST',
                url: 'traveller/processors/addNewTripTravellerAction.php',
                data: "submitUserTripId=" + userTripId,
                dataType: "json",
                cache: false,
                success: function(jsonData)
                {
    //                alert(jsonData);
                    viewAddNewTripTraveller.fnClearTable();
                    $("#viewAddNewTripTravellerDivId").show("slow");
                    viewAddNewTripTraveller.fnDraw();
                    setTimeout("viewAddNewTripTraveller.fnAdjustColumnSizing();", "600");
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

                        viewAddNewTripTraveller.fnAddData([
                            selectStatus,
                            name,
                            object.email,
                            imageHtml,
                            object.mobile
                        ]);
                    });
                }
            });
        });
    });
</script>
