<?php

require_once "dbh-conn.php";
require_once "functions.php";

$messageID = $_GET['id'];

adminDeleteMessage($conn, $messageID);