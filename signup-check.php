<?php
session_start();
include 'db_conn.php';

if (
    isset($_POST['uname']) &&
    isset($_POST['password']) &&
    isset($_POST['firstname']) &&
    isset($_POST['lastname']) &&
    isset($_POST['telephone']) &&
    isset($_POST['re_password'])
) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);

    $re_pass = validate($_POST['re_password']);
    $firstname = validate($_POST['firstname']);
    $lastname = validate($_POST['lastname']);
    $telephone = validate($_POST['telephone']);

    $user_data = 'uname=' . $uname . '&firstname=' . $firstname;

    // hashing the password
    // $pass = md5($pass);

    $sql = "SELECT * FROM user WHERE user_name='$uname' ";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('The username is taken, try another')</script>";
        header('Location: signup.php');
        exit();
    } else {
        $sql2 = "INSERT INTO user(user_name, password, firstname, lastname, telephone) VALUES('$uname', '$pass', '$firstname', '$lastname', '$telephone')";
        $result2 = mysqli_query($conn, $sql2);
        if ($result2) {
            echo "<script>alert('success')</script>";
            header('Location: login.php');
            exit();
        } else {
            echo "<script>alert('error!')</script>";
            header('Location: signup.php');
            exit();
        }
    }
} else {
    header('Location: signup.php');
    exit();
}
