<?php
include_once "dbh-conn.php";
session_start();
$userID = $_SESSION['userID']; // user ID must exist in the users table for this to work 

// Selection of clubs and saving it to the database
if (isset($_POST["club"])){

    $sql_del = "DELETE FROM student_club_choices WHERE userID = '$userID';";

    if ($conn->query($sql_del) == TRUE) {
        echo "Club choices have been deleted <br>";
    }

    $days = array();
    $count = 0;

    foreach($_POST as $clubs) {
        if( is_array($clubs) ) {
            foreach($clubs as &$values ) {
                echo $values;

                // checking for clashes

                $sql = "SELECT * FROM clubs_list WHERE clubID = '$values';";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)){
                    echo "name: ". $row['club_name'];
                    echo "<br>day: ". $row['club_day'];
                    array_push($days, $row['club_day']);
                }
            }
        } 
    }

    print_r($days);

    foreach($_POST as $clubs) {
        if( is_array($clubs) ) {
            foreach($clubs as &$values ) {
                echo "<br>". $values;

                $sql_add = "INSERT INTO student_club_choices (userID, ClubID) VALUES ('$userID', $values)";
                if ($conn->query($sql_add) == TRUE) {
                    echo "<br>Club choices have been added! <br>";
                }
            }
        } 
    }

    header("refresh:60; url=../clubs.php");
    /* header("location: ../clubs.php"); */

} 
else {
    echo "<br> nothing selected! <br>";
}