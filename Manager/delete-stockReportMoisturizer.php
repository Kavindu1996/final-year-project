<?php session_start(); ?>
<?php require_once('../database/inc/connection.php')?>
<?php

//validation 1 start
  
   //didn't delete fill names
   if (!isset($_SESSION['manager_id'])) {
    header('Location: ../mainLogin.php');
    }
    

    if (isset($_POST['delete_btn_set'])) {
        $moisturizer_id = $_POST['delete_moisturizer_id'];

        
        //deleting the user
        $query = "UPDATE moisturizer SET is_deleted = 1 WHERE moisturizer_id = {$moisturizer_id} LIMIT 1";
        $result = mysqli_query($connection, $query);

        if ($result) {
            // user deleted
            header('Location: moisturizing.php');
        }
    }else {
        header('Location: moisturizing.php');
    }

   ?>