<div class="col-sm-2">
	<!-- <img src="logo.png" class="img-fluid float-left" alt="Logo">	 -->
	<!-- User profile -->
	<div class="profile-details">
        <?php echo '<img src="images/profile/' . $_SESSION['profile_pic'] . '" alt="Profile Picture" class="profile-pic">';
            echo '<h2 class="profile-name" class="h2">' . $_SESSION['user_name'] . '</h2>';
        ?>
	</div>
	
	
</div>

<div class="col-sm-6">
	<?php echo '<h1 class="blue-text mb-4 font-bold">' . $_SESSION['title'] . '</h1>'; ?>
	
</div>

<nav class="col-sm-4">
	<div class="btn-group-horizontal btn-group-sm" role="group" aria-label="Button Group">
		<button type="button" class="btn btn-secondary" onclick="location.href='logout.php'">Logout</button>
		<button type="button" class="btn btn-secondary" onclick="location.href='change-password.php'">New Password</button>
		<!-- <button type="button" class="btn btn-secondary" onclick="location.href='view-profile.php'">View profile</button> -->
		<button type="button" class="btn btn-secondary" onclick="location.href='view-assignments.php'">View Assignments</button>
		

	</div>	
</nav>