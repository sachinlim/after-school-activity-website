<?php

require_once "dbh-conn.php";
require_once "functions.php";

$userID = $_GET['id'];

deleteUser($conn, $userID);