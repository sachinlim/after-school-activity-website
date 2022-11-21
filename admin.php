<?php
    include_once "passives/dbh-conn.php";
    session_start();

    # Redirecting users to the correct webpages if they manually enter the web address in
    if ($_SESSION["typeID"] === 1){
        header('Location: student.php');
    }
    if ($_SESSION["typeID"] === 2){
        header('Location: teacher.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <title>Home</title>
</head>

<body>
    <?php
    include_once "header.php";
    ?>

    <div id=container>
        <div id=information>

            <div id="signup-form-L">
            <h2>Add Users </h2>
                <section class="add-users-form">
                        <form id="form" action="passives/create_users_func.php" method="POST">

                            <label>First Name:</label>
                            <input type="text" name="fname" id="fname" placeholder="Bob..." style="text-transform: capitalize;"> <br>

                            <label>Surname:</label>
                            <input type="text" name="sname" id="sname" placeholder="Smith..." style="text-transform: capitalize;"><br>

                            <label>Date of Birth:</label>
                            <input type="text" name="doB" id="doB" placeholder="25/04/2001"><br>

                            <label>Email Address:</label>
                            <input type="text" name="email" id="email" placeholder="bobsmith@school.com"><br>

                            <label>Password:</label>
                            <input type="password" name="pwd" id="password_rpt" placeholder="12345"><br>

                            <label>User Type:</label>
                            <input type="text" name="utype" id="utype" placeholder="1"><br>
                            
                            <button type="submit" name="submit" id="submit" style='width:60px;height:30px;'>Submit</button><br>

                        </form>
                
                </section>
            </div>

            <div id="all-users-R">
                <h2>Hello. Below are all Users</h2>

                <div id=table-data>
                    <table>
                        <thead>
                            <tr>
                                <th> Name </th>
                                <th> DoB </th>
                                <th> Email </th>
                                <th> Action </th>
                            </tr>
                        </thead>

                    <?php
                            $sql = "SELECT * from users WHERE typeID = 1 OR typeID = 2;";

                            $result = mysqli_query($conn, $sql);

                            while ($row = mysqli_fetch_assoc($result)){
                                echo "<tr>
                                        <td>".$row['fName']. " " . $row['sName']. 
                                        "</td><td>".$row['doB'].
                                        "</td><td>".$row['email'].
                                        "</td><td><a href='passives/delete_users_func.php?id=$row[userID]'>Delete".
                                     "</td></tr>";

                            }

                    ?>
                    
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>