<?php 
    $employeeId = $_SESSION['eid'];
    $projectId = $_SESSION['pid'];
    $projectManagerId = $_SESSION['user_id'];

    try{
        require 'includes/mysqli_connect.php';

        $query = "INSERT INTO work(projectID, employeeID, projectManagerId, dateAssigned) VALUES(?, ?, ?, NOW())";
        $q = mysqli_stmt_init($dbcon);
        mysqli_stmt_prepare($q, $query);
        mysqli_stmt_bind_param($q, "iii", $projectId, $employeeId, $projectManagerId);

        mysqli_stmt_execute($q);

        if(mysqli_stmt_affected_rows($q) == 1){
            unset($_SESSION['eid']);
            unset($_SESSION['pid']);
            header("Location: work-assigned-success.php");
           exit();
        }else{
            $errorstring = 'System error<br>Project could not be added. We apologize  for any inconvinience';
            echo '<p class="text-center col-sm-2" style="color: red">' . $errorstring . '</p>';
            exit();
        }
        mysqli_close($dbcon);
        
    }catch(Exception $e){
        print 'System busy, please try later<br>';
        print 'An excemption occured: ' . $e->getMessage() . '<br>';
    }
    catch(Error $e){
        print 'System busy, please try later<br>';
        print 'Error occured: '. $e->getMessage() . '<br>';
    }
?>