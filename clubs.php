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
    <link rel="stylesheet" href="css/clubs.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <title>Clubs</title>
</head>
<body>
    <?php
    include_once "header.php";
    ?>

    <div id=container> 
        <div id=introduction> 
            <div id=intro-text>
            <h1> After School Activities</h1>

            <?php
                $userID = $_SESSION['userID'];
               
                $sql = "SELECT clubs_list.club_name, clubs_list.club_location, clubs_list.club_day, clubs_list.startTime, clubs_list.endTime, student_club_choices.clubID, student_club_choices.userID 
                FROM clubs_list 
                INNER JOIN student_club_choices 
                ON student_club_choices.clubID = clubs_list.clubID 
                WHERE student_club_choices.userID = $userID 
                ORDER BY clubs_list.club_name ASC;";

                echo "<br> Your current selected clubs are: ";

                $result = mysqli_query($conn, $sql);
                $checkResults = mysqli_num_rows($result);
                

                if ($checkResults > 0){
                    while ($row = mysqli_fetch_assoc($result)){
                        echo "<div class='current_clubs'>";
                        echo "<b>" . $row['club_name'] . " (" . $row["club_day"] . ") </b>";
        
                    }
                } else {
                    echo "<div class='current_clubs'>";
                    echo "<b> None </b>";
                    
                }
            ?>

            <p><br>Once you press Submit at the bottom of this page, you will be taken to the homepage if there are <b>no clashes.</b> </p>

            </div id=into-text>

        </div> <!-- close introduction -->
        <div id=clubs> 
            <?php
                $sql = "SELECT * FROM clubs_list;";
                $result = mysqli_query($conn, $sql);
                $checkResults = mysqli_num_rows($result);

                if ($checkResults > 0){
                    while ($row = mysqli_fetch_assoc($result)){

                        echo "<form method='POST' id='form' action='student-selections-check.php'>";
                        // echo "<form method='POST' id='form' action='./passives/update_clubs.php'>";
                        echo "<div class='boxes'>";

                        echo "<div class='club_name'>";
                        echo $row["club_name"], "</div>";

                        echo "<div class='club_day'>"; 
                        echo "<b>Day: </b> <input type='hidden' name='day' value=$row[club_day]>$row[club_day]", "</div>";

                        echo "<div class='club_time'>"; 
                        echo "<b>Time: </b>" .$row['startTime']. " to " . $row['endTime'] . "<br>" . "<b>Location: </b>" . $row["club_location"], "<br><b>Club Reference: </b>" . $row["clubID"],  "</div>";

                        echo "<div class='club_description'>"; 
                        echo "<b>Description</b>" . "<br>" . $row["club_description"], "</div>";

                        echo "<div class='check_boxes'>";
                        echo "<input type='checkbox' name='club[]' value=$row[clubID]> Choose $row[club_name]";

                        echo "</div>", "</div>"; // close submit_form. close boxes.

                    } // end of while loop

                    echo "</form>"; // close form outside of the while loop so that the form doesn't close before all clubs have been listed
                } 
                
            ?>

            </div> <!-- close clubs -->
            
            <!-- Below the form -->
            <?php
                echo "<button type='submit' form='form' style='width:125px;height:50px;'>Submit Choices!</button>";
            ?>

    </div> <!-- close container -->

</body>
</html>