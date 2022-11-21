<?php

require_once "dbh-conn.php";
require_once "functions.php";


if (isset($_POST["submit"])){

    $clubID = $_POST["clubID"];
    $userID = $_POST["userID"];

    createSupervisor($conn, $clubID, $userID);

}