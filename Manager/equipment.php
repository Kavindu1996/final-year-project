<?php session_start(); ?>
<?php require_once('../database/inc/connection.php')?>
<?php include 'sidebar.php';?>
<?php
    //Checking if a valid user is logged in
    if (!isset($_SESSION['manager_id'])) {
        header('Location: ../mainLogin.php');
    }

    //getting the staff records from the database
    $search = '';
    if (isset($_GET['search'])) {
        $search = mysqli_real_escape_string($connection, $_GET['search']);
        $query = "SELECT * FROM equipment WHERE (equipment_name LIKE '{$search}%') AND is_deleted=0 ORDER BY equipment_name";
    }else {
        $query = "SELECT * FROM equipment WHERE is_deleted=0 ORDER BY equipment_name";
    } 
    $equipmentList = mysqli_query($connection, $query);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Equipment List</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="CSS/equipmentStyle9.css">
</head>
<body>
<main class="container">
    <div class="sub-section">
        <div class="headding">
            <span class ="button_Next_Text">Equipments</span>
        

            <button type="button" id="addNew" name="submit" onclick="window.open('equipmentAdd.php','_top');">
                <span>Add New</span>
            </button>

            <div class="search">
                <form action="equipment.php" method="get">
                    <label>Search:</label>
                    <input type="text" name="search" class="searchBox" value="<?php echo $search; ?>" autofocus>
                </form>
            </div>
        </div>
    </div>

   
    <div class="body">
        <table class="masterlist">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Warranty</th>
                    <th>Price</th>
                    <th>Option</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                    //Data is displayed after successful query execution
                    if ($equipmentList) {
                        while ($equipment = mysqli_fetch_assoc($equipmentList)) {
                ?>
                    <tr>
                        <td data-label="Image"><img src="<?php echo "../upload/equipment/".$equipment['equipment_image'];?>" width="50px" alt="image"></td>
                        <td data-label="Name"><?php echo $equipment['equipment_name'];?></td>
                        <td data-label="Warranty"><?php echo $equipment['warranty']; ?></td>
                        <td data-label="Price"><?php echo 'Rs.'.$equipment['equipment_price'];?></td>
                        <td data-label="Option">
                            <!-- edit -->
                            <button type="button" id='addNew2' name="submit" onclick="window.open('modify-stockReportEquipment.php?equipment_id=<?php echo $equipment['equipment_id'];?>','_top');">
                            <span class ="button_text">Edit</span>   
                            </button>      
                            <!-- delete -->                    
                            <input type="hidden" class = "delete_equipment_id_value" value="<?php echo $equipment['equipment_id'];?>">
                            <a href="javascript:void(0)" class ="delete_btn_ajax" id= "addNew3">Delete</a>
                        </td>
                    </tr>
                <?php
                            
                        }
                    }else {
                ?>

                    <tr>
                        <td>echo "Database query failed.";</td>
                    </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</main>


    <script>
        // table row style
        var odd = document.querySelectorAll('tr:nth-child(odd)');
        var even = document.querySelectorAll('tr:nth-child(even)');
        for(var i of odd) {
            i.style.backgroundColor = '#f2f2f2';
        }

        for(var i of even) {
            i.style.backgroundColor = 'white';
        }


        //Alert when deleting data
        $(document).ready(function(){
        $('.delete_btn_ajax').click(function(e){
            e.preventDefault();

            var deleteid = $(this).closest("tr").find('.delete_equipment_id_value').val();
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this Data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {

                    $.ajax({
                        type: "POST",
                        url : "delete-stockReportEquipment.php",
                        data : {
                            "delete_btn_set" : 1,
                            "delete_equipment_id" : deleteid,
                            
                        },
                        success : function (response) {
                            swal("Data Deleted Successfuly.!", {
                                icon: "success",
                            }).then((result) => {
                                location.reload();
                            });
                        }
                    });
                } 
                });
            });
        });
    </script>
</body>
</html>

<?php mysqli_close($connection); ?>