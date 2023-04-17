<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Register</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--Bootstrap CSS File -->
		<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">

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

		<script type="text/javascript" src="verify.js"></script>
		<script src='https://www.google.com/recaptcha/api.js'></script>   
		
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
								<a href="#dashboard" class="iq-waves-effect" data-toggle="collapse" aria-expanded="true"><span class="ripple rippleEffect"></span><i class="las la-home iq-arrow-left"></i><span>Dashboard</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
								<ul id="dashboard" class="iq-submenu collapse show" data-parent="#iq-sidebar-toggle">
								<li class="active"><a href="#"><i class="las la-laptop-code">Our Partners</i></a></li>
								<li><a href="#"><i class="las la-ad"></i>Marketing Dashboard</a></li>
								<li><a href="#"><i class="lab la-bandcamp"></i>Product Management</a></li>
								<li><a href="#"><i class="las la-atom"></i>Sales Dashboard</a></li>
								<li><a href="#"><i class="las la-crosshairs"></i>Banking Dashboard</a></li>
								<li><a href="#"><i class="las la-cash-register"></i>Cash Management </a></li>
								<li><a href="#"><i class="las la-bullseye"></i>About </a></li>
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
						<?php include 'includes/register-header.php';?>
						
					</nav>
				</div>
			</div>

      <div class="content-page">
			<div class="container-fluid">
					
				<!--Body Section -->
				<div class="row" style="padding-left:0px;">
					<!--Left-side Colunm Menu Section -->
					<nav class="col-sm-2">
						<ul class="nav nav-pills flex-column">
							<?php //include 'includes/nav.php'; ?>
						</ul>
					</nav>

					<!-- Validate Input -->
					<?php 
						if($_SERVER['REQUEST_METHOD'] == 'POST'){
							require ('process-register-page2.php');
						}// End of the main Submit conditional.
					?>
					<div class="col-sm-8">
						<h2 class="h2 text-center">Register</h2>
						<h3>Items marked with an asterik * are required</h3>

						<form enctype="multipart/form-data" action="register-page.php" method="post" onsubmit="return checked();" name="regform" id="regfrom">
						<!-- 
						<div class="form-group row">
							<label for="title" class="col-sm-4 col-form-label text-right">Title:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="title" name="title" placeholder="Title" maxlength="12" pattern='[a-zA-Z][a-zA-Z\s\.]*'  title="Alphabetic, period and space max 12 characters"
								value="<?php if (isset($_POST['title'])) 
								echo htmlspecialchars($_POST['title'], ENT_QUOTES); ?>" >
							</div>
						
					</div>-->
							<div class="form-group row">
								<label for="first_name" class="col-sm-4 col-form-label">*First Name:</label>
								<div class="col-sm-8">
									<input type="text" name="first_name" class="form-control" id="first_name" title="Alphabetic and space only max of 30 characters" 
									pattern="[a-zA-Z][a-zA-Z\s]*" placeholder="First Name" maxlength="30" required value="<?php if(isset($_POST['first_name'])) echo htmlspecialchars($_POST['first_name'], ENT_QUOTES);?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="last_name" class="col-sm-4 col-form-label">*Last Name:</label>
								<div class="col-sm-8">
									<input type="text" name="last_name" class="form-control" id="last_name" pattern="[a-zA-Z][a-zA-Z\s]*" title="Alphabetic and space only max of 40 characters"
									placeholder="Last Name" maxlength="40" required value="<?php if(isset($_POST['last_name'])) echo htmlspecialchars($_POST['last_name'], ENT_QUOTES);?>">
								</div>
							</div>

							<div class="form-group row">
								<label for="email" class="col-sm-4 col-form-label">*E-mail:</label>
								<div class="col-sm-8">
									<input type="email" name="email" class="form-control" id="email" placeholder="E-mail" maxlength="60" required value="<?php if(isset($_POST['email'])) echo htmlspecialchars($_POST['email'], ENT_QUOTES);?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="profile-pic" class="col-sm-4 col-form-label">*Choose Profile Picture:</label>
								<div class="col-sm-8">
									<input type="file" name="profile-pic" id="profile-pic" class="form-control" placeholder="Upload Profile Picture" required value="<?php if(isset($_FILES['profile_pic'])) echo htmlspecialchars($_FILES['profile_pic'], ENT_QUOTES); ?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="date_of_birth" class="col-sm-4 col-form-label">*Date of birth:</label>
								<div class="col-sm-8">
									<input type="date" name="date_of_birth" class="form-control" id="date_of_birth" placeholder="" required value="<?php if(isset($_POST['date_of_birth'])) echo htmlspecialchars($_POST['date_of_birth'], ENT_QUOTES);?>">
								</div>
							</div>

							<div class="form-group row">
								<label for="password1" class="col-sm-4 col-form-label">*Password:</label>
								<div class="col-sm-8">
									<input type="password" name="password1" class="form-control"
									id="password1" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8, 12}"
									title="One number, one upper, one lower, one special with 8 to 12 characters" placeholder="Password" minlength="8" maxlength="12" required value="<?php if(isset($_POST['password1'])) echo htmlspecialchars($_POST['password1'], ENT_QUOTES);?>">
									<span id="message">Between 8 and 12 characters.</span>
								</div>
							</div>

							<div class="form-group row">
								<label for="password2" class="col-sm-4 col-form-label text-right">Confirm Password*:</label>
								<div class="col-sm-8">
									<input type="password" class="form-control" id="password2" name="password2"
									pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,12}" 
									title="One number, one uppercase, one lowercase letter, with 8 to 12 characters"
									placeholder="Confirm Password" minlength="8" maxlength="12" required
									value=
										"<?php if (isset($_POST['password2'])) 
										echo htmlspecialchars($_POST['password2'], ENT_QUOTES); ?>" >
								</div>
							</div>
								
							
							<div class="form-group row">
								<label for="address1" class="col-sm-4 col-form-label text-right">Address*:</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="address1" name="address1" 
										pattern="[a-zA-Z0-9][a-zA-Z0-9\s\.\,\-]*" 
										title="Alphabetic, numbers, period, comma, dash and space only max of 30 characters" 
										placeholder="Address" maxlength="30" required
										value="<?php if (isset($_POST['address1'])) 
										echo htmlspecialchars($_POST['address1'], ENT_QUOTES); ?>" >
								</div>
							</div>
							<div class="form-group row">
								<label for="address2" class="col-sm-4 col-form-label text-right">Address:</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="address2" name="address2" 
										pattern="[a-zA-Z0-9][a-zA-Z0-9\s\.\,\-]*" 
										title="Alphabetic, numbers, period, comma, dash and space only max of 30 characters" 
										placeholder="Address" maxlength="30"
										value=
											"<?php if (isset($_POST['address2'])) 
											echo htmlspecialchars($_POST['address2'], ENT_QUOTES); ?>" >
								</div>
							</div>
							
							<div class="form-group row">
								<label for="city" class="col-sm-4 col-form-label text-right">City*:</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="city" name="city" 
									pattern="[a-zA-Z][a-zA-Z\s\.]*" 
									title="Alphabetic, period and space only max of 30 characters" 
									placeholder="City" maxlength="30" required
									value=
										"<?php if (isset($_POST['city'])) 
										echo htmlspecialchars($_POST['city'], ENT_QUOTES); ?>" >
								</div>
							</div>
							<div class="form-group row">
								<label for="state_country" class="col-sm-4 col-form-label text-right">Country/state*:</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="state_country" name="state_country"
									pattern="[a-zA-Z][a-zA-Z\s\.]*" 
									title="Alphabetic, period and space only max of 30 characters" 
									placeholder="State or Country" maxlength="30" required
									value=
										"<?php if (isset($_POST['state_country'])) 
										echo htmlspecialchars($_POST['state_country'], ENT_QUOTES); ?>" >
								</div>
							</div>

							<div class="form-group row">
								<label for="zcode_pcode" class="col-sm-4 col-form-label text-right">Zip/Postal Code*:</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="zcode_pcode" name="zcode_pcode" 
									pattern="[a-zA-Z0-9][a-zA-Z0-9\s]*" 
									title="Alphabetic, numeric and space only max of 30 characters" 
									placeholder="Zip or Postal Code" minlength="5" maxlength="30" required
									value=
										"<?php if (isset($_POST['zcode_pcode'])) 
										echo htmlspecialchars($_POST['zcode_pcode'], ENT_QUOTES); ?>" >
								</div>
							</div>

							<div class="form-group row">
								<label for="phone" class="col-sm-4 col-form-label text-right">Telephone:</label>
								<div class="col-sm-8">
									<input type="tel" class="form-control" id="phone" name="phone" 
									placeholder="Phone Number" maxlength="30"
									value=
										"<?php if (isset($_POST['phone'])) 
										echo htmlspecialchars($_POST['phone'], ENT_QUOTES); ?>" >
								</div>
							</div>

							<div class="form-group row">
								<label for="question" class="col-sm-4 col-form-label text-right">Secret Question*:</label>
								<div class="col-sm-8">
									<select id="question" name="question" class="form-control">
										<option selected value="">- Select -</option>
										<option value="Maiden">Mother's Name</option>
										<option value="Pet">Pet's Name</option>
										<option value="School">High School</option>
										<option value="Vacation">Favorite Vocation Spot</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="secret" class="col-sm-4 col-form-label text right">Answer*:</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="secret" name="secret"
										pattern="[a-z-A-Z][a-zA-Z\s\.\,\-]*" title="Alphabetic, period, comma, dash and space only max of 30 characters" placeholder="Secret Answer"
										maxlength="30" required value="<?php if(isset($_POST['secret']))
										echo htmlspecialchars($_POST['secret'], ENT_QUOTES);?>" >
								</div>
							</div>
							
							<div class="form-group row">
								<label class="col-sm-4 col-form-label"></label>
								<div class="col-sm-8">
									<div class="float-left g-recaptcha" data-sitekey="6LcrQ1wUAAAAAPxlrAkLuPdpY5qwS9rXF1j46fhq"></div>
								</div>

							</div>
							<div class="form-group row">
								<label for="" class="col-sm-4 col-form-label"></label>
								<div class="col-sm-8">
									<input type="submit" name="submit" id="submit" class="btn btn-primary" value="Register">
								</div>
							</div>
							
						</form>
						

					</div> <!--End of div col-sm-8 for the form -->
				<!--Right-side Column Content Section-->
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