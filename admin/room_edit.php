<?php
session_start();
include '../db_conn.php';

if (isset($_GET['room_name']) && isset($_GET['capacity'])) {
    $room_name = $_GET['room_name'];
    $capacity = $_GET['capacity'];

    $sql = "UPDATE room SET capacity='$capacity' WHERE room_num='$room_name'";

    if ($conn->query($sql) === true) {
        echo '<script>alert("Room edited successfully")</script>';
        header('Location: ../staff/room.php');
        exit();
    } else {
        echo '<script>alert("Error")</script>';
        header('Location: ../staff/room.php');
        exit();
    }
} else {
    header('Location: ../staff/room.php');
    exit();
}
