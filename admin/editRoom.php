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
if (!isset($_GET['room_num'])) {
} else {
    $sql = "SELECT * FROM room WHERE room_num='" . $_GET['room_num'] . "'";

    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
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
             <h2>Edit Room</h2>
              <label>Room Name</label>
              <input type="text" placeholder="Room Name" id="room_name" value="<?= $row[
                  'room_num'
              ] ?>" disabled />
              <br/>
              <label>Capacity</label>
              <input type="number" placeholder="Capacity" id="capacity" value="<?= $row[
                  'capacity'
              ] ?>"/>
              <br/>
              <button onClick="editRoom()">Save Changes</button>
             <hr/>
          </div>
          <a href="../home.php">Back</a>
	</body>
   
</html> 

<?php } else {header('Location: index.php');
    exit();}
?>

<script>
  function editRoom() {
    var room_name = document.querySelector("#room_name").value;
    var capacity = document.querySelector("#capacity").value;
    
    if(room_name == '') {
      alert("Room Name must be filled!");
    } else if (capacity == '') {
      alert("Capacity must be filled!");
    } else {
      console.log(capacity);
      window.location.href = "./room_edit.php?room_name="+room_name+'&capacity='+capacity;
    }
    
  }
</script>