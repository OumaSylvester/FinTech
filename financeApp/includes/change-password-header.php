<div class="col-sm-2">
	<!-- <img src="logo.png" class="img-fluid float-left" alt="Logo">	 -->
</div>

<div class="col-sm-8">
	<h1 class="blue-text mb-4 font-bold">Change your password</h1>
</div>

<nav class="col-sm-2">
	<div class="btn-group-horizontal btn-group-sm" role="group" aria-label="Button Group">
		<button type="button" class="btn btn-secondary" onclick="location.href='change-password.php'">Erase Entries</button>
		<button type="button" class="btn btn-secondary" onclick="location.href='<?php 
		if($_SESSION['user_level'] == 0) echo 'members-page.php';
           else if($_SESSION['user_level'] == 1) echo 'admin-page.php';
           else if($_SESSION['user_level'] == 2) echo 'finance-employee.php';
           else if($_SESSION['user_level'] == 3) echo 'finance-manager.php';
           else if($_SESSION['user_level'] == 4) echo 'owner.php';
		?>'">Cancel</button>
	</div>	
</nav>