<?php

require_once "dbh-conn.php";
require_once "functions.php";

$clubID = $_GET['id'];

deleteClub($conn, $clubID);