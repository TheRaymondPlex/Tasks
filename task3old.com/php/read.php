<?php

include "db_conn.php";

$sql = "SELECT * FROM users ORDER BY status";
$result = mysqli_query($conn, $sql);