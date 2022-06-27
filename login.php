<?php session_start(); ?>
<?php require_once('database/inc/connection.php')?>
<?php

        //checking if a user is logged in
        if (isset($_SESSION['cashier_id'])) {
            header('Location: cashierPanel/search Details.php');
        }elseif (isset($_SESSION['admin_id'])) {
            header('Location: Admin/dashboard.php');
        }elseif (isset($_SESSION['manager_id'])) {
            header('Location: manager/staff.php');
        }elseif (isset($_SESSION['staff_id'])) {
            header('Location: staff/staffList.php');
        }


    


    // check for form submission
    if (isset($_POST['submit'])) {

            //save errors to array
            $errors = array();
        
        // check if the username and password has been entered
        //trim use to cancel the space ares in email
        //strlen use to See if there is a single letter
        if(!isset($_POST['email']) || strlen(trim($_POST['email'])) < 1 ) {
            $errors[] = 'Invalid Username / Password';
        }

        if(!isset($_POST['password']) || strlen(trim($_POST['password'])) < 1 ) {
            $errors[] = 'Invalid Username / Password';
        }
        //check if there are any errors in thr form
        if (empty($errors)) {
            // save username and password in to variables
            //mysqli_real_escape_string use to Checks whether a sql script has been entered
            $email = mysqli_real_escape_string($connection, $_POST['email']);
            $password = mysqli_real_escape_string($connection, $_POST['password']);
            $hashed_password = sha1($password);

            // prepare database query
            $query = "SELECT * FROM staff INNER JOIN role ON staff.role_id = role.role_id WHERE email = '{$email}' AND password = '{$hashed_password}' LIMIT 1" ;
            $result_set = mysqli_query($connection, $query);

            $user=mysqli_fetch_array($result_set);
            if (isset($user)) {
            if($user["role_name"]=="cashier") {
                
                $_SESSION['cashier_id'] = $user['id'];
                $_SESSION['cashier_first_name'] = $user['first_name'];

                header('Location: cashierPanel/search Details.php');

                }
                elseif($user["role_name"]=="admin") {

                    $_SESSION['admin_id'] = $user['id'];
                    $_SESSION['admin_name'] = $user['first_name'];

                    header('Location: Admin/dashboard.php');
                }elseif($user["role_name"]=="manager") {

                    $_SESSION['manager_id'] = $user['id'];
                    $_SESSION['first_name'] = $user['first_name'];

                    header('Location: manager/dashboard.php');
                }elseif($user["role_name"]=="stylist") {

                    $_SESSION['staff_id'] = $user['id'];
                    $_SESSION['staff_name'] = $user['first_name'];

                    header('Location: staff/staffList.php');
                    
                }
                else {
                    $errors[] = 'Invalid Username / Password';
                }
            }
            else {
                $errors[] = 'Invalid Username / Password';
            }
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Login</title>
    <link rel="stylesheet" href="Style3.css">
</head>
<body class="log1">
    <div class="imagecontainer">
        <div class="container">
            <div class="loginbox">
                <h1>Log In</h1>
                <form action="mainLogin.php" method="post">
                
                    <p>Username</p>
                    <input type="text" name="email" placeholder="Enter Username">
                    <p>Password</p>
                    <input type="password" name="password" placeholder="Enter Password">
                        <?php
                            if (isset($errors) || !empty($errors)) {
                                echo '<p class="error">Invalid Username / Password</p>';
                            }
                        ?>
                    <input type="submit" name="submit" value="Login"> </br>
                    <a href="reset password section/password-reset.php">Forgotten password?</a><br>
                </form>
            </div>

            <div class="title">
                <?php
                    $query = "SELECT salon_name FROM salon WHERE salon_id = 1";
                    $result_set = mysqli_query($connection, $query);
                    foreach ($result_set as $row) {
                    ?>
                <div class="left_area"><?php echo $row['salon_name']?></div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    </body>
</html>

<?php mysqli_close($connection); ?>