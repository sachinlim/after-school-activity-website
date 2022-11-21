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
    <link rel="stylesheet" href="css/admin-create-clubs.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <title>Create Clubs</title>
</head>

<body>
    <?php
    include_once "header.php";
    ?>

    <div id=container>
        <div id=information>

            <div id="signup-form-L">
            <h2>Add Clubs & Activities </h2>
                <section class="add-clubs-form">
                        <form id="form" action="passives/create_clubs_func.php" method="POST">

                            <label>Club Name:</label>
                            <input type="text" name="club_name" id="club_name" placeholder="Tennis" style="text-transform: capitalize;"> <br>

                            <label>Location:</label>
                            <input type="text" name="location" id="location" placeholder="Tennis Courts" style="text-transform: capitalize;"><br>

                            <label>Day:</label>
                            <input type="text" name="club_day" id="club_day" placeholder="Tuesday" style="text-transform: capitalize;"><br>

                            <label>Start Time:</label>
                            <input type="text" name="startTime" id="startTime" placeholder="15:45"><br>

                            <label>End Time:</label>
                            <input type="text" name="endTime" id="endTime" placeholder="17:00"><br>

                            <label>Description:</label>
                            <textarea name="description" id="description" rows="4" cols="27" placeholder="Coaching session..."></textarea> <br>
                            
                            <button type="submit" name="submit" id="submit" style='width:60px;height:30px;'>Submit</button><br>

                        </form>

                        <p><br>Click <b><a href="supervisors.php"> here </a></b> to allocate a supervisor for the clubs</p>
                </section>
            </div>

            <div id="all-users-R">
                <h2>Below are all the Clubs and Activities</h2>

                <div id=table-data>
                    <table>
                        <thead>
                            <tr>
                                <th> Club Name </th>
                                <th> Location </th>
                                <th> Day </th>
                                <th> Time </th>
                                <th> Description </th>
                                <th> Supervisor </th>
                                <th> Action </th>
                            </tr>
                        </thead>

                    <?php
                            $sql = "SELECT * from clubs_list;";

                            $result = mysqli_query($conn, $sql);

                            while ($row = mysqli_fetch_assoc($result)){
                                echo "<tr>
                                        <td>".$row['club_name']. 
                                        "</td><td>".$row['club_location'].
                                        "</td><td>".$row['club_day'].
                                        "</td><td>".$row['startTime']. " - " . $row['endTime'].
                                        "</td><td>".$row['club_description'].
                                        "</td><td>".
                                        "</td><td><a href='passives/delete_club_func.php?id=$row[clubID]'>Delete".
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