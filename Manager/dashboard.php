<?php session_start(); ?>
<?php require_once('../database/inc/connection.php')?>
<?php include 'sidebar.php';?>
<?php

    //Checking if a valid user is logged in
    if (!isset($_SESSION['manager_id'])) {
        header('Location: ../mainLogin.php');
    }

    //getting data from the database
    $today = date("Y-m-d");
    $query = "SELECT appointment_date AS Date, SUM(amount) AS Total FROM appointment GROUP BY appointment_date";
    $result = mysqli_query($connection, $query);
    $chart_data = '';
    while($row = mysqli_fetch_array($result))
    {
    $chart_data .= "{ Date:'".$row["Date"]."', Total:".$row["Total"]."}, ";
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="CSS/dashboardStyle4.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
</head>
<body>
<main class="container">
    <div class="sub-section">
        <span class ="button_Next_Text">Dashboard</span>
    </div>

    <div class="DetailsBoxes">
            <div class="Box1">   
                <div class="Box1_1"></div>
                <div class="addUser">
                    <a href="staffProfileAddNew.php">add user</a>
                </div>
            </div> 
            
            <div class="Box2">
                <div class="Box2_1"></div>
                <div class="addNotice">
                    <a href="AddNewNotice.php">add Notice</a>
                </div>
            </div>

            <div class="Box3">
                <div class="Box3_1"></div>
                <div class="cashierPanel">
                <a href="equipmentAdd.php">Equipment</a>
                </div>
            </div> 

            <div class="Box4">
                <div class="Box4_1"></div>
                <div class="staffPanel">
                <a href="moisturizerAdd.php">Moisturizer</a>
                </div>
            </div> 
        </div> 

        <div class="responsiveDetailsBoxes">
            <div class="firstrow">
                <div class="Box1">   
                    <div class="Box1_1"></div>
                    <div class="addUser">
                        <a href="staffProfileAddNew.php">add user</a>
                    </div>
                </div> 
            
                <div class="Box2">
                    <div class="Box2_1"></div>
                    <div class="addNotice">
                        <a href="AddNewNotice.php">add Notice</a>
                    </div>
                </div>
            </div>
            <div class="secondrow">
                <div class="Box3">
                    <div class="Box3_1"></div>
                    <div class="cashierPanel">
                    <a href="../cashierPanel/dashboard.php">cashier panel</a>
                    </div>
                </div> 

                <div class="Box4">
                    <div class="Box4_1"></div>
                    <div class="staffPanel">
                    <a href="../staff/staffList.php">staff panel</a>
                    </div>
                </div> 
            </div>
        </div> 
    </div>
    <!-- chart   -->
    <div class="chart">
        <div id="chart"></div>
   </div>


<script>
    Morris.Line({
    element : 'chart',
    data:[<?php echo $chart_data; ?>],
    xkey:['Date'],
    ykeys:['Total'],
    labels:['Total'],
    hideHover:'auto',
    stacked:true
    });

</script>

</main>
</body>
</html>
<?php mysqli_close($connection); ?>