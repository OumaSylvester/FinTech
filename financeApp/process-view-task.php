<?php
     if(isset($_SESSION['pid_view_task'])){
        $project_id = $_SESSION['pid_view_task'];
    }else{
        echo '<p style="color: red;">This page was accessed in error.</p>';
        header("Location: admin-page.php");
        exit();
    }
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
            $q = "SELECT count(task_id) FROM task WHERE project_id = $project_id";
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
        $query = "SELECT task_id, task_name, task_description, finished FROM task WHERE project_id = $project_id ORDER BY dateAdded LIMIT ?, ?";
        $q = mysqli_stmt_init($dbcon);
        mysqli_stmt_prepare($q, $query);
        mysqli_stmt_bind_param($q, 'ii', $start, $page_rows);

        mysqli_stmt_execute($q);
        $result = mysqli_stmt_get_result($q);

        if($result){
            //If the query ran okay, display the records
            //Table header
            //You can add edit, delete task for the project manager but that not in the requirement
            
                echo '<table class="table table-striped">
                <tr>
                    
                    
                    <th scope="col">Task Name</th>
                    <th scope="col">Task Description</th>
                    <th scope="col">Task State</th>
                    
                </tr>
            ';
            

            //Diplay the records
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                //remove  special characters that might already been in the table to reduce chances of XSS
                $task_id = htmlspecialchars($row['task_id'], ENT_QUOTES);
                $task_name = htmlspecialchars($row['task_name'], ENT_QUOTES);
                $task_desc = htmlspecialchars($row['task_description'], ENT_QUOTES);
                $finished = htmlspecialchars($row['finished'], ENT_QUOTES);

                if($finished == 0){
                    $state="Not complete";
                }else if($finished == 1){
                    $state = "Complete";
                }

                    echo '<tr>
                   
                    <td>'. $task_name . '</td>
                    <td>
                    ' . $task_desc . '</td>
                    <td>
                    ' . $state . '</td>
                    
                    </tr>';
               
                
            }
            echo '</table>';
            mysqli_free_result($result);
        
        }else{
            //query did not run successfully
            //Error message:
			echo '<p class="error">The current tasks could not be retrieved. We apologize for any inconvience.';
			//Dubug message:
			//echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $query  . '</p>';
			exit();
        }

        
        //Get and dislay total projects count
        $q = "SELECT COUNT(task_id) FROM task WHERE project_id= $project_id";
        $result = mysqli_query($dbcon, $q);
        $row = mysqli_fetch_array($result, MYSQLI_NUM);

        $tasks = htmlspecialchars($row[0], ENT_QUOTES);
        mysqli_close($dbcon);

        $echostring = '<p class="text-center">Total Task for this project: ' . $tasks . '</p>';
        $echostring .= '<p class="text-center">';

        //Check if we need pagination
        if($pages > 1){
            //we need the Previous and Next button
            $currrent_page = ($start/$page_rows) + 1;

            if($currrent_page > 1){
                $echostring .= '<a href="view-projects.php?s=' . ($start - $page_rows) . '&p='. $pages. '">Previous &nbsp;</a>';

            }
            if($currrent_page != $pages){
                //We are not in the last page
                $echostring .= '<a href="view-projects.php?s=' . ($start + $page_rows) . '&p=' . $pages . '">Next &nbsp;</a>';
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