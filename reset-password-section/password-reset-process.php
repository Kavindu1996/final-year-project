<?php
    if(isset($_GET['code'])) {
        $code = $_GET['code'];

        $connection = new mySqli('localhost', 'root', '', 'user_db');
        if($connection->connect_error) {
            die('Could not connect to the database');
        }

        $Query = $connection->query("SELECT * FROM staff WHERE code = '$code' and updated_time >= NOW() - Interval 1 DAY");

        if($Query->num_rows == 0) {
            header("Location: mainLogin.php");
            exit();
        }


        if(isset($_POST['change'])) {
            $email = $_POST['email'];
            $new_password = $_POST['new_password'];
            $hashed_password = sha1($new_password);

            $changeQuery = $connection->query("UPDATE staff SET password = '$hashed_password' WHERE email = '$email' and code = '$code' and updated_time >= NOW() - INTERVAL 1 DAY");

            if($changeQuery) {
                header("Location:success.php");
            }
        }
        $connection->close();
}else {
    header("Location: mainLogin.php");
    exit();
}
?>
