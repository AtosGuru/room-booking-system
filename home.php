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

 // fetch records
 if ($_SESSION['access_level'] == 'staff') {
     $sql =
         "SELECT * FROM booking WHERE user_name='" .
         $_SESSION['user_name'] .
         "' ";
     $result = mysqli_query($con, $sql);

     if (mysqli_num_rows($result) > 0) {
         while ($row = mysqli_fetch_assoc($result)) {
             $array[] = $row;
         }
         $up_booking = $array;
     }
 } elseif ($_SESSION['access_level'] == 'admin') {
     $sql = 'SELECT * FROM booking';
     $result = mysqli_query($con, $sql);

     if (mysqli_num_rows($result) > 0) {
         while ($row = mysqli_fetch_assoc($result)) {
             $array[] = $row;
         }
         $up_booking = $array;
     }
 }
 ?>
<!DOCTYPE html>
<html>
     <head>
          <title>HOME</title>
          <link rel="stylesheet" type="text/css" href="style.css">
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
               <span>(<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>)</span>
                    </h1>
               
				
			</div>
		</nav>
		<div class="content" style="max-width:500px; margin:auto">
           
               <hr/>
                         <input hidden id="access_level" value="<?= $_SESSION[
                             'access_level'
                         ] ?>">
                         <h2>Find Room</h2>
                              <div>
                                   <input type="text" placeholder="search" id="search"/>
                                   <button onClick="search_room()">Search</button>
                                   <a href="staff/room.php"><button>List Rooms</button></a>
                              </div>
                         <hr/>
                         <?php if ($_SESSION['access_level'] === 'admin') {
                             echo '<h2>Upcoming Your Bookings</h2>';
                         } elseif ($_SESSION['access_level'] === 'staff') {
                             echo '<h2>Upcoming All Bookings</h2>';
                         } ?>
                          
                         <table>
                              <thead>
               </thead>
               <tbody>
                    
                    <?php if (isset($up_booking)) {
                        foreach ($up_booking as $row): ?>
                         <tr>
                              
                              <td><?= $row['room_name'] ?></td>
                              <td><?= $row['start_time'] ?></td>
                              <td><?= $row['end_time'] ?></td>
                              <td> - <button onClick="deleteBooking('<?= $row[
                                  'booking_id'
                              ] ?>')">Cancel</button></td>
                         </tr>
                    <?php endforeach;
                    } else {
                        echo '<p>No upcoming bookings!</p>';
                    } ?>
               </tbody>
               </table>
             <hr/>
             
          </div>
	</body>
   
</html>

<?php } else {header('Location: index.php');
    exit();}
?>
<script>
     var access_level = document.querySelector("#access_level");
     function search_room () {
          var search = document.querySelector("#search").value;
          sessionStorage.setItem('search', search);
          window.location.href= "staff/room.php?search="+search;
     }

     function deleteBooking(booking_id) {
          if(access_level = "admin") {
               window.location.href= "admin/deleteBooking.php?booking_id="+booking_id;
          } else {
               window.location.href= "staff/deleteBooking.php?booking_id="+booking_id;
          }
          
     }
</script>
