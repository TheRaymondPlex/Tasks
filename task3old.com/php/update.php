<?php

if (isset($_GET['email'])) {
    include "db_conn.php";

    function validate($data) {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = validate($_GET['email']);

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        header("Location: read.php");
    }

} else if (isset($_POST['update'])) {
    include "../db_conn.php";

    function validate($data) {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = validate($_POST['email']);
    $name = validate($_POST['name']);
    $gender = $_POST['selectGender'];
    $status = $_POST['selectStatus'];
    $emailOld = $_POST['emailOld'];

    if (empty($name)) {
        header("Location: ../update.php?email=$emailOld&error=Name is required");
    } else if (empty($email)) {
        header("Location: ../update.php?email=$emailOld&error=Email is required");
    } else {

        $sql = "UPDATE users
                SET email='$email', name='$name', gender='$gender', status='$status'
                WHERE email='$emailOld';";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: ../read.php?success=Successfully updated!");
        } else {
            header("Location: ../index.php?error=Unknown error occurred!");
        }
    }
} else if (isset($_POST['cancel'])) {
    header("Location: ../read.php");
} else {
    header("Location: read.php");
}