<?php

$serverName = "localhost";
$DBusername = "spcptalk_root";
$DBpassword = "#SPCPTALK#2024";
$DBname = "spcptalk_ecommerce";

$conn = new mysqli($serverName, $DBusername, $DBpassword, $DBname);
if ($conn->connect_error) {
    echo "Failed to connect: " .mysqli_connect_error();
}

