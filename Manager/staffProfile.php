<?php session_start(); ?>
<?php include 'navbar.php';?>
<?php require_once('../database/inc/connection.php')?>


<?php
    //Checking if a valid user is logged in
    if (!isset($_SESSION['manager_id'])) {
        header('Location: ../mainLogin.php');
        }

        $errors         = array();
        $user_id        = '';
        $first_name     = '';
        $last_name      = '';
        $phone_number   = '';
        $address        = '';
        $email          = '';
        $nic            = '';
        $stud_image     = '';
        $date_of_birth  = '';
        $gender         = '';
        $role_name      = '';
        $status         = '';


    //getting the selected user information from the database
    $errors = array();
    if (isset($_GET['user_id'])) {
        $user_id = mysqli_real_escape_string($connection, $_GET['user_id']);
        $query = "SELECT * FROM staff INNER JOIN role ON staff.role_id = role.role_id WHERE id = {$user_id} LIMIT 1";

        $result_set = mysqli_query($connection, $query);

        if ($result_set) {
            if (mysqli_num_rows($result_set) == 1) {
                $result         = mysqli_fetch_assoc($result_set);
                $first_name     = $result['first_name'];
                $last_name      = $result['last_name'];
                $phone_number   = $result['phone_number'];
                $address        = $result['address'];
                $email          = $result['email'];
                $nic            = $result['nic'];
                $role_name      = $result['role_name'];
                $stud_image     = $result['stud_image'];
                $date_of_birth  = $result['date_of_birth'];
                $gender         = $result['gender'];
                $status         = $result['status'];
            }else {
                header('Location: staffDetails.php?user_not_found');
            }
        }else {
            header('Location: staffDetails.php?query_failed');
        }
    }

    //status submissions
    if (isset($_POST['submit'])) {
        $user_id = $_POST['user_id'];
        $status  = $_POST['status'];
       
        
        $status = mysqli_real_escape_string($connection, $_POST['status']);
        $query = "UPDATE staff SET status = '{$status}' WHERE id = {$user_id} LIMIT 1";
        $result = mysqli_query($connection, $query);

            if ($result) {

                    header('Location: staff.php?staff_modified=true');
            }else{
                    $errors[] = 'Failed to modify the record';
                }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Profile View</title>
    <link rel="stylesheet" href="CSS/staffProfileStyle3.css">
</head>
<body>

    <div class="container">
        <div class="title">
            <div class="routing">Staff Members/ Staff Information</div>
            <b>Staff Information</b>
        </div>
            <!-- mobileview -->
        <div class="mobiletitle">
            <b>Staff Information</b>
        </div>
            <div class="mobilerouting">Staff Members/ Staff Information</div>


         <!-- full-details -->
        <div class="both">
            <div class="left">
                <div class="image">
                    <img src="<?php echo "../upload/staff/".$stud_image ; ?>" alt="image">
                </div>
            </div>       
            <div class="right">
                <div class="name1">
                    <?php echo  " $first_name   $last_name" ?>
                </div>
                <div class="role">
                    <?php echo  " $role_name" ?>
                </div>
                <hr>

                <table class="table">
                    <tr>
                        <th>Birthday    </th>
                        <td><?php echo '' . $date_of_birth . ''; ?></td>
                    </tr>
                    <tr>
                        <th>Gender      </th>
                        <td><?php echo '' . $gender . ''; ?></td>
                    </tr>
                    <tr>
                        <th>Nic      </th>
                        <td><?php echo '' . $nic . ''; ?></td>
                    </tr>
                    <tr>
                        <th>Email       </th>
                        <td><?php echo '' . $email . ''; ?></td>
                    </tr>
                    <tr>
                        <th>PhoneNumber </th>
                        <td><?php echo '' . $phone_number . ''; ?></td>
                    </tr>
                    <tr>
                        <th>Address     </th>
                        <td><?php echo '' . $address . ''; ?></td>
                    </tr>

                </table>
                    <!-- status -->
                <form action="staffProfile.php" method="post" class="userform">
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                        <div class="status">
                            <div class="statusLable">
                                <label>Status </label>
                            </div>
                            <div class="statusInput">                                                   
                                <div class="roleNo1">
                                    <input type="radio"  name="status" value="online" required>
                                    <label for="role1" id="status1">Online</label><br>
                                </div>
                                <div class="roleNo2">
                                    <input type="radio" id="status2" name="status" value="offline" required>
                                    <label for="role2">Offline</label>
                                </div>                          
                            </div>
                        </div>
                    <button class="close" type="submit" name="submit" onclick="window.open('staff.php','_top');">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php mysqli_close($connection); ?>


