<?php require_once('../database/inc/Connection.php')?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>

    <link rel="stylesheet" href="CSS/sidebarStyle10.css">
</head>
<body>
    <div class="section">
        <!-- <div class="nav-bar">
            <?php
            $query = "SELECT salon_name FROM salon WHERE salon_id = 1";
            $result_set = mysqli_query($connection, $query);
            foreach ($result_set as $row) {
            ?>
            <div class="left_area"><h3><?php echo $row['salon_name']?></h3></div>
            <?php
            }
            ?>
            <div class="right_area">Welcome <?php echo $_SESSION['first_name'] ?>! 
            <form action="../mainLogout.php" method="POST">
                <button type="submit" name="logout_btn"class="logout_btn">LogOut</button>
            </form>
            </div>
        </div> -->

        <div class="nav-bar">
        <?php
            $query = "SELECT salon_name FROM salon WHERE salon_id = 1";
            $result_set = mysqli_query($connection, $query);
            foreach ($result_set as $row) {
            ?>
        <div class="left_area"><h3><?php echo $row['salon_name']?></h3></div>
        <?php
        }
        ?>

        <div class="right_area">Welcome <?php echo $_SESSION['first_name'] ?>! 
            <button type="button" class="logout_btn"  onclick="window.open('../mainLogout.php','_top');">
            <span>Logout</span>
            </button>
        </div>
    </div>
    </div>

   
    <nav class="sidebar">
        <div class="btn">
         <span class="fas fa-bars"></span>
        </div>
        <ul>
            <li>
                <a href="dashboard.php">Dashboard</a>
            </li>
            <li>
                <a href="staff.php">Staff</a>
            </li>
            <li>
                <a href="service.php">Service</a>
            </li>
            <li>
                <a href="income.php">Today Income</a>
            </li>
            <li>
                <a href="dailyIncome.php">Daily Incomes</a>
            </li>
            <li>
                <a href="dailyIncomeGraph.php">Daily Income Graph</a>
            </li>
            <li>
                <a href="graph.php">Graph</a>
            </li>
            <li>
                <a href="equipment.php">Equipment</a>
            </li>
            <li>
                <a href="moisturizing.php">Moisturizer</a>
            </li>
            <li>
                <a href="appointment.php">Appointment</a>
            </li>
            <li>
                <a href="onlineCustomers.php">Online Customers</a>
            </li>
            <li>
                <a href="customer Details.php">Customer Details</a>
            </li>
            <li>
                <a href="notice.php">Notice</a>
            </li>
            <li>
                <a href="about.php">About</a>
            </li>
            <li>
                <a href="settings.php">Settings</a>
            </li>

            <!-- <li>
                <a href="">Notice</a>
            </li> -->
        </ul>
    </nav>

    <script>
      $('.btn').click(function(){
      $(this).toggleClass("click");
      $('.sidebar').toggleClass("show");
   });
    </script>
</body>
</html>