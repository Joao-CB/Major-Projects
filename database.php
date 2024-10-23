<?php

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "major project database";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("Something went wrong;");
}

?>