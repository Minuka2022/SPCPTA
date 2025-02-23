<?php

$serverName = "localhost";
$DBusername = "root";
$DBpassword = "";
$DBname = "spcptadb";

$conn = new mysqli($serverName, $DBusername, $DBpassword, $DBname);
if ($conn->connect_error) {
    echo "Failed to connect: " .mysqli_connect_error();
}

