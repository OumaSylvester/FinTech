<?php
    try{
        //try connecting to the db
        require_once 'includes/constants.php';
        $user_id = $_SESSION['user_id'];
        $user_level= $_SESSION['user_level'];

        require 'includes/mysqli_connect.php';

        $page_rows = 5; //display 5 records per page
        //check if page accessed for the first time or not
        if(isset($_GET['s']) && is_numeric($_GET['s'])){
            //page not accessed for the first time
            $start = htmlspecialchars($_GET['s'], ENT_QUOTES);

        }else{
            //page accessed for the first time, hence start is the initial page
            $start = 0;
        }

        //Get the number of pages
        if(isset($_GET['p']) && is_numeric($_GET['p'])){
            $pages = htmlspecialchars($_GET['p']);
        }else{
            //Page accessed for the first time, calculate the total number of pages
            //Count records
            if($user_level == 2){
                $q = "SELECT count(billId) FROM bill WHERE employeeID = $user_id";
            }else{
                $q = "SELECT count(billId) FROM bill";
            }
            
            $result = mysqli_query($dbcon, $q);
            $row = mysqli_fetch_array($result, MYSQLI_NUM);

            //make sure its not executable XSS
            $record = htmlspecialchars($row[0], ENT_QUOTES);

            //calculate the number of pages
            if($record > $page_rows){
                $pages = ceil($record/$page_rows);
            }else{
                $pages = 1; 
            }

        }

        // Get the records and display them
         //Count records
         if($user_level == 2){
            //Finance employee can only view bill related to them
            $query = "SELECT billId, billImage, price, billingDate FROM bill WHERE employeeID = ? ORDER BY billingDate LIMIT ?, ?";
            $q = mysqli_stmt_init($dbcon);
            mysqli_stmt_prepare($q, $query);
            mysqli_stmt_bind_param($q, 'iii',$user_id, $start, $page_rows);

        }else{ 
            //Finace manager and the owner can views all bills
            $query = "SELECT billId, billImage, price, billingDate FROM bill ORDER BY billingDate LIMIT ?, ?";
            $q = mysqli_stmt_init($dbcon);
            mysqli_stmt_prepare($q, $query);
            mysqli_stmt_bind_param($q, 'ii', $start, $page_rows);

        }
        
        
        mysqli_stmt_execute($q);
        $result = mysqli_stmt_get_result($q);

        if($result){
            //If the query ran okay, display the records
            //Table header
            echo '<table class="table table-striped">
                <tr>
                    <th scope="col">Billing Image</th>
                    <th scope="col">Bill Price</th>
                    <th scope="col">Billing date</th>
                </tr>
            ';

            //Diplay the records
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                //remove  special characters that might already been in the table to reduce chances of XSS
                $billId = htmlspecialchars($row['billId'], ENT_QUOTES);
                $billImage = htmlspecialchars($row['billImage'], ENT_QUOTES);
                $price = htmlspecialchars($row['price'], ENT_QUOTES);
                $billingDate = htmlspecialchars($row['billingDate'], ENT_QUOTES);

                echo '<tr>
                    
                    <td><img src="'. IMAGES . $billImage. '" alt="Bill image"></td>
                    <td>' . $price . '</td>
                    <td>' . $billingDate . '</td>
                    
                    </tr>';
            }
            echo '</table>';
            mysqli_free_result($result);
        
        }else{
            //query did not run successfully
            //Error message:
			echo '<p class="error">The current users could not be retrieved. We apologize for any inconvience.';
			//Dubug message:
			//echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $query  . '</p>';
			exit();
        }

        
        //Get and dislay total projects count
        if($user_level == 2){
            $q = "SELECT count(billId) FROM bill WHERE employeeID = $user_id";
        }else{
            $q = "SELECT count(billId) FROM bill";
        }
        
        $result = mysqli_query($dbcon, $q);
        $row = mysqli_fetch_array($result, MYSQLI_NUM);

        $bills = htmlspecialchars($row[0], ENT_QUOTES);
        mysqli_close($dbcon);

        $echostring = '<p class="text-center">Number of Bills: ' . $bills . '</p>';
        $echostring .= '<p class="text-center">';

        //Check if we need pagination
        if($pages > 1){
            //we need the Previous and Next button
            $currrent_page = ($start/$page_rows) + 1;

            //set the right user page
            if($user_level == 2){
                $user_page = 'finance-employee.php';
            }else{
                $user_page = 'finance-manager.php';
            } 

            if($currrent_page > 1){
               
                $echostring .= '<a href="'. $user_page .'?s=' . ($start - $page_rows) . '&p='. $pages. '">Previous &nbsp;</a>';

            }
            if($currrent_page != $pages){
                //We are not in the last page
                $echostring .= '<a href="' .$user_page . '?s='  . ($start + $page_rows) . '&p=' . $pages . '">Next &nbsp;</a>';
            }
        }
        echo $echostring;

        
    }catch(Exception $e){
        print 'System busy please try later<br>';
        print 'Exception: ' . $e->getMessage() . '<br>';
    }catch(Error $e){
        print 'System busy please try later<br>';
        print 'Error: '. $e->getMessage() . '<br>';
    }
?>