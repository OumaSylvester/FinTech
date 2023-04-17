
<?php

    require_once 'includes/constants.php';
    $errors = array();

    $employeeId = $_SESSION['user_id'];

    $price = $_POST['price'];
    if(empty($price)){
        $errors[] = 'You forgot to enter the price';
    }else{
        $price = preg_replace('/,/', '', $price);
    }


    if(isset($_FILES['image'])){
        $image = $_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        
        $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
        $detectedType = exif_imagetype($_FILES['image']['tmp_name']);
        if(!in_array($detectedType, $allowedTypes)){
            $errors[] = 'The image type must be a GIF, PNG,JPG, JPEG or PJPEG';
        }
        if($image_size > 1024000){
            $errors[] = 'Image size must be no more than 1MB';
        }
    }else{
        $errors[] = 'You forgot to upload a file';
    }
    
    //$image_type = $_FILES['image']['type'];

    //if(empty($image)){
      //  $errors[] = 'You forgot to upload a file';
    //}
    
    //$error = !in_array($detectedType, $allowedTypes);

    
    //if(($image_type != 'image/gif') && ($image_type != 'image/png') && ($image_type != 'image/jpeg') && ($image_type != 'image/pjpeg') && ($image_type != 'image/jpg')){
        //$errors[] = 'The image type must be a GIF, PNG,JPG, JPEG or PJPEG';
   // }

   

    if(empty($errors)){
        if($_FILES['image']['error'] == 0){
            //No problems in uploadin the image
            //Give the image a unique name
            $unique_name = time() . '_' . $image;
            $target = IMAGES . $unique_name;
            if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
                //moving image was successful
                try{
                    require 'includes/mysqli_connect.php';

                    $query = "INSERT INTO bill VALUES('', ?, ?, ?, NOW())";
                    $q = mysqli_stmt_init($dbcon);
                    mysqli_stmt_prepare($q, $query);
                    mysqli_stmt_bind_param($q, 'iss',$employeeId, $unique_name, $price);

                    mysqli_stmt_execute($q);

                    if(mysqli_stmt_affected_rows($q) == 1){
                        header("Location: finance-employee.php");
                        @unlink($_FILES['image']['tmp_name']); //unlink the tempory file uploaded
                        mysqli_close($dbcon);
                        exit();
                    }else{
                        //error in insertion to db
                        $errorstring = 'System error<br>Bill could not be added. We apologize  for any inconvinience';
                        echo '<p class="text-center col-sm-2" style="color: red">' . $errorstring . '</p>';
                        mysqli_close($dbcon);
                        exit();
                    }

                }catch(Exception $e){
                    print 'System busy, please try later<br>';
                    print 'An excemption occured: ' . $e->getMessage() . '<br>';
                }//end try
                catch(Error $e){
                    print 'System busy, please try later<br>';
                    print 'Error occured: '. $e->getMessage() . '<br>';
                }
            }else{
                //error in uploding file
                echo '<p class="text-center col-sm-2" style="color: red">There was a problem uploding your file.</p>';
            }
        }else{
            //error in uploding file
            echo '<p class="text-center col-sm-2" style="color: red">There was a problem uploding your file.</p>';
        }
    }else{
        //error in user input
        $errorstring = "The following error(s) occured: <br>";
        foreach($errors as $msg){
            $errorstring .= "$msg<br>";
        }
        $errorstring .= "Please try again.<br>";
        echo '<p class="text-center col-sm-2" style="color:red">' . $errorstring . '</p>';
    }


    
?>