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
        header("Location:index.php");
        exit;
    }    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>TRIP | Timeline</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link type="text/css" rel="stylesheet" href="assets/css/jquery-ui-1.10.3.custom.css"/>
        <link type="text/css" rel="stylesheet" href="assets/css/bootstrap.min.css"/>
        <link type="text/css" rel="stylesheet" href="assets/css/font-awesome.min.css"/>
        <link type="text/css" rel="stylesheet" href="assets/css/ionicons.min.css"/>        
        <link type="text/css" rel="stylesheet" href="assets/css/AdminLTE.css"/>
        <link type="text/css" rel="stylesheet" href="assets/css/Validation.css" />
        <link type="text/css" rel="stylesheet" href="assets/css/jquery.dataTables.css"/>
        <link type="text/css" rel="stylesheet" href="assets/css/styleE.css"/>
    </head>
    <body class="skin-blue">
        <header class="header">
            <a href="master.php" class="logo">TRIP</a>
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope"></i>
                                <span class="label label-success">4</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 4 messages</li>
                                <li>
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="assets/img/avatar3.png" class="img-circle" alt="User Image"/>
                                                </div>
                                                <h4>Support Team<small><i class="fa fa-clock-o"></i> 5 mins</small></h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="img/avatar2.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>AdminLTE Design Team<small><i class="fa fa-clock-o"></i> 2 hours</small></h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="img/avatar.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>Developers<small><i class="fa fa-clock-o"></i> Today</small></h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="img/avatar2.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>Sales Department<small><i class="fa fa-clock-o"></i> Yesterday</small></h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="img/avatar.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>Reviewers<small><i class="fa fa-clock-o"></i> 2 days</small></h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">See All Messages</a></li>
                            </ul>
                        </li>
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-warning"></i>
                                <span class="label label-warning">10</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 10 notifications</li>
                                <li>
                                    <ul class="menu">
                                        <li>
                                            <a href="#"><i class="ion ion-ios7-people info"></i> 5 new members joined today</a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-warning danger"></i> Very long description here</a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-users warning"></i> 5 new members joined</a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="ion ion-ios7-cart success"></i> 25 sales made</a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="ion ion-ios7-person danger"></i> You changed your username</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">View all</a></li>
                            </ul>
                        </li>
                        <li class="dropdown tasks-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-tasks"></i>
                                <span class="label label-danger">9</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 9 tasks</li>
                                <li>
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <h3>Design some buttons<small class="pull-right">20%</small></h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">20% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <h3>Create a nice theme<small class="pull-right">40%</small></h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">40% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <h3>Some task I need to do<small class="pull-right">60%</small></h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">60% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <h3>Make beautiful transitions<small class="pull-right">80%</small></h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">80% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer">
                                    <a href="#">View all tasks</a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo $loggedTripUser['firstName'].'  '.$loggedTripUser['lastName']?><i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header bg-light-blue">
                                    <img src="data/uploadImage/<?php echo $loggedTripUser['image']; ?>" class="img-circle" alt="User Image" />
                                    <p><?php echo $loggedTripUser['firstName'].'  '.$loggedTripUser['lastName']?> - Software Engineer
                                    <small>Member since July 2012</small></p>
                                </li>
<!--                                <li class="user-body">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </li>-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="loginRegistration/processors/logout.php" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <aside class="left-side sidebar-offcanvas">
                <section class="sidebar">
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="data/uploadImage/<?php echo $loggedTripUser['image']; ?>" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Welcome&nbsp; <?php echo $loggedTripUser['firstName']; ?></p>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>                    
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="#" id="timelineDivId">
                                <i class="fa fa-dashboard"></i><span>Timeline</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-bar-chart-o"></i>
                                <span>Trip</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="#" id="createTripDivId">
                                        <i class="fa fa-angle-double-right"></i>Create
                                    </a>
                                </li>
                                <li>
                                    <a href="#" id="manageTripDivId">
                                        <i class="fa fa-angle-double-right"></i>Manage
                                    </a>
                                </li>                                
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-laptop"></i>
                                <span>Traveler</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="#" id="addNewTravellerDivId">
                                        <i class="fa fa-angle-double-right"></i>Create
                                    </a>
                                </li>
                                <li>
                                    <a href="#" id="manageTravellerDivId">
                                        <i class="fa fa-angle-double-right"></i>Manage
                                    </a>
                                </li>                                                                
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-laptop"></i>
                                <span>Expense</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="#" id="createExpenseDivId">
                                        <i class="fa fa-angle-double-right"></i>Create
                                    </a>
                                </li>
                                <li>
                                    <a href="#" id="manageExpenseDivId">
                                        <i class="fa fa-angle-double-right"></i>Manage
                                    </a>
                                </li>                                                                
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-laptop"></i>
                                <span>Report</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="#" id="viewGraphReportDivId">
                                        <i class="fa fa-angle-double-right"></i>Graph
                                    </a>
                                </li>
                                <li>
                                    <a href="#" id="viewDataReportDivId">
                                        <i class="fa fa-angle-double-right"></i>Data
                                    </a>
                                </li>                                                                
                            </ul>
                        </li>
<!--                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-edit"></i> <span>Forms</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="pages/forms/general.html"><i class="fa fa-angle-double-right"></i> General Elements</a></li>
                                <li><a href="pages/forms/advanced.html"><i class="fa fa-angle-double-right"></i> Advanced Elements</a></li>
                                <li><a href="pages/forms/editors.html"><i class="fa fa-angle-double-right"></i> Editors</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-table"></i> <span>Tables</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="pages/tables/simple.html"><i class="fa fa-angle-double-right"></i> Simple tables</a></li>
                                <li><a href="pages/tables/data.html"><i class="fa fa-angle-double-right"></i> Data tables</a></li>
                            </ul>
                        </li>                        -->
                    </ul>
                </section>
            </aside>
            <aside class="right-side">
                <!--<section class="content-header">-->
                    <!--<h1>TRIP<small>Manager</small></h1>-->
<!--                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>-->
                <!--</section>-->
                <!-- Main content start -->
                <section class="content">
                    <div id="divContent" class="row"></div>
                </section>
                <!-- Main content end -->
            </aside>
        </div>
        <!--<script type="text/javascript" src="assets/js/jquery-1.9.1.js"></script>-->
        <script type="text/javascript" src="assets/js/jQuery2.0.2.min.js"></script>        
        <script type="text/javascript" src="assets/js/bootstrap.min.js" ></script>        
        <script type="text/javascript" src="assets/js/jquery.dataTables.min.js" ></script>
        <script type="text/javascript" src="assets/js/AdminLTE/app.js" ></script>
        <script type="text/javascript" src="assets/js/AdminLTE/demo.js" ></script>                
        <script type="text/javascript" src="assets/js/jquery-ui.js" ></script>
        <script type="text/javascript" src="assets/js/jquery.validate.js"></script>
        <script type="text/javascript" src="assets/js/jquery-ui-1.10.3.min.js" ></script>
        <script type="text/javascript" src="assets/js/jquery.livequery.min.js"></script>
        <script type="text/javascript" src="assets/js/jquery.form.js"></script>        
        <script type="text/javascript" src="assets/js/jquery.noty.packaged.js"></script>
        <script type="text/javascript" src="assets/js/jquery.UIBlock.js"></script>
        <script type="text/javascript" src="assets/js/common.js"></script>
               
        <script type="text/javascript">
            $(document).ready(function()
            {                                         
                $("#timelineDivId").click(function()
                {
                    $("#divContent").empty();
                    $("#divContent").load("timeline.php");
                });    
                
                $("#timelineDivId").trigger("click"); 
                
                $("#manageTripDivId").click(function()
                {
                    $("#divContent").empty();
                    $("#divContent").load("trip/view/manageTrip.php");
                });
                
                $("#createTripDivId").click(function()
                {
                    $("#divContent").empty();
                    $("#divContent").load("trip/view/createTrip.php");
                });
                
                $("#manageTravellerDivId").click(function()
                {
                    $("#divContent").empty();
                    $("#divContent").load("traveller/view/manageTraveller.php");
                });
                
                $("#addNewTravellerDivId").click(function()
                {
                    $("#divContent").empty();
                    $("#divContent").load("traveller/view/addNewTripTraveller.php");
                });
                
                $("#manageExpenseDivId").click(function()
                {
                    $("#divContent").empty();
                    $("#divContent").load("expense/view/manageExpense.php");
                });
                
                $("#createExpenseDivId").click(function()
                {
                    $("#divContent").empty();
                    $("#divContent").load("expense/view/createExpense.php");
                });                                
            });
        </script>
    </body>
</html>