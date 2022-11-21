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
    <title>View All Messages</title>
</head>

<body>
    <?php
    include_once "header.php";
    ?>

    <div id=container>
        <div id=information>
            <div id="signup-form-L">
            </div>

            <div id="all-users-R">
                <h2>Below are all the messages Teachers/Supervisors have posted.</h2>

                <div id=table-data>
                    <table>
                        <thead>
                            <tr>
                                <th> Club Name </th>
                                <th> Supervisor </th>
                                <th> Date </th>
                                <th> Time </th>
                                <th> Description </th>

                                <th> Action </th>
                            </tr>
                        </thead>

                    <?php
                            $sql = "SELECT users.fName,users.sName, clubs_list.club_name, messages.messageID, messages.msg_date, messages.msg_time, messages.msg
                            FROM messages
                            INNER JOIN users
                            ON messages.userID = users.userID
                            INNER JOIN clubs_list
                            ON messages.clubID = clubs_list.clubID";

                            $result = mysqli_query($conn, $sql);

                            while ($row = mysqli_fetch_assoc($result)){
                                echo "<tr>
                                        <td>".$row['club_name']. 
                                        "</td><td>".$row['fName']. " " . $row['sName'].
                                        "</td><td>".$row['msg_date'].
                                        "</td><td>".$row['msg_time'].
                                        "</td><td>".$row['msg'].
                                        "</td><td><a href='passives/admin_delete_message_func.php?id=$row[messageID]'>Delete".
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