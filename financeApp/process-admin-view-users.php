<?php 
	try{
		//This script retireves all the records from the users table
		$user_level = $_SESSION['user_level']; //Check which user is viewing the users table
		require ('includes/mysqli_connect.php');
		//Set the number per dispaly page
		$pagerows = 10;
		//Has the total number of pages already been calculated?
		if(isset($_GET['p']) && is_numeric($_GET['p']))
		{
			//already been calculated
			//Make sure it is not executable XSS
			$pages = htmlspecialchars($_GET['p'], ENT_QUOTES);
		}
		else{
			//use the next block of code to calculate the number of pages
			//First check for the total number of records
			if($user_level == 1){
				$q = "SELECT count(user_id) FROM users WHERE user_level = 0";
			}else if($user_level == 3){
				$q = "SELECT count(user_id) FROM users WHERE user_level < 3";
			}else{
				$q = "SELECT count(user_id) FROM users";
			}
			$result = mysqli_query($dbcon, $q);
			$row = mysqli_fetch_array($result, MYSQLI_NUM);
			//Make sure it is not EXECUTABLE XSS
			$records = htmlspecialchars($row[0], ENT_QUOTES);

			//Now calculate the number of pages
			if($records > $pagerows)
			{
				//If number of records will feel more than one page
				//Calculate the number of pages and round up the number
				// to the nearest integer
				$pages = ceil($records/$pagerows);
			}
			else{
				$pages = 1;
			}

		}//page check finished
		//Declare which record to start with
		if(isset($_GET['s']) && is_numeric($_GET['s']))
		{
			//Make sure it is not executable XSS
			$start = htmlspecialchars($_GET['s'], ENT_QUOTES);
		}else{
			$start = 0;
		}

		if($user_level == 1){
			$query = "SELECT last_name, first_name, email, DATE_FORMAT(registration_date, '%M %d, %Y') AS regdat, user_id FROM users WHERE user_level = 0 ORDER BY registration_date DESC LIMIT ?, ?";
		}else if($user_level == 3){
			$query = "SELECT last_name, first_name, email, DATE_FORMAT(registration_date, '%M %d, %Y') AS regdat, user_id FROM users WHERE user_level < 3 ORDER BY registration_date DESC LIMIT ?, ?";
		}else{
			$query = "SELECT last_name, first_name, email, DATE_FORMAT(registration_date, '%M %d, %Y') AS regdat, user_id FROM users ORDER BY registration_date DESC LIMIT ?, ?";
		}
		
		$q = mysqli_stmt_init($dbcon);
		mysqli_stmt_prepare($q, $query);
		mysqli_stmt_bind_param($q, 'ii', $start, $pagerows);
		//Execute query
		mysqli_stmt_execute($q);

		$result = mysqli_stmt_get_result($q);
		if($result){//If it ran OK, display the records
			//Table header.
			if($user_level == 4){
				//admin can view all users but not change anything
				echo '<table class="table table-striped table-bordered">
				<tr>
				
				<th scope="col">Last Name</th>
				<th scope="col">First Name</th>
				<th scope="col">Email</th>
				<th scope="col">Date Registered</th>
						
				</tr>';
			}else if($user_level == 3){
				//finance manager does not assign work
				echo '<table class="table table-striped">
				<tr>
				<th scope="col">Edit</th>
				<th scope="col">Delete</th>
				
				<th scope="col">Last Name</th>
				<th scope="col">First Name</th>
				<th scope="col">Email</th>
				<th scope="col">Date Registered</th>
						
				</tr>';
			}else{
				//project manager can edit, delete and assign work to project employees
				echo '<table class="table table-striped">
				<tr>
				<th scope="col">Edit</th>
				<th scope="col">Delete</th>
				<th scope="col">Assign</th>
				<th scope="col">Last Name</th>
				<th scope="col">First Name</th>
				<th scope="col">Email</th>
				<th scope="col">Date Registered</th>
						
				</tr>';
			}
			
			//Fetch and print all the records:
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
				//Remove special charcters that might already be in the table to reduce the chance of XSS exploits
				$user_id = htmlspecialchars($row['user_id'], ENT_QUOTES);
				$last_name = htmlspecialchars($row['last_name'], ENT_QUOTES);
				$first_name = htmlspecialchars($row['first_name'], ENT_QUOTES);
				$email = htmlspecialchars($row['email'], ENT_QUOTES);
				$registration_date = htmlspecialchars($row['regdat'], ENT_QUOTES);
				
				if($user_level == 4){
					echo '<tr>';

				echo '<td>' . $last_name .'</td>
				<td>' . $first_name . '</td>
				<td>' . $email . '</td>
				<td>' . $registration_date . '</td>
				
			

				</tr>';
				}else if($user_level == 3){
					echo '<tr>

				<td><a href="edit-record.php?id='. $user_id .'">Edit</a></td>
				<td><a href="delete-record.php?id=' . $user_id . '">Delete</a></td>
				';

				echo '<td>' . $last_name .'</td>
				<td>' . $first_name . '</td>
				<td>' . $email . '</td>
				<td>' . $registration_date . '</td>
				
			

				</tr>';
				}else{
					echo '<tr>

				<td><a href="edit-record.php?id='. $user_id .'">Edit</a></td>
				<td><a href="delete-record.php?id=' . $user_id . '">Delete</a></td>
				<td><a href="assign-work.php?eid=' . $user_id . '">Assign Work</a></td>';

				echo '<td>' . $last_name .'</td>
				<td>' . $first_name . '</td>
				<td>' . $email . '</td>
				<td>' . $registration_date . '</td>
				
			

				</tr>';
				
				}
				
			}
			echo '</table>'; //close table
			mysqli_free_result($result); //Free up the resources .

		}else{//If it did not run OK.
			//Error message:
			echo '<p class="error">The current users could not be retrieved. We apologize for any inconvience.';
			//Dubug message:
			//echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $query  . '</p>';
			exit();
		}//End of else ($result)
		//Now display the total number of records/members
		if($user_level == 1){
			$q = "SELECT count(user_id) FROM users WHERE user_level = 0";
		}else if($user_level == 3){
			$q = "SELECT count(user_id) FROM users WHERE user_level < 3";
		}else{
			$q = "SELECT count(user_id) FROM users";
		}
		
		$result = mysqli_query($dbcon, $q);
		$row = mysqli_fetch_array($result);
		$members = htmlspecialchars($row[0], ENT_QUOTES);
		mysqli_close($dbcon); //close the database connection
		$echostring = '<p class="text-center">Total Employees: ' . $members . '</p>';  
		//Display the next  the previous button
		$echostring .= '<p class="text-center">';
		if($pages > 1)
		{
			//What number is the current page
			$current_page = ($start/$pagerows) + 1;
			//If the page is not the first page
			if($current_page != 1)
			{
				$echostring .= '<a href="admin-view-users.php?s=' . ($start - $pagerows) . '&p=' . $pages . '">Previous &nbsp;</a>';
			}

			//Create a next link
			if($current_page != $pages)
			{
				$echostring .= '<a href="admin-view-users.php?s=' . ($start + $pagerows) . '&p=' . $pages . '">&nbsp;Next</a>';
			}
			$echostring .= '</p>';
			echo $echostring;
		}
	}
	catch(Exception $e)//We finally handle any problems
	{
		//print 'An Exception occured. Message: ' .$e->getMessage() .'<br>';
		print 'The system is busy please try later';
	}
	catch(Error $e)
	{
		
		//print 'An Error occured. Message: ' . $e->getMessage() . '<br>';
		print 'The system is busy try again later.';
		//Todo:Research>> How can handle warnings in php to stop them from being dipalyed on the browser
	}
?>