<?php 
    require_once 'includes/constants.php';
    $user_id =$_SESSION['user_id'];

    try{
        require 'includes/mysqli_connect.php';

        $query = "SELECT email,  phone, address1, address2, city, state_country, zcode_pcode FROM users WHERE user_id = ? ";
        $q = mysqli_stmt_init($dbcon);
        mysqli_stmt_prepare($q, $query);
        mysqli_stmt_bind_param($q, 'i', $user_id);
    
        mysqli_stmt_execute($q);
        $result = mysqli_stmt_get_result($q);
    
        if($result){
            //query was successfull
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $email = htmlspecialchars($row['email']);
            $phone = htmlspecialchars($row['phone']);
            $address1 = htmlspecialchars($row['address1']);
            $address2 = htmlspecialchars($row['address2']);
            $city = htmlspecialchars($row['city']);
            $country = htmlspecialchars($row['state_country']);
            $zcode_pcode = htmlspecialchars($row['zcode_pcode']);
    
            $name = $_SESSION['user_name'];
            $profile_pic = $_SESSION['profile_pic'];
            
            //display the Profile
            echo '<div class="row profile">
                <div class="col-sm-8 profile-details">
                    <span><img src="' . IMAGES . 'profile/' . $profile_pic . '" alt="Profile Picture" id="profile-pic"></span>
                    <span>' . $name . '</span> 
                    <span>' . $email . '</span>
                    <span>Phone ' . $phone . '</span>
                    <span>' . $address1 . ', ' . $address2 . ' ' . $city . '<br>' . $country . '</span>
                    <span>Zip code: ' . $zcode_pcode . '</span>
                </div>
                <div class="col-sm-4">
                   
                </div>
            </div>';
        }else{
                //query did not run successfully
                //Error message:
                echo '<p class="error">The current users could not be retrieved. We apologize for any inconvience.';
                //Dubug message:
                //echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $query  . '</p>';
                exit();
        }
    }catch(Exception $e)//We finally handle any problems here
    {
        print 'An Exception occurred. Message: ' . $e->getMessage() . '<br>';
        print 'The system is busy please try later';
    }
    catch(Error $e)
    {
        print 'An Error occurred. Message: ' . $e->getMessage() . '<br>';
        print 'The system is busy please try again later';
    }
   
?>