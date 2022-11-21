<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Welcome</title>
</head>
<body>
    <img src="images/index/background.jpg" id="bg" alt="">
    <div id= container>
        <div id=right_box>

            <div id="login_box">
                <h1>Welcome!</h1>
                <p> <br> Please enter your email and password below to log in.  <br></p> 
                <p><br></p>

                <div class="login-form">
                    <form action="passives/login.php" method="POST">
                        <label>Email Address: <br></label>
                        <input type="text" name="email" id="email" placeholder="bobsmith@school.com">
                        <br>

                        <label>Password: <br></label>
                        <input type="password" name="pwd" id="pwd" placeholder="12345">
                        <br>

                        <?php
                        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                        
                        if (strpos($url, "error=wrongEmail")){
                            echo "<p style='color:red'>The email does not exist or you have not entered one in!</p>";

                        }
                        if (strpos($url, "error=wrongPassword")){
                            echo "<p style='color:red'>Your password is incorrect!</p>";

                        }
                        ?>

                        <br>
                        <button type="submit" style='width:75px;height:40px;' name="submit">Log in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
