<?php
session_start();
include '../db_conn.php';

if (
    isset($_GET['room_name']) &&
    isset($_GET['start_time']) &&
    isset($_GET['end_time'])
) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $room_name = $_GET['room_name'];
    $start_time = $_GET['start_time'];
    $end_time = $_GET['end_time'];
    $user_name = $_SESSION['user_name'];

    $sql = "INSERT INTO booking (user_name, room_name, start_time, end_time) VALUES('$user_name', '$room_name', '$start_time', '$end_time')";

    if ($conn->query($sql) === true) {
        echo '<script>alert("New booking created successfully")</script>';
        header('Location: ../home.php');
        exit();
    } else {
        echo '<script>alert("Error")</script>';
        header('Location: ../home.php');
        exit();
    }
} else {
    header('Location: ../home.php');
    exit();
}
