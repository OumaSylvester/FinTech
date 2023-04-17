<div class="col-sm-2">
	<!-- <img src="logo.png" class="img-fluid float-left">	 -->
	<div class="profile-details">
        <?php echo '<img src="images/profile/' . $_SESSION['profile_pic'] . '" alt="Profile Picture" class="profile-pic" style="width: 30%;">';
            echo '<h2 class="profile-name" class="h2">' . $_SESSION['user_name'] . '</h2>';
        ?>
	</div>
	
</div>

<div class="col-sm-4">
	<h1 class="blue-text mb-4 font-bold">Project Manager</h1>

</div>

<nav class="col-sm-6">
	<div class="btn-group-horizontal btn-gropu-sm" role="group" aria-label="Button Group">
		<button type="button" class="btn btn-secondary" onclick="location.href='logout.php'">Logout</button>
		<button type="button" class="btn btn-secondary" onclick="location.href='admin-view-users.php'">View Members</button>
		<button type="button" class="btn btn-secondary" onclick="location.href='search.php'">Search</button>
		<button type="button" class="btn btn-secondary" onclick="location.href='search-address.php'">Address</button>
		<button type="button" class="btn btn-secondary" onclick="location.href='change-password.php'">New Password</button>
		<!-- <button type="button" class="btn btn-secondary" onclick="location.href='view-work.php'">View Work</button> -->
		<button type="button" class="btn btn-secondary" onclick="location.href='request-budget.php'">Request Budget</button>
		<!-- <button type="button" class="btn btn-secondary" onclick="location.href='view-projects.php'">View Projects</button> -->

	</div>
</nav>