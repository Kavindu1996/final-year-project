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
        $query = "SELECT * FROM staff INNER JOIN role ON staff.role_id = role.role_id WHERE (first_name LIKE '{$search}%' AND is_deleted = 0 AND role.role_name != 'admin') ORDER BY id;";
    }else {
        $query = "SELECT * FROM staff INNER JOIN role ON staff.role_id = role.role_id WHERE is_deleted = 0 AND role.role_name != 'admin' ORDER BY id;";
    }
    $staffMembers = mysqli_query($connection, $query);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff List</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="CSS/staffStyle11.css">
</head>
<body>
    <main class="container">
        <div class="sub-section">
            <div class="headding">
                <span class ="button_Next_Text">Staff Members</span>
                <div class="button_search">
                    <button type="button" id="addNew" name="submit" onclick="window.open('staffProfileAddNew.php','_top');">
                        <span>Add New</span>
                    </button>
                    <!-- search option -->
                    <div class="search">
                        <form action="staff.php" method="get">
                            <label>Search</label>
                            <input type="text" name="search" class="searchBox" value="<?php echo $search; ?>" autofocus>
                        </form>
                    </div>
                </div>
            </div>
        </div>

 
        <div class="body">
            <table class="masterlist">
                <thead>
                    <th>Image</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Role</th>
                    <th>View Profile</th>
                    <th>Status</th>
                    <th>option</th>
                </thead>
                <tbody>
                    <?php
                        //Data is displayed after successful query execution
                        if ($staffMembers) {
                            while ($staff = mysqli_fetch_assoc($staffMembers)) {

                    ?>

                        <tr>
                            <td data-label="Image"><img src="<?php echo "../upload/staff/".$staff['stud_image'];?>" width="40px" alt="image"></td>
                            <td data-label="First Name"><?php echo $staff['first_name'];?></td>
                            <td data-label="Last Name"><?php echo $staff['last_name']; ?></td>
                            <td data-label="Job Title"><?php echo $staff['role_name']; ?></td>
                            <!-- view profile -->
                            <td data-label="view profile">
                                <button type="button" id='addNew1' name="submit" onclick="window.open('staffProfile.php?user_id=<?php echo $staff['id'];?>','_top');">
                                <span>View Profile</span>
                                </button>
                            </td>
                            <td data-label="Status"><span id = "status"><?php echo $staff['status']; ?></span></td>
                            <td data-label="option">
                            <!-- edit -->
                                <button type="button" id='addNew2' name="submit" onclick="window.open('modify-staffProfileAddNew.php?user_id=<?php echo $staff['id'];?>','_top');">
                                    <span class ="button_Edit_text">Edit</span>   
                                </button>
                            <!-- delete -->
                                <input type="hidden"  class="delete_id_value"  value="<?php echo $staff['id'];?>">
                                <a href="javascript:void(0)" class="delete_btn_ajax"  id= "addNew3">Delete</a>
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

                var deleteid = $(this).closest("tr").find('.delete_id_value').val();
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
                            url : "delete-staffProfileAddNew.php",
                            data : {
                                "delete_btn_set" : 1,
                                "delete_id" : deleteid,
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