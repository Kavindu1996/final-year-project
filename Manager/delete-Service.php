<?php session_start(); ?>
<?php require_once('../database/inc/connection.php')?>
<?php

  
   //didn't delete fill names
   if (!isset($_SESSION['manager_id'])) {
    header('Location: ../mainLogin.php');
    }
    

    if (isset($_POST['delete_btn_set'])) {
        $service_id = $_POST['delete_id'];

        //deleting the user
        $query = "UPDATE service SET is_deleted = 1 WHERE service_id = {$service_id} LIMIT 1";
        $result = mysqli_query($connection, $query);

        if ($result) {
            // user deleted
            header('Location: service.php');
        }
    }else {
        header('Location: service.php');
    }

   ?>