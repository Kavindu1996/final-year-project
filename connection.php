
<?php

    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'user_db' ;

    ///database connection

    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    // Check connection
    
    if (mysqli_connect_errno()) {
        die('Database connection failed ' . mysqli_connect_error());
    }else {
        //echo "Connection successful.";
    }

?>