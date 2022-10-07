<?php

if (isset($_POST['create'])) {
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

    $user_data = $name . '&' . $email;

    if (empty($name)) {
        header("Location: ../index.php?error=Name is required&$user_data");
    } else if (empty($email)) {
        header("Location: ../index.php?error=Email is required&$user_data");
    } else {
        $sql = "INSERT INTO users(email, name, gender, status)
                VALUES ('$email', '$name', '$gender', '$status')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: ../read.php?success=Successfully created!");
        } else {
            header("Location: ../index.php?error=Unknown error occurred!");
        }
    }
}