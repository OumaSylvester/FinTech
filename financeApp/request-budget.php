<?php 
    ob_start();
    session_start();
    if(!isset($_SESSION['user_level']) || $_SESSION['user_level'] != 1){
        header("Location: login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Request Budget</title>
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

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
            <!-- loader Start -->
		 <div id="loading">
			<div id="loading-center"></div>
      	</div>
	
		<div class="Wrapper" style="margin-top: 30px;">
			
			<!-- Sidebar  -->
			<div class="iq-sidebar">
				<div class="iq-navbar-logo d-flex justify-content-between">
					<a href="index.php" class="header-logo">
					<img src="images/logo.png" class="img-fluid rounded" alt="">
					<span>FinTech</span>
					</a>
					<div class="iq-menu-bt align-self-center">
						<div class="wrapper-menu">
							<div class="main-circle"><i class="ri-menu-line"></i></div>
							<div class="hover-circle"><i class="ri-close-fill"></i></div>
						</div>
					</div>
				</div>
				<div id="sidebar-scrollbar">
					<nav class="iq-sidebar-menu">
						<ul id="iq-sidebar-toggle" class="iq-menu">
							<li class="active">
                            <ul id="dashboard" class="iq-submenu collapse show" data-parent="#iq-sidebar-toggle">
								
								<?php include 'includes/nav.php'; ?>
							</ul>
						</ul>
							</li>
						</ul>
					</nav>
				</div>
			</div> <!--End of sidebar  -->
			<!-- TOP NAV BAR -->
			<div class="iq-top-navbar">
				<div class="iq-navbar-custom">
					<nav class="navbar navbar-expand-lg navbar-light p-0">
						<div class="iq-menu-bt d-flex align-items-center">
							<div class="wrapper-menu">
								<div class="main-circle"><i class="ri-menu-line"></i></div>
								<div class="hover-circle"><i class="ri-close-fill"></i></div>
							</div>
							<div class="iq-navbar-logo d-flex justify-content-between ml-3">
								<a href="index.html" class="header-logo">
								<img src="images/logo.png" class="img-fluid rounded" alt="">
								<span>FinDash</span>
								</a>
							</div>
						</div>
						
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"  aria-label="Toggle navigation">
						<i class="ri-menu-3-line"></i>
						</button>
						<!-- 
						<div class="collapse navbar-collapse" id="navbarSupportedContent">
							<ul class="navbar-nav ml-auto navbar-list">
								<li class="nav-item">
								<a class="search-toggle iq-waves-effect language-title" href="#"><span class="ripple rippleEffect" style="width: 98px; height: 98px; top: -15px; left: 56.2969px;"></span><img src="images/small/flag-01.png" alt="img-flaf" class="img-fluid mr-1" style="height: 16px; width: 16px;"> EN <i class="ri-arrow-down-s-line"></i></a>
								<div class="iq-sub-dropdown">
									<a class="iq-sub-card" href="#"><img src="images/small/flag-02.png" alt="img-flaf" class="img-fluid mr-2">French</a>
									<a class="iq-sub-card" href="#"><img src="images/small/flag-03.png" alt="img-flaf" class="img-fluid mr-2">Spanish</a>
									<a class="iq-sub-card" href="#"><img src="images/small/flag-04.png" alt="img-flaf" class="img-fluid mr-2">Italian</a>
									<a class="iq-sub-card" href="#"><img src="images/small/flag-05.png" alt="img-flaf" class="img-fluid mr-2">German</a>
									<a class="iq-sub-card" href="#"><img src="images/small/flag-06.png" alt="img-flaf" class="img-fluid mr-2">Japanese</a>
								</div>
								</li>
							</ul>
						</div> -->
						<?php include 'includes/request-budget-header.php';?>
						
					</nav>
				</div>
			</div>

      <div class="content-page">
				<div class="container-fluid">
					
            <!-- MAIN CONTENT SECTION -->
            <div class="row" style="padding-left: 0px">
                <nav class="col-sm-">
                    <ul class="nav nav-pills flex-column">
                        <?php //include 'includes/nav.php'; ?>
                    </ul>
                </nav>

                <!-- VALIDATE INPUT -->
                <?php 
                    if($_SERVER['REQUEST_METHOD'] =='POST'){
                        require ('process-budget-request.php');
                    }
                ?>
                <!-- MAIN SECTION -->
                <div class="col-sm-10">
                    <!-- GET THE PROJECT MANAGER REQUESTS -->
                    <h2 class="h2 text-center">Request a budget</h2>
                    <form action="request-budget.php" name="request_bedget" id="request_budget" method="post">
                        <div class="form-group row">
                            <label for="amount" class="col-sm-4 col-form-label">Amount:</label>
                            <div class="col-sm-8">
                                <input type="currency" name="amount" id="amount" class="form-control" required maxlength="12" placeholder="$"  pattern="[0-9]{1,3}[,]?[0-9]*[.]?[0-9]*"  title="Enter valid Currency. Onlu numbers, comma and fullstop" value="<?php if(isset($_POST['amount'])) echo htmlspecialchars($_POST['amount'], ENT_QUOTES); ?>">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-sm-4 col-form-label">Description:</label>
                            <div class="col-sm-8">
                                <input type="text" name="description" id="description" class="form-control" required value="<?php if(isset($_POST['description'])) echo htmlspecialchars($_POST['description'], ENT_QUOTES); ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="submit" class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-8">
                                <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Request" style="margin-top: 8px;">
                            </div> 
                        </div>

                    </form>
                </div>
                <!-- RIGHT SIDE COLUMN/SIDEBAR -->
                <?php
					if(!isset($errorstring)){
						echo '<aside class="col-sm-2">';
						include 'includes/info-col.php';
						echo '</aside>';
						echo '</div>'; //close the div of body section(the middle section of the page containing the left nav links, the form and the rigt info)
						//include the footer
						echo '<footer class="jumbotron text-center row col-sm-12"
							style="padding-bottom:1px; padding-top:8px;">';
						
					}else{//we don't display the aside info-col if there are errors. We use the 2 small collumns to display the errors
						echo '<footer class="jumbotron text-center col-sm-12" style="padding-bottom:1px; padding-top:8px;">';
						
					}
					include 'includes/footer.php';
					echo '</footer>';
					echo '</div>';
                    ob_end_flush();

            ?>
    </div>
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