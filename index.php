<?php 
    $message = '';
    if(isset($_GET['Message']))
    {
        $message = $_GET['Message'];
    }                
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>TRIP</title>
        <link type="text/css" rel='stylesheet' href='assests/css/fontone.css'>
        <link type="text/css" rel='stylesheet' href='assests/css/fonttwo.css'>
        <link type="text/css" rel="stylesheet" href="assests/css/font-awesome.min.css">
        <link type="text/css" rel="stylesheet" href="assests/css/preloader.css" media="screen, print"/>
        <link type="text/css" rel="stylesheet" href="assests/common/style.css">
        <link type="text/css" rel="stylesheet" href="assests/css/owl.carousel.css">
        <link type="text/css" rel="stylesheet" href="assests/css/owl.theme.default.css">
        <link type="text/css" rel="stylesheet" href="assests/css/animate.css">
        <link type="text/css" rel="stylesheet" href="assests/css/jquery-ui-1.10.3.custom.css"/>
        <link type="text/css" rel="stylesheet" href="assests/css/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="assests/css/Validation.css" />
        <link type="text/css" rel="stylesheet" href="assests/css/style.css">
        <link type="text/css" rel="stylesheet" href="assests/css/responsive.css">       
    </head>
    <body>        
        <header id="HOME" style="background-position: 50% -125px;">
            <div class="section_overlay">                
                <nav class="navbar navbar-default navbar-fixed-top">
                    <div class="container">                        
                        <div class="navbar-header">                            
                            <a class="navbar-brand" href="#"><img src="assests/images/rise-logo.png" alt=""></a>
                            <form class="nav navbar-nav" name="login" id="loginFormId" action="loginRegistration/processors/loginAction.php" method="post">
                                <input type="text" name="loginEmail" id="loginEmailId" placeholder="Email" value="mehul@gmail.com"/>
                                <input type="password" name="loginPassword" id="loginPasswordId" placeholder="Password" value="m"/>
                                <input type="submit" name="signin" id="signin" value="Sign in" />
                                <a href="#">Forgot password?</a>
                            </form>
                        </div>   
                        <div><?php echo $message; ?></div>
                    </div>                    
                </nav>                            
            </div>         
        </header>
        <section class="contact col4" id="CONTACT">
            <div class="container">            
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="contact_title  wow fadeInUp animated">
                            <h1>Get started - it's free.</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container ">
                <div class="row">                
                    <div class="col-md-12  wow fadeInRight animated">
                        <form class="contact-form" name="registration" id="registrationFormId" action="loginRegistration/processors/registrationAction.php" method="post">
                            <div class="row ">
                                <div class="col-md-4 "></div>
                                <div class="col-md-4 ">
                                    <input type="text" class="form-control" name="registrationFirstName" id="registrationFirstName" placeholder="First Name">
                                    <input type="text" class="form-control" name="registrationLastName" id="registrationLastName" placeholder="Last Name">                                    
                                        <div style="width:100px; float:left">
                                            <input type="radio" GroupName="gend" name="gender" id="genderMaleUpdate" value="Male" checked="checked" style=" width:30px;"  />
                                            <div style="margin-top:10px;">male</div>
                                        </div>
                                        <div style="width:100px; float:left">
                                            <input type="radio" GroupName="gend" name="gender" id="genderFemaleUpdate" value="Female" style=" width:30px;"  />  
                                            <div style="margin-top:10px;">Female</div> 
                                        </div>
                                    <input type="email" class="form-control" name="registrationEmail" id="registrationEmailId" placeholder="Email">  
                                    <div id="uniqueEmailMessageDivId"></div>
                                    <input type="password" class="form-control" name="registrationPassword" id="registrationPassword" placeholder="Password">
                                    <input type="password" class="form-control" name="registrationConfirmPassword" id="registrationConfirmPassword" placeholder="Confirm Password"> 
                                    <input type="text" class="form-control number" name="registrationMobile" id="registrationMobile" placeholder="Mobile" maxlength="10">                                    
                                    <input type="submit" class="btn btn-default submit-btn form_submit" name="registrationSubmit" id="registrationSubmit" value="Join in">
                                </div>  
                                <div class="col-md-4 "></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <footer>
            <div class="container">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div class="footer_logo   wow fadeInUp animated">
                                <img src="assests/images/rise-logo.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
    <!--                <div class="row">
                        <div class="col-md-12 text-center   wow fadeInUp animated">
                            <div class="social">
                                <h2>Follow Me on Here</h2>
                                <ul class="icon_list">
                                    <li><a href="http://www.facebook.com/abdullah.noman99"target="_blank"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="http://www.twitter.com/absconderm"target="_blank"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href=""><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="http://www.dribbble.com/abdullahnoman"target="_blank"><i class="fa fa-dribbble"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>-->
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div class="copyright_text   wow fadeInUp animated">
                                <p>&copy; rise 2018. All Right Reserved By <a href="https://rishabhsoft.com"target="_blank">Rishabh Software</a></p>                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- ========================= SCRIPTS ============================== -->           
        <!--<script src="assests/js/jquery.min.js"></script>-->
        <script src="assests/js/jQuery2.0.2.min.js"></script>
        <script src="assests/js/bootstrap.min.js"></script>
        <script src="assests/js/jquery.nicescroll.js"></script>
        <script src="assests/js/owl.carousel.js"></script>
        <script src="assests/js/wow.js"></script>
        <script src="assests/js/script.js"></script>
        <script type="text/javascript" src="assests/js/jquery-ui.js" ></script>
        <script type="text/javascript" src="assests/js/jquery.validate.js"></script>
        <script type="text/javascript" src="loginRegistration/js/loginValidation.js"></script>
        <script type="text/javascript" src="loginRegistration/js/registrationValidation.js"></script>
        <script type="text/javascript" src="assests/js/common.js"></script>
        <script type="text/javascript">
            $(document).ready(function()
            {
                 $(document).on("blur", "#registrationEmailId", function() 
                 {
                    var emailId = $("#registrationEmailId").val();                                                    
                    $.ajax({
                        type:'post',
                        url:'loginRegistration/processors/UniqueEmailAction.php',
                        data:'emailId='+emailId,
                        dataType:'json',
                        async:'true',
                        cache:'false',
                        success: function(data)
                        {
                            if (data === true)
                            {
                                $("#uniqueEmailMessageDivId").html("Someone already has that E-Mail Id. Try another?");
                                $("#registrationEmailId").val('');
                            }
                            else
                            {
                                $("#uniqueEmailMessageDivId").html("");
                            }    
                        }
                    });
                });
//                $("#registrationEmailId").focusout(function() 
//                {  
////                    alert("first");
//                                                                                                                      
//                });
                
            });
        </script>
        </script>
    </body>
</html>