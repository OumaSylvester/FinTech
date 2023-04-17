<?php 
    //Process the add-project form

    //Check if the form has been submited
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //connect to database
        try{
            require 'includes/mysqli_connect.php';
            //Validate Project name
            $project_name = filter_var($_POST['project_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if(empty($project_name)){
                $errors[] = 'You forgot to enter the project name';
            }

            $project_class = filter_var($_POST['project_class'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if(empty($project_class)){
                $errors[] = 'You forgot to enter the project class';
            }

            $expense = filter_var($_POST['expenses'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if(empty($expense)){
                $errors[] = 'You forgot to enter the expenses';
            }else{
                $expense = preg_replace('/,/', '', $expense);
            }
            //If everything is okay
            if(empty($errors)){
                $query = "INSERT INTO project(projectId, projectName, projectClassification, expenses) VALUES('', ?,?,?)";
                $q = mysqli_stmt_init($dbcon);
                mysqli_stmt_prepare($q, $query);
                mysqli_stmt_bind_param($q, 'sss', $project_name, $project_class, $expense);
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