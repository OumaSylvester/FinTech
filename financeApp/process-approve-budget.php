<?php
    session_start();
    $financeManagerId = $_SESSION['user_id'];
    $budgetId =$_SESSION['bid'];

    try{
        require 'includes/mysqli_connect.php';

        $query = "UPDATE  budget SET approved = 'yes', financeManagerID = ? WHERE budgetID = ?";
        $q = mysqli_stmt_init($dbcon);
        mysqli_stmt_prepare($q, $query);
        mysqli_stmt_bind_param($q, 'ii', $financeManagerId, $budgetId);

        mysqli_stmt_execute($q);

        if(mysqli_stmt_affected_rows($q) == 1){
            header("Location: approve-budget.php");
            unset($_SESSION['bid']);
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