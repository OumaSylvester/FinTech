<div class="col-sm-2">
	<!-- <img src="logo.jpg" class="img-fluid float-left" alt="Logo">	 -->
    <div class="profile-details">
        <?php echo '<img src="images/profile/' . $_SESSION['profile_pic'] . '" alt="Profile Picture" class="profile-pic" style="width: 30%;">';
            echo '<h2 class="profile-name" class="h2">' . $_SESSION['user_name'] . '</h2>';
        ?>
	</div>
</div>

<div class="col-sm-6">
	<h1 class="blue-text mb-4 font-bold">My Profile</h1>
</div>

