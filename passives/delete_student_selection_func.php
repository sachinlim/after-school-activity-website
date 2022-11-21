<?php

require_once "dbh-conn.php";
require_once "functions.php";

$userID = $_GET['user'];
$clubID = $_GET['club'];

deleteStudentSelection($conn, $userID, $clubID);