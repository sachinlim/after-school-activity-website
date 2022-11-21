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
    <link rel='stylesheet' href='css/teacher.css'>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <title>Home</title>
</head>

<body>
    <?php
    include_once "header.php";
    ?>

    <div id="container">
        <div id=background> 
        <img src="images/background/grass-pitch2.jpg" id="bg" alt="">
        </div>

        <div id="introduction">
            <?php
                $userID = $_SESSION['userID'];
                $supervision = $_SESSION['supervision'];

                $sql = "SELECT userID, (AES_DECRYPT(fName, 'ae5tEpd42LoeH5a')), (AES_DECRYPT(sName, 'ae5tEpd42LoeH5a')), (AES_DECRYPT(doB, 'ae5tEpd42LoeH5a')), (AES_DECRYPT(email, 'ae5tEpd42LoeH5a')) 
                FROM users 
                WHERE userID = $userID";
                
                $result = mysqli_query($conn, $sql);
                $checkResults = mysqli_num_rows($result);

                if ($checkResults> 0){
        
                    while ($row = mysqli_fetch_assoc($result)){
                        echo "<h1> Hello, " . $row["(AES_DECRYPT(fName, 'ae5tEpd42LoeH5a'))"] . "! </h1>";
                        echo "<br> The table below represents the students who have signed up for your Club. <br>";
                        $sql2 = "SELECT * FROM clubs_list WHERE clubID = '$supervision';";
                        $result = mysqli_query($conn, $sql2);
                        while ($row = mysqli_fetch_assoc($result)){
                            echo "The club you are supervising is: ". $row["club_name"];
                            echo "<input type='hidden' name='club-name-js' id='club-name-js' value='".$row['club_name']. "'>";
                            echo "<input type='hidden' name='club-name-js' id='club-location-js' value='".$row['club_location']. "'>";
                            echo "<input type='hidden' name='club-name-js' id='club-day-js' value='".$row['club_day']. "'>";
                            echo "<input type='hidden' name='club-name-js' id='club-startTime-js' value='".$row['startTime']. "'>";
                            echo "<input type='hidden' name='club-name-js' id='club-endTime-js' value='".$row['endTime']. "'>";
                        }

                        echo "<br>";  
                        
                    }
                }

            ?>

        </div>
        <button onclick="generatePDF()">Create PDF</button>

        <div id=regtable>
            <div id=table-data>
                <table id="student-table">
                    <thead>
                        <tr>
                            <th> Name </th>
                            <th> Date of Birth </th>
                            <th> Email </th>
                        </tr>
                    </thead>

                    <?php
                        $supervision = $_SESSION['supervision'];

                        $sql = "SELECT student_club_choices.clubID, users.userID, (AES_DECRYPT(fName, 'ae5tEpd42LoeH5a')), (AES_DECRYPT(sName, 'ae5tEpd42LoeH5a')), (AES_DECRYPT(doB, 'ae5tEpd42LoeH5a')), (AES_DECRYPT(email, 'ae5tEpd42LoeH5a')) 
                        FROM users 
                        INNER JOIN student_club_choices 
                        ON users.userID = student_club_choices.userID
                        WHERE student_club_choices.clubID = '$supervision';";

                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);

                        while ($row = mysqli_fetch_assoc($result)){
                            echo "<tr><td>".$row["(AES_DECRYPT(fName, 'ae5tEpd42LoeH5a'))"]. " ". $row["(AES_DECRYPT(sName, 'ae5tEpd42LoeH5a'))"]. 
                            "</td><td>". $row["(AES_DECRYPT(doB, 'ae5tEpd42LoeH5a'))"]. 
                            "</td><td>". $row["(AES_DECRYPT(email, 'ae5tEpd42LoeH5a'))"].
                            "</td></tr>";
                        }
                    ?>

                </table>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
    <script src="https://unpkg.com/jspdf-autotable"></script>
    
    <script> 
    function generatePDF(){
        
        var doc = new jsPDF();

        var club_name = document.getElementById("club-name-js").value; 
        var club_location = document.getElementById("club-location-js").value;
        var club_day = document.getElementById("club-day-js").value;
        var club_startTime = document.getElementById("club-startTime-js").value;
        var club_endTime = document.getElementById("club-endTime-js").value;

        doc.setFontSize(26);
        doc.text(club_name, 15, 17);

        doc.setFontSize(12);
        doc.setTextColor(0);
        doc.text("Club Location:", 15, 27);
        doc.setFontSize(11);
        doc.setTextColor(75);
        doc.text(club_location, 43, 27);

        doc.setFontSize(12);
        doc.setTextColor(0);
        doc.text("Club Day:", 15, 33);
        doc.setFontSize(11);
        doc.setTextColor(75);
        doc.text(club_day, 35, 33);

        doc.setFontSize(12);
        doc.setTextColor(0);
        doc.text("Club Time:", 15, 39);
        doc.setFontSize(11);
        doc.setTextColor(75);
        var club_time = club_startTime + " - " + club_endTime;
        doc.text(club_time, 36, 39);

        doc.autoTable({ 
            html: '#student-table', 
            headStyles: {fillColor: [124, 175, 177]},
            startY: 50,
       
        })
    
        doc.save(club_name+'.pdf')
    }
    </script>
</body>
</html>