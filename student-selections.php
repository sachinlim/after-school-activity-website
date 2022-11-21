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
    <link rel="stylesheet" href="css/admin-student-selections.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <title>Student Selections</title>
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
                        <form id="form" action="passives/create_student_selection_func.php" method="POST">

                            <label>User:</label>
                            <select name="userID"> 
                                <option>Select User</option>
                                <?php
                                    $sql = "SELECT * FROM users WHERE typeID = 1;";
                                    $result = mysqli_query($conn, $sql);

                                    while ($row = mysqli_fetch_assoc($result)){
                                        echo "<option value='" . $row['userID']. "'>" . $row['userID']. " &nbsp;&nbsp; ". $row['fName']. " ". $row['sName']."</option>";
                                    }
                                ?>

                            </select>
                            <br>

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
                            <button type="submit" name="submit" id="submit" style='width:60px;height:30px;'>Submit</button><br>
                        </form>

                        <p><br>Click <b><a href="admin.php"> here </a></b> to add more Users.</p>
                </section>
            </div>

            <div id="all-users-R">
                <h2>Below are all Students and their Club/Activity selection</h2><br>
                <p>For students that do not have a Club selected, they do not have a Delete button.</p>

                <div id=table-data>
                    <table>
                        <thead>
                            <tr>
                                <th> User ID </th>
                                <th> Student Name </th>
                                <th> Email </th>
                                <th> Club ID </th>
                                <th> Club Name </th>
                                <th> Club Day </th>
                                <th> Action </th>
                            </tr>
                        </thead>

                    <?php
                        $userID = $_SESSION["userID"];

                        $sql = "SELECT users.userID, users.fName, users.sName, users.email, student_club_choices.clubID, clubs_list.club_name, clubs_list.club_day
                        FROM users
                        LEFT JOIN student_club_choices
                        ON users.userID = student_club_choices.userID
                        LEFT JOIN clubs_list
                        ON clubs_list.clubID = student_club_choices.clubID
                        WHERE users.typeID = 1
                        ORDER BY users.userID ASC;";

                        $result = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_assoc($result)){
                            echo "<tr>
                            <td>".$row['userID']. "</td><td>".$row['fName'] . " " . $row['sName']. "</td><td>".$row['email'];

                            if (strlen($row['clubID'] > 1)) {
                                echo "</td><td>".$row['userID'] . "</td><td>".$row['club_name']. "</td><td>".$row['club_day'].
                                "</td><td><a href='passives/delete_student_selection_func.php?user=$row[userID]&club=$row[clubID]'>Delete";

                            } else{
                                echo "</td><td> - </td><td> - </td><td> - </td><td> -";
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