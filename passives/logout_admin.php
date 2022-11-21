<?php
include_once "dbh-conn.php";

session_start();
session_unset();

$_SESSION = array();

$sql = "UPDATE users SET fName = AES_ENCRYPT(fName,'ae5tEpd42LoeH5a'), sName = AES_ENCRYPT(sName,'ae5tEpd42LoeH5a'), doB = AES_ENCRYPT(doB,'ae5tEpd42LoeH5a'), email = AES_ENCRYPT(email,'ae5tEpd42LoeH5a');";
$result = mysqli_query($conn, $sql);

session_destroy();

header("location: ../index.php");
exit();