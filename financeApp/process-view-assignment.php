<?php
    try{
        //try connecting to the db
        $employeeId = $_SESSION['user_id'];
        $user_level = $_SESSION['user_level'];
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
            if($user_level == 0){
                $q = "SELECT count(projectID) FROM work WHERE employeeId = $employeeId";
            }else{
                $q = "SELECT count(projectID) FROM work";
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

        //Get projects assigned to this employee and display them
        if($user_level == 0){
            //project employees can only view projects assigned to them
            $q = "SELECT  projectID FROM work WHERE employeeID = $employeeId";
        }else{
            //Owner, finance manager, Project manager can view all the assignments
            $q = "SELECT  DISTINCT(projectID) FROM work ";
        }
        
        $projects = mysqli_query($dbcon, $q);

        $display_table_head = true;
        
        if($projects){
            while($project = mysqli_fetch_array($projects, MYSQLI_NUM)){
                $projectId = $project[0];
                // Get the records and display them
                $query = "SELECT projectId, projectName, projectClassification FROM project WHERE projectId = ?";
                $q1 = mysqli_stmt_init($dbcon);
                mysqli_stmt_prepare($q1, $query);
                mysqli_stmt_bind_param($q1, 'i', $projectId);

                mysqli_stmt_execute($q1);
                $result = mysqli_stmt_get_result($q1);

                if($result){
                    //If the query ran okay, display the records
                    //Table header
                    if($display_table_head){
                        if($user_level == 0){
                            echo '<table class="table table-striped">
                        <tr>
                            <th scope="col">Project Name</th>
                            <th scope="col">Project Classification</th>
                            <th scope="col">View Tasks</th>
                            
                        </tr>';
                        }else{
                            echo '<table class="table table-striped">
                        <tr>
                            <th scope="col">Employee Name</th>
                            <th scope="col">Project Name</th>
                            <th scope="col">Project Classification</th>
                            <th scope="col">View Tasks</th>
                            
                        </tr>';
                        }
                        
                    $display_table_head = false;
                    }
                    

                //Diplay the records
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                //remove  special characters that might already been in the table to reduce chances of XSS
                //$project_id = htmlspecialchars($row['projectId'], ENT_QUOTES);
                $project_name = htmlspecialchars($row['projectName'], ENT_QUOTES);
                $project_class = htmlspecialchars($row['projectClassification'], ENT_QUOTES);
                
                //add the project rows
                if($user_level == 0){
                    echo '<tr>
                    
                    <td>' . $project_name . '</td>
                    <td>' . $project_class . '</td>       
                    <td><a href="view-task.php?pid=' . $projectId .'">View Tasks</a></td>               
                    
                    </tr>';
                }else{
                    
                    $q2 = "SELECT employeeID FROM work WHERE projectID = $projectId";
                    $employee_result = mysqli_query($dbcon, $q2);
                    if($employee_result){
                        while($employee = mysqli_fetch_array($employee_result, MYSQLI_NUM)){
                            $employeeId = $employee[0];
                            //get the employee and display
                            $q2 = "SELECT first_name, last_name FROM users WHERE user_id = $employeeId"; //Get the name of the user
                            $employee_names_result = mysqli_query($dbcon, $q2);
                            if($names = mysqli_fetch_array($employee_names_result, MYSQLI_NUM)){
                                $first_name = $names[0];
                                $last_name = $names[1];
                                echo '<tr>
                                <td>' . $first_name . ' ' . $last_name . '</td>
                                <td>' . $project_name . '</td>
                                <td>' . $project_class . '</td>
                                <td><a href="view-task.php?pid=' . $projectId .'">View Tasks</a></td>                        
                                
                                </tr>';
                            }else{
                                //employee name could not be retrived because of the db error
                                echo '<p class="error">The employee could not be retrieved. We apologize for any inconvience.';
                                //Dubug message:
                                //echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $query  . '</p>';
                                exit();
                            }
                        }
                    }
                    
                }                
            
            }else{
                //query did not run successfully
                //Error message:
                echo '<p class="error">The  project name and classification could not be retrieved. We apologize for any inconvience.';
                //Dubug message:
                //echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $query  . '</p>';
                exit();
            }

        }
        echo '</table>';
        mysqli_free_result($result);
        }else{
            //query did not run successfully
            //Error message:
            echo '<p class="error">Work assignments could not be retrieved. We apologize for any inconvience.';
            //Dubug message:
            //echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $query  . '</p>';
            exit();
        
        }
            
        //Get and dislay total projects count
        if($user_level == 0){
            $q = "SELECT count(projectID) FROM work WHERE employeeId = $employeeId";
        }else{
            $q = "SELECT count(projectID) FROM work";
        }
    
        $result = mysqli_query($dbcon, $q);
        $row = mysqli_fetch_array($result, MYSQLI_NUM);

        $projects = htmlspecialchars($row[0], ENT_QUOTES);
        mysqli_close($dbcon);

        $echostring = '<p class="text-center">Total Assignments: ' . $projects . '</p>';
        $echostring .= '<p class="text-center">';

        //Check if we need pagination
        if($pages > 1){
            //we need the Previous and Next button
            $currrent_page = ($start/$page_rows) + 1;

            if($currrent_page > 1){
                $echostring .= '<a href="view-assignments.php?s=' . ($start - $page_rows) . '&p='. $pages. '">Previous &nbsp;</a>';

            }
            if($currrent_page != $pages){
                //We are not in the last page
                $echostring .= '<a href="view-assignments.php?s=' . ($start + $page_rows) . '&p=' . $pages . '">Next &nbsp;</a>';
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