<?php
    session_start();
    //$financeManagerId = $_SESSION['user_id']; //if one you would want to know who approved the project manager
    $projectManagerId =$_SESSION['pmanid'];

    try{
        require 'includes/mysqli_connect.php';

        $query = "UPDATE  users SET approved = 'yes' WHERE user_id = ?";
        $q = mysqli_stmt_init($dbcon);
        mysqli_stmt_prepare($q, $query);
        mysqli_stmt_bind_param($q, 'i', $projectManagerId);

        mysqli_stmt_execute($q);

        if(mysqli_stmt_affected_rows($q) == 1){
            header("Location: approve-project-manager.php");
            unset($_SESSION['pmanid']);
            mysqli_close($dbcon);
            exit();
        }
    }catch(Exception $e){
        print 'System busy, please try later<br>';
        print 'An excemption occured: ' . $e->getMessage() . '<br>';
    }
    catch(Error $e){
        print 'System busy, please try later<br>';
        print 'Error occured: '. $e->getMessage() . '<br>';
    }
?>