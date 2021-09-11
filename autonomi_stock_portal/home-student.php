<!DOCTYPE html>
<?php
session_start();
$now = time();
if (isset($_SESSION['discard_after']) && $now > $_SESSION['discard_after']) {
    session_unset();
    session_destroy();
    header("Location: index.php");
}
if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
}
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
</head>
<body>
    <div id="header">
        <div id="top-nav">
            <img src="images/cic_logo.png" height="100px">
        </div>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                    <ul class="nav navbar-nav">
                    <li><div class="row">
                        <div class="col-lg-12">
                         <a href="#" class="btn btn-success" id="menu-toggle"><span ><?php require_once "functions.php";
                            if (isset($_SESSION["user_id"]))
                                {echo "Hello, ".get_username()."";}
                            else 
                                { header("Location: index.php");} ?></span></a>
                        </div>
                    </div></li>
                        <li class="active"><a href="#" >HOME</a></li>
                        <li ><a href="#" >ABOUT</a></li>
                        <li ><a href="#" >CONTENT</a></li>
                        <li ><a href="about-student.php" >ISSUE</a></li>
                        <li ><a href="account-student.php" >RETURN</a></li>
                    </ul>
            </div>
         </nav>
    </div>
        <div id="wrapper">
            <!-- Sidebar -->
            <div id="sidebar-wrapper">
                <ul class="sidebar-nav">
                    <li><a href="#">Account</a></li>
                    <li><a href="#">Settings</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
        <!-- Page content -->
            <div class="container-fluid">
                <div class="row">
                <section class="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
                    <h1 class="page-header"> Stock </h1>
                </section>
            </div>
            <div class="row">
                
                
                <div id="alumni-cards" class="col-xs-12 col-lg-10 col-lg-offset-2">
                    
                    <!--<div class="row">-->

<?php 
require_once "functions.php";
$conn = setup();
$result = $conn->query("SELECT * FROM stock_description");
if ($result->num_rows > 0) {
    while ($data = $result->fetch_assoc()) { ?>
                    <div class="alumni-card-container col-xs-6 col-sm-4 col-md-3 col-lg-3">
                        <div class="alumni-card">
                            <div class= "row">
                                <img class="img-circle col-xs-offset-2 col-xs-10 alumni-photo" src="images/6.jpg"/>
                            </div>
                            <div class="row">
                                <div class="alumni-card-details">
                                    <h4><?php echo $data["name"]; ?></h4>
                                    <h5><?php echo $data["description"]; ?></h5>
                                    <h6><br><?php echo calculate_quantity(2, $data['stock_id']); ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
<?php
}}
$conn->close();
?>

            </div>
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
    
<script type="text/javascript">
    $("#menu-toggle").click( function (e){
        e.preventDefault();
        $("#wrapper").toggleClass("menuDisplayed");
    });
</script>
</body>
</html>