<?php
session_start();
include 'db_conn.php';

if (isset($_POST['uname']) && isset($_POST['password'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);

    // hashing the password
    // $pass = md5($pass);

    $sql = "SELECT * FROM user WHERE user_name='$uname' AND password='$pass'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if ($row['user_name'] === $uname && $row['password'] === $pass) {
            $_SESSION['user_name'] = $row['user_name'];
            $_SESSION['access_level'] = $row['access_level'];
            $_SESSION['first_name'] = $row['firstname'];
            $_SESSION['last_name'] = $row['lastname'];
            $_SESSION['id'] = $row['id'];
            if ($_SESSION['access_level'] == 'staff') {
                header('Location: home.php');
                exit();
            } elseif ($_SESSION['access_level'] == 'admin') {
                header('Location: home.php');
                exit();
            }
        } else {
            echo "<script>alert('Incorrect username or password!')</script>";
            header('Location: index.php');
            exit();
        }
    } else {
        echo "<script>alert('Incorrect username or password!')</script>";
        header('Location: index.php');
        exit();
    }
} else {
    header('Location: index.php');
    exit();
}
