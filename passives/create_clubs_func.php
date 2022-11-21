<?php

require_once "dbh-conn.php";
require_once "functions.php";


if (isset($_POST["submit"])){

    $club_name = $_POST["club_name"];
    $location = $_POST["location"];
    $club_day = $_POST["club_day"];
    $startTime = $_POST["startTime"];
    $endTime = $_POST["endTime"];
    $description = $_POST["description"];

    createClub($conn, $club_name, $location, $club_day, $startTime, $endTime, $description);

}