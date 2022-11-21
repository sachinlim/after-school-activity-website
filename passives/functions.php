<?php

header('Location: ../index.php');

function createUser($conn, $fname, $sname, $doB, $email, $pwd, $utype) {
    $sql = "INSERT INTO users (fName, sName, doB, email, pwd, typeID) VALUES (?, ?, ?, ?, ?, ?);";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin.php?error=statementError");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssssss", $fname, $sname, $doB, $email, $hashedPwd, $utype);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../admin.php?signup=success");

    exit();

}

function deleteUser($conn, $userID){
    $sql1 = "DELETE FROM student_club_choices WHERE userID = '$userID';";
    $sql2 = "DELETE FROM club_supervisors WHERE userID = '$userID';";
    $sql3 = "DELETE FROM messages WHERE userID = '$userID';";
    $sql4 = "DELETE FROM users WHERE userID = '$userID';";

    $stmt1 = mysqli_query($conn, $sql1);
    $stmt2 = mysqli_query($conn, $sql2);
    $stmt3 = mysqli_query($conn, $sql3);
    $stmt4 = mysqli_query($conn, $sql4);

    header("location: ../admin.php?deletion=success");

}

function createClub($conn, $club_name, $location, $club_day, $startTime, $endTime, $description){
    $sql = "INSERT INTO clubs_list (club_name, club_location, club_day, startTime, endTime, club_description) VALUES (?, ?, ?, ?, ?, ?);";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../create-clubs.php?error=statementError");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssssss", $club_name, $location, $club_day, $startTime, $endTime, $description);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../create-clubs.php?club-creation=success");
    
}

function deleteClub($conn, $clubID){
    $sql1 = "DELETE FROM student_club_choices WHERE clubID = '$clubID';";
    $sql2 = "DELETE FROM clubs_list WHERE clubID = '$clubID';";

    $stmt1 = mysqli_query($conn, $sql1);
    $stmt2 = mysqli_query($conn, $sql2);

    header("location: ../create-clubs.php?club-deletion=success");

}

function createSupervisor($conn, $clubID, $userID){
    $sql = "INSERT INTO club_supervisors(clubID, userID) VALUES ($clubID, $userID)";
    $stmt = mysqli_query($conn, $sql);

    header("location: ../supervisors.php?supervisor-creation=success");
 
}

function deleteSupervisor($conn, $supervisorID){
    $sql = "DELETE FROM club_supervisors WHERE supervisorID = '$supervisorID';";
    $stmt = mysqli_query($conn, $sql);

    header("location: ../supervisors.php?supervisor-deletion=success");
 
}

function emailExists($conn, $email) {
    $sql = "SELECT * FROM users WHERE email = (AES_ENCRYPT(?, ?));";

    $stmt = mysqli_stmt_init($conn);
    $key = "ae5tEpd42LoeH5a";

    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../admin.php?error=emailExists");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $email, $key);
    mysqli_stmt_execute($stmt);

    $checkEmails = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($checkEmails)){
        return $row;
    }
    else {
        $result = false;
        return $result;
    }

}

function loginUser($conn, $email, $pwd){
    $emailExists = emailExists($conn, $email);

    if ($emailExists === false){
        header("location: ../index.php?error=wrongEmail");
        exit();
    }

    $pwdHashed = $emailExists["pwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false){
        header("location: ../index.php?error=wrongPassword");
        exit();
    } 
    
    else if ($checkPwd === true) {
        
        session_start();
        $_SESSION["typeID"] = $emailExists["typeID"];
        $_SESSION["fName"] = $emailExists["fName"];
        $_SESSION["userID"] = $emailExists["userID"];

        switch($_SESSION["typeID"]){
            case 1: 
                header("location: ../student.php");
                break;
            case 2:

                $userID_for_supervision = $_SESSION["userID"];

                $sql = "SELECT * FROM club_supervisors WHERE userID = '$userID_for_supervision';";
                $result = mysqli_query($conn, $sql);


                $row = mysqli_fetch_assoc($result);
                if ($row) {
                    $_SESSION["supervision"] = $row['clubID'];
                } else {
                    $_SESSION["supervision"] = "none";
                }

                header("location: ../teacher.php");

                break;
            case 3:
                header("location: ../admin.php");

                $sql = "UPDATE users SET fName = AES_DECRYPT(fName,'ae5tEpd42LoeH5a'), sName = AES_DECRYPT(sName,'ae5tEpd42LoeH5a'), doB = AES_DECRYPT(doB,'ae5tEpd42LoeH5a'), email = AES_DECRYPT(email,'ae5tEpd42LoeH5a');";
                $result = mysqli_query($conn, $sql);
        
                break;

        }
        
        exit();
        
    }


}

function postMessage($conn, $msg_date, $msg_time, $message, $userID, $clubID) {
    $sql = "INSERT INTO messages(msg_date, msg_time, msg, userID, clubID) VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../teacher.php?error=statementError");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssss", $msg_date, $msg_time, $message, $userID, $clubID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../teacher-post-message.php?club-creation=success");

}

function adminDeleteMessage($conn, $messageID){
    $sql = "DELETE FROM messages WHERE messageID = '$messageID';";
    $stmt = mysqli_query($conn, $sql);

    header("location: ../admin-view-messages.php?message-deletion=success");
 
}

function teacherDeleteMessage($conn, $messageID){
    $sql = "DELETE FROM messages WHERE messageID = '$messageID';";
    $stmt = mysqli_query($conn, $sql);

    header("location: ../teacher-post-message.php?message-deletion=success");
 
}

function createStudentSelection($conn, $clubID, $userID){
    $sql = "INSERT INTO student_club_choices(clubID, userID) VALUES ($clubID, $userID)";
    $stmt = mysqli_query($conn, $sql);

    header("location: ../student-selections.php?selection-creation=success");

}

function deleteStudentSelection($conn, $userID, $clubID){
    $sql = "DELETE FROM student_club_choices WHERE userID = '$userID' AND clubID = '$clubID';";
    $stmt = mysqli_query($conn, $sql);

    header("location: ../student-selections.php?selection-deletion=success");
 
}