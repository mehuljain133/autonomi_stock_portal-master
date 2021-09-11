<!DOCTYPE html>
<?php
session_start();
?>
<html lang="en">
<head>
    <title>stock</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="stock.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php 
if (isset($_SESSION["registration_error"]))
    echo "<script> $(\"#upModal\").modal(\"show\")</script>";
else if (isset($_SESSION["login_error"]))
    echo "<script> $(\"#inModal\").modal(\"show\")</script>";
?>
    <div id="header">
        <div id="top-nav">
            <img src="images/cic_logo.png" height="100px">
            <ul class="nav navbar-nav navbar-right" style="margin-right:0px">
                <li ><a type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#upModal" style="border-radius:0px 0px 5px 5px " href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li><a type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#inModal" style="border-radius:0px 0px 5px 5px " href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            </ul>
        </div>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                    <ul class="nav navbar-nav">
                    <li><div class="row">
                        <div class="col-lg-12">
                            <a href="#" class="btn btn-success" id="menu-toggle"><span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span></a>
                        </div>
                    </div></li>
                        <li ><a href="#" >HOME</a></li>
                        <li ><a href="#" >ABOUT</a></li>
                        <li ><a href="#" >CONTENT</a></li>
                    </ul>
            </div>
         </nav>
    </div>
        <div id="wrapper">
            <!-- Sidebar -->
            <div id="sidebar-wrapper">
                <ul class="sidebar-nav">
                    
                    
                    
                </ul>
            </div>
        </div>
        <!-- Page content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
            </div>
        </div>
    <footer>
        <div class="footer">
            <div class="wrapper padder">
                <div class="row no-margin padder navbar-add-border-bottom navbar-add-border-top">
                    <div class="col-lg-8">
                        <dl class="dl-horizontal">
                            <dt><a href="Programs-Dir">Study at CIC</a></dt>
                            <dd>
                                <ol class="list-unstyled">
                                <li><a href="http://ducic.ac.in/Programs-BTech-IT-Concept">B.Tech. (Information Technology &amp; Mathematical Innovations)</a></li>
                                <li><a href="http://ducic.ac.in/Programs-BA-Hons-Concept">B.A. Honours (Humanities &amp; Social Sciences)</a></li>
                                <li><a href="http://ducic.ac.in/Programs-MME-Concept">M.Sc. (Mathematics Education) @ Meta University</a></li>
                                </ol>
                            </dd>
                            <dt><a href="About-Objectives">About CIC</a></dt>
                            <dd>
                                <ol class="list-unstyled">
                                <li><a href="http://ducic.ac.in/About-Objectives">Objectives</a></li>
                                <li><a href="http://ducic.ac.in/InnovationHub">Facilities</a></li>
                                <li><a href="http://ducic.ac.in/About-Governance">Governance</a></li>
                                <li><a href="http://ducic.ac.in/About-Alliance">Alliance and Collaboration</a></li>
                                </ol>
                            </dd>
                            <dt><a href="">Innovation</a></dt>
                            <dd>
                                <ol class="list-unstyled">
                                <li><a href="http://ducic.ac.in/Innovation-Projects">Innovation Projects</a></li>
                                <li><a href="http://ducic.ac.in/Internships">Internships</a></li>
                                <li><a href="http://ducic.ac.in/InnovationHub">Innovation Hubs (Labs and Library)</a></li>
                                </ol>
                                </dd>
                        </dl>
                    </div>
                    <div class="col-lg-4 goCenter">
                        <h3 class="goCenter no-margin">
                        <a href="https://www.facebook.com/CIC.DU" target="blank"><img src="css/images/icons/facebook29.png" style="width:30px;"></a>
                         
                        <a href="https://twitter.com/itweetcic" target="blank"><img src="css/images/icons/twitter21.png" style="width:30px;"></a>
                         
                        </h3>
                        <h4><a href="http://ebiz.ducic.ac.in" target="new"><img src="css/images/icons/e-business.png" style="max-height:25px; max-width:100%"></a></h4>
                        <h4><a href="http://autonomi.ducic.ac.in" target="new"><img src="css/images/icons/autonomi.png" style="max-height:30px; max-width:100%"></a></h4>
                        <h4><a href="http://ducic.ac.in/Hub-IT-Innovations-Lab" target="new"><img src="css/images/icons/itil.png" style="max-height:35px; max-width:100%"></a></h4>
                        <h4><a href="https://one.ducic.ac.in" target="new"><img src="css/images/icons/one-logo.png" style="max-height:25px; max-width:100%"></a></h4>
                    </div>
            </div>
            <div class="row no-margin padder">
                <div class="col-lg-6 goCenter">
                    <h3><a href="Contact">Contact Us</a></h3>
                </div>
                    <div class="col-lg-6 goCenter">
                        <p><img src="images/logo_footer.png" class="logo-long"></p>
                        <p><strong><i class="fa fa-envelope"></i> <a href="mailto:director@cic.du.ac.in">director@cic.du.ac.in</a>&nbsp; | &nbsp;<i class="fa fa-phone"></i> <a href="callto:+91-11-27666702">+91-11-27666702</a> </strong>(Monday to Friday 10:00AM to 5:00PM)</p>
                    </div>
            </div>
                    <div class="row text-center">
                        <p class="no-margin">Website Managed by the folks at <strong>IT Innovations Lab</strong> &amp; <strong>CIC WebCentral</strong>, Cluster Innovation Centre.</p>
                        <p class="no-margin">&copy; <strong>Cluster Innovation Centre</strong>, University of Delhi. <a href="/privacy-policy">Privacy Policy</a></p>
                        <small>This site uses cookies to customise your user experience. By continuing to browse the site, you are agreeing to our use of cookies. Please read our <a href="/privacy-policy">Privacy Policy</a> for details.</small>
                    </div>
                </div>
            </div>
        </div>
    </footer>




    <div id="upModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">AUTONOMI</h4>
      </div>
      <div class="modal-body">
        <div class="row ">
        <div class="col-xs-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">
                        <h3 class="panel-title">Please sign up for Autonomi<small>    Only for CICians</small></h3>
                        </div>
                        <div class="panel-body">
                        <?php 
                        if (isset($_SESSION["registration_error"])){
                            echo $_SESSION["registration_error"];
                            unset($_SESSION["registration_error"]);
                        }
                        ?>
                        <form role="form" action = "create-new-user.php" method = "POST">
                                    <div class="form-group">
                                        <input type="text" name="user_fullname" id="full_name" class="form-control input-sm" placeholder="Full Name">
                                    </div>
                            <div class="form-group">
                                <input type="text" name="u_name" id="u_name" class="form-control input-sm" placeholder="User Name">
                            </div>                                

                            <div class="form-group">
                                <input type="email" name="email_id" id="email" class="form-control input-sm" placeholder="Email Address">
                            </div>

                        <div class="row">

                            <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password">
                                    </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="password" name="confirm_password" id="password_confirmation" class="form-control input-sm" placeholder="Confirm Password">
                                    </div>
                            </div>
                        </div>
                            
                            <input type="submit" value="Register" class="btn btn-info btn-block">
                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Exit</button>
      </div>
    </div>

  </div>
    </div>
    </div>


<div id="inModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">AUTONOMI</h4>
      </div>
      <div class="modal-body">
        <div class="row ">
        <div class="col-xs-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">
                        <h3 class="panel-title">Please log in for Autonomi<small>    Only for CICians</small></h3>
                        </div>
                        <div class="panel-body">
                        <?php 
                        if (isset($_SESSION["login_error"])){
                            echo $_SESSION["login_error"];
                            unset($_SESSION["login_error"]);
                        }
                        ?>
                        <form role="form" action = "login.php" method = "POST">
                            <div class="form-group">
                                <input type="text" name="u_name" id="u_name" class="form-control input-sm" placeholder="username">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password">
                            </div>
                            <input type="submit" value="LOG IN" class="btn btn-info btn-block">
                        </form>
                    </div>
                </div>
            </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Exit</button>
      </div>
    </div>

  </div>
</div>






       <!-- Menu toggle script -->
        <script>
            $("#menu-toggle").click( function (e){
                e.preventDefault();
                $("#wrapper").toggleClass("menuDisplayed");
            });
        </script>
</body>
</html>