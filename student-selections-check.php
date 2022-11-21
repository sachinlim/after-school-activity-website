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
    <link rel='stylesheet' href='css/student-selections-check.css'>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <title>Club Selections Check</title>
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
                <div id=information_text> 

                    <?php
                    $userID = $_SESSION['userID'];
                    echo "<h1> Your selections: </h1><br>";

                    // Showing the Student their selected clubs and filling the array up with the club's day
                    if (isset($_POST["club"])){

                        echo "You have selected Clubs that will clash between one another. <br>
                        Click <a href='clubs.php'><b> here </b></a> to go back to the page to select again. <br>";
                        echo "<br>";

                        $days = array();

                        echo "<div class='box-container'>";
                        foreach($_POST as $clubs) {
                            if( is_array($clubs) ) {
                                foreach($clubs as &$values ) {

                                    $sql = "SELECT * FROM clubs_list WHERE clubID = '$values';";
                                    $result = mysqli_query($conn, $sql);

                                    while ($row = mysqli_fetch_assoc($result)){

                                        echo " <div class='boxes'>";

                                        echo "<div class='club_name'> <b>" . $row['club_name'], "</b> </div>";
        
                                        echo "<div class='club_day'>" . "<b>Day: </b>" . $row['club_day'], 
                                        "<br><b> Time: </b>" . $row['startTime'] . " to ".  $row['endTime']. 
                                        "<br><b> Location: </b>" . $row['club_location'], " </div>";

                                        echo "</div>";

                                        array_push($days, $row['club_day']);
                                    }
                                }
                            } 
                        }
                        echo "</div>";

                        $count = count($days);
                        // $count will be the size of the array. 
                        // array_unique removes duplicate entries in the array

                        // compare the different days for the selected clubs and see if there are clashes
                        if (count(array_unique($days)) == $count){

                            $sql_del = "DELETE FROM student_club_choices WHERE userID = '$userID';";
                            $result = mysqli_query($conn, $sql_del);

                            foreach($_POST as $clubs) {
                                if( is_array($clubs) ) {
                                    foreach($clubs as &$values ) {
                                        
                                        $sql_add = "INSERT INTO student_club_choices (userID, ClubID) VALUES ('$userID', $values)";
                                        $result = mysqli_query($conn, $sql_add);
                                    }
                                } 
                            }

                            header('Location: student.php');

                        } else {
 
                            echo "";
                        }
                    } 
                    else {
                        echo "You selected nothing! <br> Click <a href='clubs.php'>here</a> to go back to the page to select again.";
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
  
</body>
</html>