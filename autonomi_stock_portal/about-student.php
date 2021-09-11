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

require_once "functions.php";

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $quantity_arr = $_POST["quantity"];
    $issue_flag = $_POST["issue_flag"];

    $conn = setup();
    
    $result = $conn->query("SELECT stock_id FROM stock_description");
    
    foreach ($issue_flag as $key => $value) {
        $result->data_seek($value);
        $data = $result->fetch_assoc();
        issue_stock($_SESSION["user_id"], $data["stock_id"], $quantity_arr[$value]);
    }
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
                        <li ><a href="home-student.php" >HOME</a></li>
                        <li class="active"><a href="#" >ABOUT</a></li>
                        <li ><a href="#" >CONTENT</a></li>
                        <li ><a href="#">ISSUE</a></li>
                        <li  ><a href="account-student.php" >RETURN</a></li>
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
            <form role="form" action = "<?php echo validate_input($_SERVER["PHP_SELF"]);?>" method = "POST">
                     <div class="container" id="issue_tab">
                        <div class="row clearfix">
                            <div class="col-md-9 column">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr >
                                            <th class="text-center">
                                                Sno
                                            </th>
                                            <th class="text-center">
                                                Stock items
                                            </th>
                                            <th class="text-center">
                                                stock_id
                                            </th>
                                            <th class="text-center">
                                                Left in stock
                                            </th>
                                            <th class="text-center">
                                                Quantity
                                            </th>
                                            <th class="text-center">
                                                Issue[y/n]
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- you have to mulltiply this box bro  -->
<?php 
require_once "functions.php";
$conn = setup();
$result = $conn->query("SELECT * FROM stock_description");
$i = 1;
if ($result->num_rows > 0) {
    while ($data = $result->fetch_assoc()) { ?>

                                        <tr id='addr1'>
                                        <td>
                                            <?php echo $i; ?>
                                        </td>
                                        <td><?php echo $data["name"]; ?></td>
                                        <td><?php echo $data["stock_id"]; ?></td>
                                        <td><?php echo calculate_quantity(2, $data["stock_id"]); ?></td>
                                        <td><input type="text" name='quantity[]'  placeholder='QUANTITY' class="form-control"/></td>
                                        <td><label class="checkbox-inline"><input type="checkbox" name = "issue_flag[]" value = <?php echo $i-1; ?>>issue me</label></td>
                                        </tr>
<?php
$i++;
}}
$conn->close();
?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div >
                        <input type="SUBMIT" id="issue" value="issue" class="btn btn-default">
                    </div>

                </form>
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

<script type="text/javascript">
    $("#menu-toggle").click( function (e){
        e.preventDefault();
        $("#wrapper").toggleClass("menuDisplayed");
    });
</script>
</body>
</html>