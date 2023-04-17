<?php
	try{
		//After clicking the link in the found-record.php/admin-view-users.php
		//this code is executed
		//The code looks for a valid user ID through GET or POST
		if(isset($_GET['id']) && is_numeric($_GET['id']))
		{
			//From view-users.php/found-record.php
			$id  = htmlspecialchars($_GET['id'], ENT_QUOTES);

		}elseif (isset($_POST['id']) && is_numeric($_POST['id'])) {
			//Form submmission
			$id = htmlspecialchars($_POST['id'], ENT_QUOTES);
		}else{
			//No Valid id kill the script
			echo '<p class="text-center">This page has been accessed in error. </p>';
			include 'includes/footer.php';
			exit();
		}

		require('includes/mysqli_connect.php');
		//Has the form been submitted?
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$errors = array();
			//Look for the first name
			$first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_STRING);
			if(empty($first_name))
			{
				$errors[] = "You forgot to enter your first name";
			}

			$last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_STRING);
			if(empty($last_name))
			{
				$errors[] = "You forgot to enter your last name";
			}

			$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
			if(empty($email) || (!filter_var($email, FILTER_VALIDATE_EMAIL))){
				$errors[] = "You forgot to enter your email address or the email format is invalid";
			}

			$address1 = filter_var($_POST['address1'], FILTER_SANITIZE_STRING);
			if((!empty($address1)) && (preg_match('/[a-z0-9\.\s\,\-]/i',$address1))&& (strlen($address1) <= 30 )) 
            {
                //sanitize trimmed address
                $address1trim = $address1;
            }
            else
            {
				$address1trim = NULL;
			}

			$address2 = filter_var($_POST['address2'], FILTER_SANITIZE_STRING);
			if((!empty($address2)) && (preg_match('/[a-z0-9\.\s\,\-]/i',$address2))&& (strlen($address2) <= 30 )) 
			{
                $address2trim =$address2;
			}
            else
            {
                $address2trim = NULL;
            }

			$city = filter_var($_POST['city'], FILTER_SANITIZE_STRING);
			if((!empty($city)) && (preg_match('/[a-z\.\s]/i',$city))&& (strlen($city) <= 30 )) 
			{
				$city = $city;
			}
            else
            {
                $errors[] = 'missing city.only alphabets,period and space.max30';
            }

			$state_country = filter_var($_POST['state_country'], FILTER_SANITIZE_STRING);
			if((!empty($state_country)) && (preg_match('/[a-z\.\s]/i',$state_country))&& (strlen($state_country) <= 30 )) 
			{
				$state_country = $state_country;
			}
            else
            {
                $errors[] = 'missing state/country.only alphabets,period and space.max30';
            }

            //is zip code present?
            $zcode_pcode = filter_var($_POST['zcode_pcode'], FILTER_SANITIZE_STRING);
			if((!empty($zcode_pcode)) && (preg_match('/[a-z0-9\s]/i',$zcode_pcode))&& (strlen($zcode_pcode) <= 30)&&(strlen($zcode_pcode) >=5)) 
			{
				$zcode_pcode = $zcode_pcode;
			}
            else
            {
                $errors[] = 'missing zip-post code.only Allphabetic, numeric, space.Max 30 characters';
            }
            //Is the phone number present? If it is, sanitize it
            $phone = filter_var( $_POST['phone'], FILTER_SANITIZE_STRING);
            if ((!empty($phone)) && (strlen($phone) <= 30)) {
                //Sanitize the trimmed phone number
                $phonetrim = (filter_var($phone, FILTER_SANITIZE_NUMBER_INT));
                $phonetrim = preg_replace('/[^0-9]/', '', $phonetrim);
            }else{
                $phone = NULL;
            }

            $date_of_birth = $_POST['date_of_birth'];

            if(empty($date_of_birth)){
                $errors[] = "You forgot to enter your date of birth";
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

			if(empty($errors)){//All data entered by the admin was valid
				$query = "SELECT user_id FROM users WHERE email=? AND user_id!=?";
				$q = mysqli_stmt_init($dbcon);
				mysqli_stmt_prepare($q, $query);
				mysqli_stmt_bind_param($q, 'si', $email, $id);
				mysqli_stmt_execute($q);

				$result = mysqli_stmt_get_result($q);
				if(mysqli_num_rows($result) == 0){
					//email does not exists in a another record
                    if($_FILES['profile-pic']['error'] == 0){
                        //ensure the file has a unique name
                        $unique = time() . '_' . $profile_image;
                        //new location of the file 
                        $target = IMAGES . 'profile/'. $unique;
                        //try move the file from the temporary location
                        if(move_uploaded_file($_FILES['profile-pic']['tmp_name'], $target)){
                            //if moving was success. register user
                            //The update query. Make changes to the database
                            $query = "UPDATE  users SET first_name=?, last_name=?, email=?, profile_pic=?, phone=? date_of_birth=?, address1=?, address2=?, city=?, state_country=?, zcode_pcode=? WHERE user_id=? LIMIT 1";
                            //bind values to sql statements
                            $q = mysqli_stmt_init($dbcon);
                            mysqli_stmt_prepare($q, $query);
                            mysqli_stmt_bind_param($q, 'sssssssssssi', $first_name, $last_name, $email, $profile_image, $phone, $date_of_birth, $address1, $address2, $city, $state_country,$zcode_pcode, $id);
                            mysqli_stmt_execute($q);

                            if(mysqli_stmt_affected_rows($q) == 1){
                                //update OK. echo a message if the edit was satisfactory
                                echo '<p class="text-center">The user has been edited</p>';
                                //add a 5 seconds wait before redirection to the admin-view-users.php
                                //sleep(10);
                                header("Location: view-profile.php");
                               exit();
                            }else{
                                //echo a message if the query failed
                                echo '<p class="text-center">The user was not edited.</p>';
                                //There is a bug if  the admin clicks the edit link and changes nothing. No row is affected hence this error message is displayed. 
                                //The error could also be due to sql query errors
                                //Debug message

                                //echo '<br><p>' . mysqli_error($dbcon) . '<br>Query: ' . $query . '</p>';
                            }
                        }else{
                            //if moving the file from temporary folder  was a failure
                            echo '<p class="text-center col-sm-2" style="color: red">There was a problem uploding your file.</p>'; 
                        }
                    }else{
                        //if moving the file from temporary folder  was a failure
                        echo '<p class="text-center col-sm-2" style="color: red">There was a problem uploding your file.</p>'; 
                    }
				}else{
					//Already registered email
					echo '<p class="text-center">Email address has already been registered</p>';
				}
			}else{
				//An error occured in the data entered. Display the errors
				echo '<p class="text-center">The following error(s) occured: <br>';
				foreach($errors as $msg){
					//echo each error
					echo " - $msg <br>";
				}
				echo 'Please try again';
			}//end if empty($errors)

		}//end if POST
		else{
		//Select the user's information to display in the text boxes
		$query = "SELECT first_name, last_name,email, profile_pic, phone, date_of_birth, address1, address2, city, state_country, zcode_pcode FROM users WHERE user_id=?";
		$q = mysqli_stmt_init($dbcon);
		mysqli_stmt_prepare($q, $query);
		mysqli_stmt_bind_param($q, "i", $id);
		mysqli_stmt_execute($q);

		$result = mysqli_stmt_get_result($q);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

		if(mysqli_num_rows($result) == 1){
			//valid user ID display the form
			//Get the users information
			//Create the form
		
?>
			<h2 class="h2">Edit Your profile</h2>
			<form action="edit-record.php" method="post" name="edit_form" id="edit_form">
				<div class="form-group row">
					<label for="first_name" class="col-sm-4 col-form-label">First Name:</label>
					<div class="col-sm-8">
						<input class= "form-control" type="text" name="first_name" id="first_name" required placeholder="First Name" maxlength="30" value="<?php echo htmlspecialchars($row['first_name'], ENT_QUOTES); ?>">
					</div>
				</div>

				<div class="form-group row">
					<label for="last_name" class="col-sm-4 col-form-label">Last Name:</label>
					<div class="col-sm-8">
						<input type="text" name="last_name" id="last_name"class="form-control" required placeholder="Last Name" maxlength="40" value="<?php echo htmlspecialchars($row['last_name'], ENT_QUOTES); ?>">
					</div>			
				</div>

				<div class="form-group row">
					<label for="email" class="col-sm-4 col-form-label">Email:</label>
					<div class="col-sm-8">
						<input type="text" name="email" id="email"class="form-control" required placeholder="E-mail" maxlength="60" value="<?php echo htmlspecialchars($row['email'], ENT_QUOTES); ?>">
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
                    <label for="address1" class="col-sm-4 col-form-label text-right">Address*:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="address1" name="address1" 
                    pattern="[a-zA-Z0-9][a-zA-Z0-9\s\.\,\-]*" 
                    title="Alphabetic, numbers, period, comma, dash and space only max of 30 characters" 
                    placeholder="Address" maxlength="30" required
                    value=
                        "<?php if (isset($row['address1'])) 
                        echo htmlspecialchars($row['address1'], ENT_QUOTES); ?>" >
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
                        "<?php if (isset($row['address2'])) 
                        echo htmlspecialchars($row['address2'], ENT_QUOTES); ?>" >
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
                        "<?php if (isset($row['city'])) 
                        echo htmlspecialchars($row['city'], ENT_QUOTES); ?>" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="state_country" class="col-sm-4 col-form-label text-right">
                    Country/state*:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="state_country" name="state_country"
                    pattern="[a-zA-Z][a-zA-Z\s\.]*" 
                    title="Alphabetic, period and space only max of 30 characters" 
                    placeholder="State or Country" maxlength="30" required
                    value=
                        "<?php if (isset($row['state_country'])) 
                        echo htmlspecialchars($row['state_country'], ENT_QUOTES); ?>" >
                    </div>
                </div>	
                <div class="form-group row">
                    <label for="zcode_pcode" class="col-sm-4 col-form-label text-right">
                    Zip/Postal Code*:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="zcode_pcode" name="zcode_pcode" 
                    pattern="[a-zA-Z0-9][a-zA-Z0-9\s]*" 
                    title="Alphabetic, period and space only max of 30 characters" 
                    placeholder="Zip or Postal Code" minlength="5" maxlength="30" required
                    value=
                        "<?php if (isset($row['zcode_pcode'])) 
                        echo htmlspecialchars($row['zcode_pcode'], ENT_QUOTES); ?>" >
                    </div>
                </div>		
                <div class="form-group row">
                    <label for="phone" class="col-sm-4 col-form-label text-right">Telephone:</label>
                    <div class="col-sm-8">
                    <input type="tel" class="form-control" id="phone" name="phone" 
                    placeholder="Phone Number" maxlength="30"
                    value=
                        "<?php if (isset($row['phone'])) 
                        echo htmlspecialchars($row['phone'], ENT_QUOTES); ?>" >
                    </div>
                </div>  


				<input type="hidden" name="id" value="<?php echo $id ?>">

				<div class="form-group row">
					<label for="" class="col-sm-4 col-form-label"></label>
					<div class="col-sm-4" style="margin-top: 0.5em">
						<input type="submit" name="submit" id="submit" value="Confirm" class="btn btn-primary">
					</div>
					
				</div>
				<!--add space btwn submit button and last input field -->
			</form>
<?php 
		}else{//The user could not be validated
			echo '<p class="text-center">The page has been accessed in error.</p>';
		}
		//Free results and close the database connection
		mysqli_stmt_free_result($q);
		mysqli_close($dbcon);
	}// GET request 

	}//end try
	catch(Exception $e){
		print 'The system is busy please try again later<br>';
		print 'An Exception occured. Message: ' . $e->getMessage(). '<br>';
	}
	catch(Error $e){
		print 'The system is busy please try again later<br>';
		print 'An error occured. Message: ' . $e->getMessage() . '<br>';
	}
?>