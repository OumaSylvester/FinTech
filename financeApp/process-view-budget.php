<?php
    try{
        //try connecting to the db
        
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
            $q = "SELECT count(budgetID) FROM budget";
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
        $query = "SELECT * FROM budget ORDER BY dateRequested LIMIT ?, ?";
        $q = mysqli_stmt_init($dbcon);
        mysqli_stmt_prepare($q, $query);
        mysqli_stmt_bind_param($q, 'ii', $start, $page_rows);

        mysqli_stmt_execute($q);
        $result = mysqli_stmt_get_result($q);

        if($result){
            //If the query ran okay, display the records
            //Table header
            echo '<table class="table table-striped">
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Budget Amount</th>
                    <th scope="col">Budget Description</th>
                    <th scope="col">Approved</th>
                    <th scope="col">Date Requested</th>
                    
                </tr>
            ';

            //Diplay the records
            
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                //remove  special characters that might already been in the table to reduce chances of XSS
                $budgetId = htmlspecialchars($row['budgetID'], ENT_QUOTES);
                $projectManagerId = htmlspecialchars($row['projectManagerID'], ENT_QUOTES);
                $amount = htmlspecialchars($row['amount'], ENT_QUOTES);
                $budgetDescription = htmlspecialchars($row['budgetDescription'], ENT_QUOTES);
                $approved = htmlspecialchars($row['approved'], ENT_QUOTES);
                $dateRequested = htmlspecialchars($row['dateRequested'], ENT_QUOTES);

                //Check to show the approve command or not
                if($approved == 'yes'){
                    echo '<tr>
                    <td></td>
                    <td>' . $amount . '</td>
                    <td>' . $budgetDescription . '</td>
                    <td>' . $approved . '</td>
                    <td>' . $dateRequested . '</td>
                    
                    </tr>';
                }else{
                    echo '<tr>
                    <td><a href="process-approve-budget.php">Approve</td>
                    <td>' . $amount . '</td>
                    <td>' . $budgetDescription . '</td>
                    <td>No</td>
                    <td>' . $dateRequested . '</td>
                    
                    </tr>';
                    $_SESSION['bid'] = $budgetId;
                }
                
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
        $q = "SELECT COUNT(budgetID) FROM budget";
        $result = mysqli_query($dbcon, $q);
        $row = mysqli_fetch_array($result, MYSQLI_NUM);

        $projects = htmlspecialchars($row[0], ENT_QUOTES);
        mysqli_close($dbcon);

        $echostring = '<p class="text-center">Total Projects: ' . $projects . '</p>';
        $echostring .= '<p class="text-center">';

        //Check if we need pagination
        if($pages > 1){
            //we need the Previous and Next button
            $currrent_page = ($start/$page_rows) + 1;

            if($currrent_page > 1){
                $echostring .= '<a href="approve-budget.php?s=' . ($start - $page_rows) . '&p='. $pages. '">Previous &nbsp;</a>';

            }
            if($currrent_page != $pages){
                //We are not in the last page
                $echostring .= '<a href="approve-budget.php?s=' . ($start + $page_rows) . '&p=' . $pages . '">Next &nbsp;</a>';
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