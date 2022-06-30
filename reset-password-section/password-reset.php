
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="CSS/password-reset-style.css">
</head>
<body>
    <div class="container">
        <div class="mainName">
            <h1>Reset Password</h1>
        </div>

        <form action="password-reset-code.php" method="POST">
            <div class="typeScreen">
                <div class="labelName">
                    <label>Email Address</label>
                </div>
                <div class="inputemail">
                    <input type="email" name="email" placeholder="Enter Email Address">
                </div>
            </div>

            <div class="button">
            <button type="submit" name="reset" class="Password-Reset-button">Password Reset</button>
            </div>
        </form>
    </div>
</body>
</html>