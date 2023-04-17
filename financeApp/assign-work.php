<?php
    session_start();
    //check wether user/project is chosen
    if(isset($_GET['eid']) && is_numeric($_GET['eid'])){
        $_SESSION['eid'] = (int) htmlspecialchars($_GET['eid'], ENT_QUOTES);
        header("Location: view-projects.php");
        exit("Choose Project");
    }

    if(isset($_GET['pid']) && is_numeric($_GET['pid'])){
        $_SESSION['pid'] = (int) htmlspecialchars($_GET['pid'], ENT_QUOTES);
       
    }
    if(isset($_SESSION['eid']) && isset($_SESSION['pid'])){
        require 'process-assign-work.php';
    }else{
       echo '<p class="text-center" style="color: red;">You must choose an employee and a project</p>';
       header("Location: assign-work-error-page.php");
        exit("Choose Project");
    }
?>