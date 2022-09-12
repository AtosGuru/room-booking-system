<?php
session_start();
include '../db_conn.php';

if (isset($_GET['booking_id'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $booking_id = $_GET['booking_id'];
    $user_name = $_SESSION['user_name'];
    $sql =
        "SELECT * FROM booking WHERE booking_id='" .
        $booking_id .
        "' and user_name = '" .
        $user_name .
        "'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $sql = "DELETE FROM booking WHERE booking_id='" . $booking_id . "'";

        if ($conn->query($sql) === true) {
            echo '<script>alert("Booking deleted successfully")</script>';
            header('Location: ../home.php');
            exit();
        } else {
            echo '<script>alert("Error!!")</script>';
            header('Location: ../home.php');
            exit();
        }
    } else {
        echo "<script>alert('You cant delete this booking')</script>";
        header('Location: ../home.php');
        exit();
    }
} else {
    header('Location: ../home.php');
    exit();
}
