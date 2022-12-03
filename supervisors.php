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
    <link rel="stylesheet" href="css/admin-supervisors.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <title>Create Supervisors</title>
</head>

<body>
    <?php
    include_once "header.php";
    ?>

    <div id=container>
        <div id=information>

            <div id="signup-form-L">
            <h2>Add a Supervisor for a Club </h2>
                <section class="add-clubs-form">
                        <form id="form" action="passives/create_supervisors_func.php" method="POST">

                            <label>Club:</label>
                            <select name="clubID"> 
                                <option>Select Club</option>

                                <?php
                                    $sql = "SELECT * FROM clubs_list;";
                                    $result = mysqli_query($conn, $sql);

                                    while ($row = mysqli_fetch_assoc($result)){
                                        echo "<option value='" . $row['clubID']. "'>" . $row['clubID']. " &nbsp;&nbsp; ". $row['club_name']. "</option>";
                                    }
                                ?>

                            </select>
                            <br>

                            <label>User:</label>
                            <select name="userID"> 
                                <option>Select User</option>

                                <?php
                                    $sql = "SELECT * FROM users WHERE typeID = 2;";
                                    $result = mysqli_query($conn, $sql);

                                    while ($row = mysqli_fetch_assoc($result)){
                                        echo "<option value='" . $row['userID']. "'>" . $row['userID']. " &nbsp;&nbsp; ". $row['fName']. " ". $row['sName']."</option>";
                                    }
                                ?>

                            </select>
                            <br>
                            <button type="submit" name="submit" id="submit" style='width:60px;height:30px;'>Submit</button>
                            <br>

                        </form>

                        <p><br>Click <b><a href="create-clubs.php"> here </a></b> to create new Clubs and Activities.</p>

                </section>
            </div>

            <div id="all-users-R">
                <h2>Below are all Clubs and the Supervisors</h2>
                <p>If there are no supervisors for the club, it can be seen below.</p>
                <p><br>There is also the option to delete the supervisor for the Club</p>
                <p>This does not mean the User themselves is deleted from the database.</p>

                <div id=table-data>
                    <table>
                        <thead>
                            <tr>
                                <th> Club ID </th>
                                <th> Club Name </th>
                                <th> User ID </th>
                                <th> Name </th>
                                <th> Action </th>
                            </tr>
                        </thead>

                    <?php
                        $sql = "SELECT clubs_list.clubID, clubs_list.club_name, club_supervisors.supervisorID, club_supervisors.userID, users.fName, users.sName
                        FROM clubs_list
                        LEFT JOIN club_supervisors 
                        ON clubs_list.clubID = club_supervisors.clubID
                        LEFT JOIN users
                        ON users.userID = club_supervisors.userID
                        ORDER BY clubs_list.clubID";

                        $result = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_assoc($result)){
                            echo "<tr>
                            <td>".$row['clubID']. "</td><td>".$row['club_name'];

                            if (strlen($row['userID'] > 1)) {
                                echo "</td><td>".$row['userID'] . "</td><td>".$row['fName'] . " " . $row['sName']. 
                                "</td><td><a href='passives/delete_supervisor_func.php?id=$row[supervisorID]'>Delete";

                            } else{
                                echo "</td><td> - </td><td> - </td><td> -";
                            }

                            echo "</td></tr>";
                        }
                    ?>

                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>