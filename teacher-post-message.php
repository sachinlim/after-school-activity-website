<?php
    include_once "passives/dbh-conn.php";
    session_start();

    # Redirecting users to the correct webpages if they manually enter the web address in
    if ($_SESSION["typeID"] === 1){
        header('Location: student.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/teacher-post-message.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <title>Post Messages</title>
</head>
<body>
    <?php
    include_once "header.php";
    ?>

    <div id=container>
        <div id=background> 
        <img src="images/background/grass-pitch2.jpg" id="bg" alt="">
        </div>

        <div id=information>

            <div id="signup-form-L">
            <h2> Send a messge to your students!</h2>


            <form action="passives/teacher_post_message_func.php" method="POST"> 
                <?php
                // matching server time with UK time
                date_default_timezone_set('Europe/London');
                $date = date('m/d/Y', time());
                $time = date('H:i a', time());

                echo "<input type='hidden' name='msg_date' value='" .$date. "'>";
                echo "<input type='hidden' name='msg_time' value='" .$time. "'>";
                echo "<input type='hidden' name='userID' value='" .$_SESSION['userID']. "'>";
                echo "<input type='hidden' name='clubID' value='" .$_SESSION['supervision']. "'>";
                ?>

                <label><br> <b>Message</b> <br></label>
                <textarea name="message" rows="4" cols="40" placeholder="..."></textarea><br>

                <button type="submit" name="submit" id="submit" style='width:60px;height:30px;'>Submit</button><br>
            </form>
            </div>

            <div id="all-users-R">
                <h2>Below are all the Clubs and Activities</h2>

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
                        $userID = $_SESSION["userID"];
                            $sql = "SELECT users.userID, (AES_DECRYPT(users.fName, 'ae5tEpd42LoeH5a')), (AES_DECRYPT(users.sName, 'ae5tEpd42LoeH5a')), clubs_list.club_name, messages.messageID, messages.msg_date, messages.msg_time, messages.msg
                            FROM messages
                            INNER JOIN users
                            ON messages.userID = users.userID
                            INNER JOIN clubs_list
                            ON messages.clubID = clubs_list.clubID
                            WHERE users.userID = '$userID';";

                            $result = mysqli_query($conn, $sql);

                            while ($row = mysqli_fetch_assoc($result)){
                                echo "<tr>
                                        <td>".$row['club_name']. 
                                        "</td><td>".$row["(AES_DECRYPT(users.fName, 'ae5tEpd42LoeH5a'))"]. " ". $row["(AES_DECRYPT(users.sName, 'ae5tEpd42LoeH5a'))"].
                                        "</td><td>".$row['msg_date'].
                                        "</td><td>".$row['msg_time'].
                                        "</td><td>".$row['msg'].
                                        "</td><td><a href='passives/teacher_delete_message_func.php?id=$row[messageID]'>Delete".
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