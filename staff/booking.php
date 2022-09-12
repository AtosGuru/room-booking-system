<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) { ?>
 <?php
 // db settings
 $hostname = 'localhost';
 $username = 'root';
 $password = '';
 $database = 'test_db';

 // db connection
 ($con = mysqli_connect($hostname, $username, $password, $database)) or
     die('Error ' . mysqli_error($con));

 function deleteBooking()
 {
     if (isset($_GET['del_name'])) {
         $sql =
             "DELETE FROM booking WHERE room_num='" . $_GET['del_name'] . "'";

         if ($con->query($sql) === true) {
             echo "<script>alert('deleted successfully')</script>";
             header('Location: ../home.php');
             exit();
         } else {
             echo 'Error deleting record: ' . $conn->error;
         }
     }
 }

 // fetch records
 if (!isset($_GET['room_num'])) {
 } else {
     $sql = "SELECT * FROM room WHERE room_num='" . $_GET['room_num'] . "'";

     $result = mysqli_query($con, $sql);

     if (mysqli_num_rows($result) === 1) {
         $row = mysqli_fetch_assoc($result);
     }
     $capacity = $row['capacity'];

     $sql = "SELECT * FROM booking WHERE room_name='" . $_GET['room_num'] . "'";

     $result = mysqli_query($con, $sql);
     if (mysqli_num_rows($result) <= 0) {
         //  $room_list = $array;
     } else {
         while ($row = mysqli_fetch_assoc($result)) {
             $array[] = $row;
         }
         $booking_list = $array;
     }
 }
 ?>
<!DOCTYPE html>
<html>
     <head>
          <title>HOME</title>
          <link rel="stylesheet" type="text/css" href="../style.css">
     </head>
     <style>
          body {
               display: block;
          }
     </style>
     <body class="loggedin">
		<nav class="navtop">
			<div>
                    <h1>ECU Room Booking System-<?php if (
                        isset($_SESSION['access_level'])
                    ) {
                        echo $_SESSION['access_level'];
                    } ?> Interface</h1>
				<h1>Welcome <?php if (
        isset($_SESSION['first_name']) &&
        isset($_SESSION['last_name'])
    ) {
        echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];
    } ?>
               <span>(<a href="../logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>)</span>
                    </h1>
               
				
			</div>
		</nav>
		<div class="content" style="max-width:500px; margin:auto">
            <hr/>
             <h2>Details of <span id="room_name"><?= $_GET[
                 'room_num'
             ] ?></span></h2>
             <p>Capacity: <?= $capacity ?></p>
             <hr/>
             <h2>New Bookings for <?= $_GET['room_num'] ?></h2>
                <label>Start Time:</label>
                <input type="datetime-local" id="start_time" />
                <br/>
                <label>End Time:</label>
                <input type="datetime-local" id="end_time" />
                <br/>
                <button onClick="bookingNew()">Submit</button>
             <hr/>
             <h2>Upcoming Bookings for <?= $_GET['room_num'] ?></h2>
             <table>
               <thead>
              </thead>
              <tbody>
                  <?php if (
                      !isset($booking_list)
                  ) { ?> No bookings to be matched<?php } else { ?>
                  <?php foreach ($booking_list as $row): ?>
                        <tr>
                            
                            <td><?= $row['start_time'] ?></td>
                            <td><?= $row['end_time'] ?></td>
                            <td><?= $row['user_name'] ?></td>
                            <?php if (
                                $_SESSION['access_level'] === 'admin'
                            ) { ?>
                                <td><button onClick="deleteBooking('<?= $row[
                                    'booking_id'
                                ] ?>')">delete</button></td>
                            <?php } ?>
                          
                        </tr>
                  <?php endforeach;} ?>
              </tbody>
              </table>
             <hr/>
          </div>
          <a href="../home.php">Back</a>
	</body>
   
</html> 

<?php } else {header('Location: index.php');
    exit();}
?>

<script>
    var getFullMonth = function(today) {
    const month = today.getMonth()+1
    return month < 10 ? '0'+month : month
    }
    var getFullDate = function(today) {
    const date = today.getDate()+1
    return date < 10 ? '0'+date : date
    }
    var getFullHours = function(today) {
    const hours = today.getHours();
    return hours < 10 ? '0'+hours : hours
    }
    var getFullMinutes = function(today) {
    const minutes = today.getMinutes();
    return minutes < 10 ? '0'+minutes : minutes
    }
    function deleteBooking(booking_id) {
        window.location.href= "../admin/deleteBooking.php?booking_id="+booking_id;
    }
    function bookingNew() {
        var starttime = document.querySelector("#start_time").value;
        var endtime = document.querySelector("#end_time").value;
        var room_name = document.querySelector("#room_name").innerHTML;

        var today = new Date();

        var date = today.getFullYear()+'-'+(getFullMonth(today))+'-'+getFullDate(today);

        var time = getFullHours(today) + ":" + getFullMinutes(today);

        var dateTime = date+'T'+time;
        
        console.log(dateTime);
        console.log(starttime);
        console.log(room_name);

        if(starttime == '') {
            alert("Start Time must be filled!");
        } else if(endtime == '') {
            alert("End Time must be filled!"); 
        } else if(starttime > endtime) {
            alert("End time must be later than Start time");
        } else if(starttime < dateTime) {
            alert("start time must be later than current time");
        } else {
            window.location.href = "bookingNew.php?room_name="+room_name+"&start_time="+starttime+"&end_time="+endtime;
        }
    }
</script>