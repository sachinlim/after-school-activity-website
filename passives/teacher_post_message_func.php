<?php

require_once "dbh-conn.php";
require_once "functions.php";

if (isset($_POST["submit"])) {
    $msg_date = $_POST["msg_date"];
    $msg_time = $_POST["msg_time"];
    $userID = $_POST["userID"];
    $clubID = $_POST["clubID"];

    $message = $_POST["message"];
    
    echo $msg_date . " time: " . $msg_time;
    echo $message, $userID;

    postMessage($conn, $msg_date, $msg_time, $message, $userID, $clubID);
}