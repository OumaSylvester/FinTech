<?php 
	/*This script is a query that INSERTS  a record in the users
	tabel*/

	//include the constants that contain the images path
	require_once 'includes/constants.php';
	//Check that form has been submitted:
	$errors = array(); //Initialize an error array.
	//Check for a first name:

	/*
	$title = filter_var( $_POST['title'], FILTER_SANITIZE_STRING);			                                
	if ((!empty($title)) && (preg_match('/[a-z\.\s]/i',$title)) &&(strlen($title) <= 12)) {
	//Sanitize the trimmed title		
		$title = $title;							
	}else{	
	$title = NULL; // Title is optional
	} */
	$first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	if(!empty($first_name) && (preg_match('/[a-z\s]/i', $first_name)) && (strlen($first_name) <= 30)){
		$first_name = $first_name;
	}else{
		$errors[] = "First name missing or not alphabetic and space characters. Max 30";
	}

	//Check for last name
	$last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	if(!empty($last_name) && (preg_match('/[a-z\s]/i', $last_name)) && (strlen($last_name) <= 40)){
		$last_name = $last_name;
	}else{
		$errors[] = "Last name missing or not alphabetic and space characters. Max 40";
	}

	//Check for email
	$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
	if(empty($email) || (!filter_var($email, FILTER_VALIDATE_EMAIL)) || (strlen($email)>60)){
		$errors[] = "You forgot to enter your email address";
		$errors[]='or the email format is incorrect.';
		}
	

	if(isset($_FILES['profile-pic'])){
		$profile_image = $_FILES['profile-pic']['name'];
		$profile_image_size = $_FILES['profile-pic']['size'];
		if($profile_image_size > 5120000){
			$errors[] = 'Image must be no more than 5MB';
		}
		//Check file upload type and size
		$allowed_types = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);
		$detected_type = exif_imagetype($_FILES['profile-pic']['tmp_name']);
	
		if(!in_array($detected_type, $allowed_types)){
			$errors[] = 'The image type must be a GIF, PNG,JPG, JPEG or PJPEG';
		}
	}else{
		$errors[] = 'You forgot to upload your profile picture';
	}
	

	//if(empty($profile_image)){
		//$errors[] = 'You forgot to upload your profile picture';
	//}

	

	$date_of_birth = $_POST['date_of_birth'];
	if(empty($date_of_birth)){
		$errors[] = "You forgi to enter your date of birth";
	}
	//Check for a password and match against the confirmed password
	$password1 = filter_var($_POST['password1'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	$string_length = strlen($password1);
	if(empty($password1))
	{
		$errors[]='Please enter a valid password';
	}
	else
	{
		if(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,12}$/' , $password1))
		{
			$errors[] = 'Invalid password ,8 to12 chars,1 upper,1 lower, 1 number,1 special.';
		}
	else
	{
		$password2 = filter_var($_POST['password2'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		if($password1 === $password2)
		{
			$password2 = $password1;
		}
		else{
			$errors[] = 'Your two passwords do not match.';
			$errors[] = 'Please try again';
		}
	}
	}
	
	//Check for an membership class
	/*
	if(isset($_POST['level'])){
		$class = filter_var($_POST['level'], FILTER_SANITIZE_STRING);
	}
	if(!empty($class) && (strlen($class) <= 3)){
		$class = filter_var($class, FILTER_SANITIZE_NUMBER_INT);
	}else{
		$errors[] = "Missing Level Selection.";
	}*/
	//Check for address1:
	$address1 = filter_var($_POST['address1'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	if(!(empty($address1)) && (preg_match('/[a-z0-9\.\s\,\-]/i', $address1)) && (strlen($address1) <=30)){
		$address1 = $address1;
	}else
	{
		$errors[] = 'missing address.Numeric, alphabetic , period ,comma,dash and space. Max 30.';
	}
	//Check for address2
	$address2 = filter_var($_POST['address2'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	if(!empty($address2) && (preg_match('/[a-z0-9\.\s\,\-]/i', $address2)) && (strlen($address2) <=30))
	{
		$address2 = $address2;
	}
	else
	{
		$address2 = NULL;
	}

	//Check for city
	$city = filter_var($_POST["city"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	if((!empty($city)) && (preg_match('/[a-z\.\s]/i',$city)) && (strlen($city) <=30))
	{
		$city = $city;
	}
	else
	{
		$errors[]= 'Missing city.Only alphabetic ,peeriod and space.max30';
	}

	//Check for the country
	$state_country = filter_var($_POST["state_country"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	if(!empty($state_country)  && (preg_match('/[a-z\.\s]/i',$state_country)) && (strlen($state_country) <=30))
	{
		$state_country = $state_country;
	}
	else
	{
		$errors[] = 'Missing state/country.';
	}
	//Check from post code
	$zcode_pcode = filter_var($_POST["zcode_pcode"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	$string_length = strlen($zcode_pcode);
	if(!empty($zcode_pcode) && (preg_match('/[a-z0-9\s]/i', $zcode_pcode)) && (strlen($zcode_pcode) <=30) && (strlen($zcode_pcode) >=5))
	{
		$zcode_pcode = $zcode_pcode;
	}
	else
	{
		$errors[] = 'Missing zip code or post code';
	}
	//Check for the phone number 
	$phone = filter_var($_POST['phone'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	if(!empty($phone) && (strlen($phone) <= 30))
	{
		$phone = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
		$phone = preg_replace('/[^0-9]/', '', $phone);
	}else{
		$phone = NULL;
	}


	$secret = filter_var( $_POST['secret'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);		
	if ((!empty($secret)) && (preg_match('/[a-z\.\s\,\-]/i', $secret)) &&(strlen($secret) <= 30)) {					
		//Sanitize the trimmed city	
		$secret = $secret;					
	}else{	
		$errors[] = 'Missing secret answer. Only alphabetic, period, comma, dash and space. Max 30.';
	}

	if(empty($errors)){ //If everything is okay
		//check if there were no errors in  uploadin the file
		if($_FILES['profile-pic']['error'] == 0){
			//ensure the file has a unique name
			$unique = time() . '_' . $profile_image;
			//new location of the file 
			$target = IMAGES . 'profile/'. $unique;
			//try move the file from the temporary location
			if(move_uploaded_file($_FILES['profile-pic']['tmp_name'], $target)){
				//if moving was success. register user
				try{
					//Determine wether the email email address has already been registered
					require 'includes/mysqli_connect.php'; //connect to the db
					
		
					$query = "SELECT user_id  FROM users WHERE email = ?";
					$q = mysqli_stmt_init($dbcon);
					mysqli_stmt_prepare($q, $query);
					mysqli_stmt_bind_param($q, 's', $email);
					mysqli_stmt_execute($q);
					$result = mysqli_stmt_get_result($q);
					if(mysqli_num_rows($result) ==  0){
						//The email address has not been registered 
		
						//Register the user in the database...
						//Hash password current 60 characters but can increase
						$hashed_passcode = password_hash($password1, PASSWORD_DEFAULT);
						//require 'mysqli_connect.php'; //connect to the db
						//Make the query:
						$query = "INSERT INTO users (user_id, first_name, last_name, email, profile_pic, date_of_birth, password, address1, address2, city, state_country, zcode_pcode, phone, secret, registration_date) VALUES(' ',?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW()) ";
		
		
						$q = mysqli_stmt_init($dbcon);
						//Use prepared statement to ensure that only text is inserted
						mysqli_stmt_prepare($q, $query);
						
						//bind fields to SQL Statement
						mysqli_stmt_bind_param($q, 'sssssssssssss', $first_name, $last_name, $email, $unique, $date_of_birth, $hashed_passcode, $address1, $address2, $city, $state_country, $zcode_pcode, $phone, $secret);
						//param must include four variables to match the four s parameters
		
						//execute query
						mysqli_stmt_execute($q);
						if(mysqli_stmt_affected_rows($q) ==1){
							header("Location: login.php");//?class=$class" . $class); // a redirection
							exit();
						}else{ //if it did not run OK. No Redirection. User still on the register-page.php
							//Public message:
							$errorstring ='System Error<br />You could not be registered due to a system error. We apologize for any incovinience';
							echo '<p class="text-center col-sm-2" style="color: red;">' . $errorstring . '</p>'; 
		
							//Debugging message below do not use in production
							//echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' .$query . '</p>';
							//Close the database connection.
							mysqli_close($dbcon);
		
							//include footer then close program to stop execution
							/*echo '<footer class="jumbotron text-center col-sm-12" style="padding-bottom:1px; padding-top:8px;">';
							 include("footer.php");
							 echo '</footer>';*/
							exit();
						}
					}else{//The email adddress is already registered
						$errorstring = "The email address is already registered.";
						echo '<p class="text-center col-sm-2" style="color:red;">' . $errorstring;
		
					}
				}
				catch(Exception $e) //We finally handle any problems here. Systems errors
				{
					print "An Exception occurred. Message: " . $e->getMessage() . '<br>';//for debugging purposes only
					print "The system is busy please try again later";
				}
				catch(Error $e)
				{
					print "An error occured. Message: " .$e->getMessage() . '<br>'; //for debugging purposes only
					print "The system is busy please try again later.";
				}

			}else{
				//if moving the file from temporary folder  was a failure
				echo '<p class="text-center col-sm-2" style="color: red">There was a problem uploding your file.</p>'; 
			}
		}else{
			//if the file could not be upload from the remote client
			echo '<p class="text-center col-sm-2" style="color: red">There was a problem uploding your file.</p>';
		}
		
	}
	else{//Report the errors. >> User errors
		$errorstring = "Error! The following error(s) occured: <br>";
		foreach ($errors as $msg) {//Print each error.
			$errorstring .= " - $msg<br>";
		}
		$errorstring .= "Please try again.<br>";
		echo '<p class="text-center col-sm-2" style="color: red">' . $errorstring . '</p>';
	}//End of if (empty($errors)) IF.

 ?>