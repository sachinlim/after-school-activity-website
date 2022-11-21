<?php

require_once "dbh-conn.php";
require_once "functions.php";


if (isset($_POST["submit"])){

    $fname = $_POST["fname"];
    $sname = $_POST["sname"];
    $doB = $_POST["doB"];
    $email = $_POST["email"];
    $pwd= $_POST["pwd"];
    $utype = $_POST["utype"];
    
    createUser($conn, $fname, $sname, $doB, $email, $pwd, $utype);

}
else {
    echo "error";
    header("location: ../admin.php");
}