<?php                                                                       
session_start();
if (!isset($_SESSION['user_level']))
{
     header("Location: login.php");
     exit();
}
?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS File -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/profile.css">
    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon.ico" />
		<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Typography CSS -->
    <link rel="stylesheet" href="css/typography.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">

</head>
<body>
    <div class="container" style="margin-top:30px">
        <!-- Header Section -->
        <header class="jumbotron text-center row" style="margin-bottom:2px; background:linear-gradient(white, #0073e6); padding:20px;"> 
                <?php 
                    if($_SESSION['user_level'] == 0) include 'includes/members-header.php';
                    else if($_SESSION['user_level'] == 1) include 'includes/admin-header.php';
                    else if($_SESSION['user_level'] == 2) include 'includes/finance-employee-header.php';
                    else if($_SESSION['user_level'] == 3) include 'includes/finance-manager-header.php';
                    else if($_SESSION['user_level'] == 4) include 'includes/owner-header.php';
                
                ?>
        
        </header>
        <!-- Body Section -->
        <div class="row" style="padding-left: 0px;">
            <!-- Left-side Column Menu Section -->
            <nav class="col-sm-2">
                <ul class="nav nav-pills flex-column">
                <?php 
                                    if($_SESSION['user_level'] == 0) include 'includes/members-nav.php';
                                    else if($_SESSION['user_level'] == 1) include 'includes/nav.php';
                                    else if($_SESSION['user_level'] == 2) include 'includes/members-nav.php';
                                    else if($_SESSION['user_level'] == 3) include 'includes/members-nav.php';
                                    else if($_SESSION['user_level'] == 4) include 'includes/members-nav.php';
                                
                                ?> 
                </ul>
            </nav>
            <!-- Center Column Content Section -->
            <div class="col-sm-8">
                <?php require ("process-edit-profile.php"); ?>
            </div>
            <!-- Right-side Column Content Section -->
            <aside class="col-sm-2">
                <?php include('includes/info-col.php'); ?> 
            </aside>
        </div>
        <!-- Footer Content Section -->
        <footer class="jumbotron text-center row" style="padding-bottom:1px; padding-top:8px;">
            <?php include('includes/footer.php'); ?>
        </footer>
        </div>
        <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <!-- Appear JavaScript -->
      <script src="js/jquery.appear.js"></script>
      <!-- Countdown JavaScript -->
      <script src="js/countdown.min.js"></script>
      <!-- Counterup JavaScript -->
      <script src="js/waypoints.min.js"></script>
      <script src="js/jquery.counterup.min.js"></script>
      <!-- Wow JavaScript -->
      <script src="js/wow.min.js"></script>
      <!-- Apexcharts JavaScript -->
      <script src="js/apexcharts.js"></script>
      <!-- Slick JavaScript -->
      <script src="js/slick.min.js"></script>
      <!-- Select2 JavaScript -->
      <script src="js/select2.min.js"></script>
      <!-- Owl Carousel JavaScript -->
      <script src="js/owl.carousel.min.js"></script>
      <!-- Magnific Popup JavaScript -->
      <script src="js/jquery.magnific-popup.min.js"></script>
      <!-- Smooth Scrollbar JavaScript -->
      <script src="js/smooth-scrollbar.js"></script>
      <!-- lottie JavaScript -->
      <script src="js/lottie.js"></script>
      <!-- am core JavaScript -->
      <script src="js/core.js"></script>
      <!-- am charts JavaScript -->
      <script src="js/charts.js"></script>
      <!-- am animated JavaScript -->
      <script src="js/animated.js"></script>
      <!-- am kelly JavaScript -->
      <script src="js/kelly.js"></script>
      <!-- am maps JavaScript -->
      <script src="js/maps.js"></script>
      <!-- am worldLow JavaScript -->
      <script src="js/worldLow.js"></script>
      <!-- Style Customizer -->
      <script src="js/style-customizer.js"></script>
      <!-- Chart Custom JavaScript -->
      <script src="js/chart-custom.js"></script>
      <!-- Custom JavaScript -->
      <script src="js/custom.js"></script>
    </body>
</html>
