<?php
    session_start();
    if(!isset($_SESSION['user_level']) || $_SESSION['user_level'] == 0){  
        //user not logged in or user not project employee
        header("Location: login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>View Projects</title>
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">

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
        <div class="container" style="margin: top 30px;">
            <!-- HEADER SECTION -->
            <header class="row jumbotron text-center" 
                style="margin-bottom: 2px; background: linear-gradient(white, #0073e6); padding: 20px">
                <?php include 'includes/view-bills-header.php' ?>
            </header>

            <!-- BODY SECTION -->
            <div class="row" style="padding-left: 0px">
                <!-- LEFT NAV BAR -->
                <nav class="col-sm-2">
                    <ul class="nav nav-pills flex-column">
                        <?php include 'includes/nav.php' ?>
                    </ul>

                </nav>

                <!-- Center column - CONTENT SECTION-->
                <div class="col-sm-10">
                    <h2 class="text-center">Bills: </h2>
                    <p>
                        <?php require 'process-view-bills.php'; ?>
                    </p> 
                    
                </div>

                <!-- RIGHT SIDE COLUMUN/SIDEBAR -->

            </div> 

            <!-- FOOTER -->
            <footer class="row jumbotron text-center" style="padding-bottom: 1px; padding: top 8px;">
                <?php include 'includes/footer.php'; ?>
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