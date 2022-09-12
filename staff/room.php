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
 if (!isset($_GET['search'])) {
     $sql = 'SELECT * FROM room';
     $result = mysqli_query($con, $sql);

     while ($row = mysqli_fetch_assoc($result)) {
         $array[] = $row;
     }
     $room_list = $array;
 } else {
     $sql =
         "SELECT * FROM room WHERE room_num like '%" . $_GET['search'] . "%'";
     $result = mysqli_query($con, $sql);
     if (mysqli_num_rows($result) <= 0) {
         //  $room_list = $array;
     } else {
         while ($row = mysqli_fetch_assoc($result)) {
             $array[] = $row;
         }
         $room_list = $array;
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
             <h2>Room List</h2>
             <?php if ($_SESSION['access_level'] == 'admin') { ?>
              <a href="../admin/addRoom.php"><button>Add Room</button></a>
            <?php } ?>
             <table>
               <thead>
              </thead>
              <tbody>
                  <?php if (
                      !isset($room_list)
                  ) { ?> No rooms to be matched<?php } else { ?>
                  <?php foreach ($room_list as $row): ?>
                        <tr>
                            
                            <td><?= $row['room_num'] ?></td>
                            <td><?= $row['capacity'] ?></td>
                            <td> - <button 
                            onClick="view_room('<?= $row[
                                'room_num'
                            ] ?>')">View/Book</button></td>
                            <?php if ($_SESSION['access_level'] == 'admin') {
                                echo "
                              <td><button  onClick='editRoom(" .
                              '"' .
                              $row['room_num'] .
                              '"' .
                              ")'>Edit</button></td>
                              <td><button onClick='deleteRoom(" .
                                    '"' .
                                    $row['room_num'] .
                                    '"' .
                                    ")'>Delete</button></td>";
                            } ?>
                          
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
  function view_room(e) {
    var room_num = e;
    window.location.href = "booking.php?room_num="+room_num;
   
  }
  function deleteRoom(room_num) {
    console.log(room_num);
    window.location.href = "../admin/deleteRoom.php?room_num="+room_num;
  }
  function editRoom(room_num) {
    console.log(room_num);
    window.location.href = "../admin/editRoom.php?room_num="+room_num;
  }
  </script>
