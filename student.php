<?php
    include_once "passives/dbh-conn.php";
    session_start();

    # Redirecting users to the correct webpages if they manually enter the web address in
    if ($_SESSION["typeID"] === 2){
        header('Location: teacher.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='css/student.css'>
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
        <div id=background> 
        <img src="images/background/grass-pitch2.jpg" id="bg" alt="">
        </div>

        <div id=information> 
            <div id=information_divL> <!-- left-hand side -->
                <div id=information_text> 

                    <?php
                    $userID = $_SESSION['userID'];

                    $sql = "SELECT userID, (AES_DECRYPT(fName, 'ae5tEpd42LoeH5a')), (AES_DECRYPT(sName, 'ae5tEpd42LoeH5a')), (AES_DECRYPT(doB, 'ae5tEpd42LoeH5a')), (AES_DECRYPT(email, 'ae5tEpd42LoeH5a')) 
                    FROM users 
                    WHERE userID = $userID";

                    
                    $result = mysqli_query($conn, $sql);
                    $checkResults = mysqli_num_rows($result);
                    
                    if ($checkResults> 0){
            
                        while ($row = mysqli_fetch_assoc($result)){
                            echo "<h1> Hello, " . $row["(AES_DECRYPT(fName, 'ae5tEpd42LoeH5a'))"] . "! </h1>";
                            echo "<br> Feel free to <a href='clubs.php'><strong>update</strong></a> your After School Activities until 14/05/2021. <br> After this date, Club selections will be checked and students will be properly allocated before the start of next term.";
                            
                        }
                    }
                    ?>

                    <?php
                    // Information feed being posted by Admin or Teachers

                    echo "<br><br>";
                    echo "<br> <h3>Messages from your Supervisors are below. </h3>";
                    echo "<br>";
                    

                    $userID = $_SESSION['userID'];

                    $sql = "SELECT clubs_list.club_name, student_club_choices.clubID, (AES_DECRYPT(users.fName, 'ae5tEpd42LoeH5a')), (AES_DECRYPT(users.sName, 'ae5tEpd42LoeH5a')), messages.msg_date, messages.msg_time, messages.msg
                    FROM clubs_list 
                    INNER JOIN student_club_choices 
                    ON student_club_choices.clubID = clubs_list.clubID
                    INNER JOIN messages
                    ON clubs_list.clubID = messages.clubID
                    INNER JOIN users
                    ON messages.userID = users.userID
                    WHERE student_club_choices.userID = $userID;";

                    $result = mysqli_query($conn, $sql);
                    $checkResults = mysqli_num_rows($result);
                    
                    if ($checkResults > 0){
                        while ($row = mysqli_fetch_assoc($result)){
                            echo "<b>From: </b>". $row["(AES_DECRYPT(users.fName, 'ae5tEpd42LoeH5a'))"]. " ". $row["(AES_DECRYPT(users.sName, 'ae5tEpd42LoeH5a'))"]. "<br>";
                            echo "<b>Posted on: </b>", $row['msg_date']. " <b>at</b> ". $row['msg_time']. "<br>";
                            echo "<b>Message: </b>". $row['msg']. "<br>";
                            echo "<br>";
                        }
                    } else {
                        echo "<br> No messages to deliver... <br>";
                        
                    }
                    ?>

                </div>
            </div>

            <div id=information_divR> <!-- right-hand side -->
                <div id=information_timetable>
                 <h1> Your Clubs: </h1>
                 <br>

                    <?php
                    $userID = $_SESSION['userID'];
                    
                        $sql = "SELECT clubs_list.club_name, clubs_list.club_location, clubs_list.club_day, clubs_list.startTime, clubs_list.endTime, student_club_choices.clubID, student_club_choices.userID 
                        FROM clubs_list 
                        INNER JOIN student_club_choices 
                        ON student_club_choices.clubID = clubs_list.clubID
                        WHERE student_club_choices.userID = $userID 
                        ORDER BY clubs_list.club_name ASC;";

                        $result = mysqli_query($conn, $sql);
                        $checkResults = mysqli_num_rows($result);

                        if ($checkResults > 0){
                            while ($row = mysqli_fetch_assoc($result)){
                                echo "<div class='boxes'>";

                                echo "<div class='club_name'> <b>" . $row['club_name'], "</b> </div>";

                                echo "<div class='club_day'>" . "<b>Day: </b>" . $row['club_day'], 
                                "<br><b> Time: </b>" . $row['startTime'] . " to ".  $row['endTime']. 
                                "<br><b> Location: </b>" . $row['club_location'], " </div>";

                                echo "<div class='requirements'>" . "<b>Requirements: </b>" . "None" . "</div>";

                                echo "</div>";
                            }
                        } else {
                            echo "<div class='boxes'>";

                                echo "<div class='club_name'> <b>  No Club or Activitiy selected! </b> </div>";


                                echo "<div class='requirements'>" . "Please select clubs and activities from <a href='clubs.php'><strong>here</strong></a> or from the navigation menu. </div>";

                                echo "</div>";
                        }
                    ?>

                </div>
            </div>
        </div>
        </div>
    </div> 
</body>
</html>