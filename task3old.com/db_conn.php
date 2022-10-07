<?php

$sName = "localhost";
$uName = "root";
$password = "1111";
$dbName = "task3base";

$conn = mysqli_connect($sName, $uName, $password, $dbName);

if (!$conn) {
    echo "Connection failed!";
}