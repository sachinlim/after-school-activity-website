<?php

require_once "dbh-conn.php";
require_once "functions.php";

$clubID = $_POST["clubID"];
$userID = $_POST["userID"];

createStudentSelection($conn, $clubID, $userID);