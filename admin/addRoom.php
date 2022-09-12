<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) { ?>
 
 
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
             <h2>Add Room</h2>
              <label>Room Name</label>
              <input type="text" placeholder="Room Name" id="room_name"/>
              <br/>
              <label>Capacity</label>
              <input type="number" placeholder="Capacity" id="capacity"/>
              <br/>
              <button onClick="addRoom()">Add</button>
             <hr/>
          </div>
          <a href="../home.php">Back</a>
	</body>
   
</html> 

<?php } else {header('Location: index.php');
    exit();}
?>

<script>
  function addRoom() {
    var room_name = document.querySelector("#room_name").value;
    var capacity = document.querySelector("#capacity").value;
    
    if(room_name == '') {
      alert("Room Name must be filled!");
    } else if (capacity == '') {
      alert("Capacity must be filled!");
    } else {
      window.location.href = "./room_add.php?room_name="+room_name+'&capacity='+capacity;
    }
    
  }
</script>