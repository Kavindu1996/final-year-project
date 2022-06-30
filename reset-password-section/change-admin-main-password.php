<?php include 'password-reset-process.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="CSS/change-admin-main-password-style1.css">
</head>
<body>
    <div class="container">
        <div class="mainName">
            <h1>Change Password</h1>
        </div>

        <form action="" method="POST">
            <div class="typeScreen">
                <div class="labelName">
                    <label>Email Address</label>
                </div>
                <div class="inputemail">
                    <input type="email" name="email" placeholder="Enter Email Address" required>
                </div>
            </div>

            <div class="typeScreen">
                <div class="labelName">
                    <label>New Password</label>
                </div>
                <div class="inputPassword">
                    <input type="password" name="new_password" placeholder="Enter New Password" required>
                </div>
            </div>

            <div class="button">
            <button type="submit" name="change" class="Password-Reset-button">Change Password</button>
            </div>
        </form>
    </div>
</body>
</html>