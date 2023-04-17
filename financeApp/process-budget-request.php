<?php 
    $errors = array();

    $amount = filter_var($_POST['amount'], FILTER_SANITIZE_SPECIAL_CHARS);
    if(empty($amount)){
        $errors[] = 'You forgot to enter the amount';
    }
    $description = filter_var($_POST['description'], FILTER_SANITIZE_SPECIAL_CHARS);
    if(empty($description) || !preg_match('/[a-z1-9\s\-\.]/i', $description)){
        $errors[] = ' You forgot to enter the description or you have an invalid input';
    }

    $projectManagerId = $_SESSION['user_id']; //which project manager requested the budget

    if(empty($errors)){
        //Input is valid
        try{
            require 'includes/mysqli_connect.php';

            $query = "INSERT INTO budget (budgetID, projectManagerID, amount, budgetDescription) VALUES('', ?,?,?) ";
    
            $q = mysqli_stmt_init($dbcon);
            mysqli_stmt_prepare($q, $query);
            mysqli_stmt_bind_param($q, 'iss', $projectManagerId, $amount, $description);
    
            mysqli_stmt_execute($q);
    
            if(mysqli_stmt_affected_rows($q) == 1){
                header("Location: admin-page.php");
                exit();
            }else{
                $errorstring ='System Error<br />You could not be registered due to a system error. We apologize for any incovinience';
                        echo '<p class="text-center col-sm-2" style="color: red;">' . $errorstring . '</p>'; 
                mysqli_close($dbcon);
                exit();
            }
        }catch(Exception $e){
            print 'System busy please try later<br>';
            print 'Exception: ' . $e->getMessage() . '<br>';
        }catch(Error $e){
            print 'Systen busy please try later<br>';
            print 'Error: ' . $e->getMessage() . '<br>';
        }
       
    }else{
        //There were errors in user input
        $errorstring = "Error! The following errors occured: <br>";
        foreach($errors as $msg){
            $errorstring .= "$msg<br>"; 
        }
        $errorstring .= "Please try again.";
        echo '<p class="text-center col-sm-2" style="color: red">' . $errorstring . '</p>';
    }
?>