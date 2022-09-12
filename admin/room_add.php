<?php
session_start();
include '../db_conn.php';

if (isset($_GET['room_name']) && isset($_GET['capacity'])) {
    $room_name = $_GET['room_name'];
    $capacity = $_GET['capacity'];

    $sql = "INSERT INTO room (room_num, capacity) VALUES('$room_name', '$capacity')";

    if ($conn->query($sql) === true) {
        echo '<script>alert("Room created successfully")</script>';
        header('Location: ../staff/room.php');
        exit();
    } else {
        echo '<script>alert("Error")</script>';
        header('Location: ../staff/room.php');
        exit();
    }
} else {
    header('Location: ./addRoom.php');
    exit();
}
