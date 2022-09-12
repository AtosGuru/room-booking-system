<?php
session_start();
include '../db_conn.php';

if (isset($_GET['room_num'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $room_num = $_GET['room_num'];

    $sql = "SELECT * FROM room WHERE room_num='" . $room_num . "'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $sql = "DELETE FROM room WHERE room_num='" . $room_num . "'";

        if ($conn->query($sql) === true) {
            echo '<script>alert("Room deleted successfully")</script>';
            header('Location: ../staff/room.php');
            exit();
        } else {
            echo '<script>alert("Error!!")</script>';
            header('Location: ../staff/room.php');
            exit();
        }
    } else {
        echo "<script>alert('You cant delete this room')</script>";
        header('Location: ../staff/room.php');
        exit();
    }
} else {
    header('Location: ../home.php');
    exit();
}
