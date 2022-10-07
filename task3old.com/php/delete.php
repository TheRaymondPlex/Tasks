<?php

if (isset($_GET['email'])) {

    include "../db_conn.php";

    function validate($data) {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = validate($_GET['email']);

    $sql = "DELETE FROM users WHERE email='$email';";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: ../read.php?success=Successfully deleted!");
    } else {
        header("Location: ../read.php?error=Unknown error occurred!");
    }
} else {
    header("Location: ../read.php");
}