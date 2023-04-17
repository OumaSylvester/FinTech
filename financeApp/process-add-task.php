<?php 
    //Process the add-project form
    //Get project id
    if(isset($_SESSION['pid_add_task'])){
        $project_id = $_SESSION['pid_add_task'];
    }else{
        echo '<p style="color: red;">This page was accessed in error.</p>';
        header("Location: admin-page.php");
        exit();
    }
    //Check if the form has been submited
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //connect to database
        try{
            require 'includes/mysqli_connect.php';
            //Validate Project name
            $task_name = filter_var($_POST['task_name'], FILTER_SANITIZE_STRING);
            if(empty($task_name)){
                $errors[] = 'You forgot to enter the task name';
            }

            $task_desc = filter_var($_POST['task_desc'], FILTER_SANITIZE_STRING);
            if(empty($task_desc)){
                $errors[] = 'You forgot to enter the task details';
            }

            
            //If everything is okay
            if(empty($errors)){
                $query = "INSERT INTO task(task_id, task_name, task_description, project_id) VALUES('', ?,?,?)";
                $q = mysqli_stmt_init($dbcon);
                mysqli_stmt_prepare($q, $query);
                mysqli_stmt_bind_param($q, 'ssi', $task_name, $task_desc, $project_id);
                mysqli_stmt_execute($q);

                if(mysqli_stmt_affected_rows($q) == 1){
                    header("Location: view-projects.php");
                    exit();
                }else{
                    //The sql could not execute
                    $errorstring = 'System error<br>Project could not be added. We apologize  for any inconvinience';
                    echo '<p class="text-center col-sm-2" style="color: red">' . $errorstring . '</p>';
                    mysqli_close($dbcon);
                    exit();

                }
            }else{
                //report the errors
                $errorstring = "Error! The following error(s) occurred.<br>";
                foreach($errors as $msg){
                    $errorstring .= " $msg . '<br>";
                }
                $errorstring .= "Please try again.<br>";
                echo '<p class="text-center con-sm-2" style="color:red">' . $errorstring . '</p>';
            }
        }

        catch(Exception $e){
            print 'System busy, please try later<br>';
            print 'An excemption occured: ' . $e->getMessage() . '<br>';
        }//end try
        catch(Error $e){
            print 'System busy, please try later<br>';
            print 'Error occured: '. $e->getMessage() . '<br>';
        }
    }

?>