<!DOCTYPE html>
<html>
<head>
	<title>SIGN UP</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<script type="text/javascript">
     function signup() {
          var uname = document.querySelector("#uname").value;
          var firstname = document.querySelector("#firstname").value;
          var lastname = document.querySelector("#lastname").value;
          var telephone = document.querySelector("#telephone").value;
          var password = document.querySelector("#password").value;
          var re_password = document.querySelector("#re_password").value;
          if(uname == '') {
               alert('User Name must be filled!');
          } else 
          if(uname.length < 5) {
               alert('User Name must be longer than 5 characters');
          } else 
          if(firstname == '') {
               alert('First Name must be filled!');
          } else 
          if(lastname == '') {
               alert('Last Name must be filled!');
          } else 
          if(telephone == '') {
               alert('Telephone extension must be filled!');
          } else 
          if(telephone.length != 4) {
               alert('Telephone extension must be 4 characters!');
          } else 
          if (password == '') {
               alert('Password must be filled!');
          } else 
          if(password.length < 5) {
               alert('Password must be longer than 5 characters!');
          } else 
          if(re_password == '') {
               alert('Re_password extension must be filled!');
          } else 
          if(password != re_password) {
               alert('Password and Re_password must be matched!');
          } else 
          {
               var signupform = document.querySelector("#signup_form");
               signupform.submit();
          
          }
          
     }   

</script>
<body>
     <h1>Welcome</h1>
     <h3>ECU Room Booking System</h3>
     <form action="signup-check.php" method="post" id="signup_form">
     	<h2>SIGN UP</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

          <?php if (isset($_GET['success'])) { ?>
               <p class="success"><?php echo $_GET['success']; ?></p>
          <?php } ?>


          <label>User Name</label>
          <?php if (isset($_GET['uname'])) { ?>
               <input type="text" 
                      name="uname" 
                      placeholder="User Name"
                      class="uname"
                      value="<?php echo $_GET['uname']; ?>"><br>
          <?php } else { ?>
               <input type="text" 
                      name="uname" 
                      placeholder="User Name"
                      class="uname"
                      id="uname"
                      ><br>
          <?php } ?>

          <label>First Name</label>
          <?php if (isset($_GET['name'])) { ?>
               <input type="text" 
                      name="firstname" 
                      placeholder="First Name"
                      value="<?php echo $_GET['name']; ?>"><br>
          <?php } else { ?>
               <input type="text" 
                      name="firstname" 
                      placeholder="First Name"
                      id="firstname"
                      ><br>
          <?php } ?>

          <label>Last Name</label>
          <?php if (isset($_GET['lastname'])) { ?>
               <input type="text" 
                      name="lastname" 
                      placeholder="Last Name"
                      value="<?php echo $_GET['name']; ?>"><br>
          <?php } else { ?>
               <input type="text" 
                      name="lastname" 
                      id="lastname"
                      placeholder="Last Name"><br>
          <?php } ?>
          
          
          <label>Telephone Extension</label>
          <?php if (isset($_GET['lastname'])) { ?>
               <input type="number" 
                      name="telephone" 
                      placeholder="Telephone Extension"
                      value="<?php echo $_GET['telephone']; ?>"><br>
          <?php } else { ?>
               <input type="number" 
                      name="telephone" 
                      id="telephone"
                      placeholder="Telephone Extension"><br>
          <?php } ?>

     	<label>Password</label>
     	<input type="password" 
                 name="password" 
                 placeholder="Password"
                 id="password"
                 required
                 ><br>

          <label>Re Password</label>
          <input type="password" 
                 name="re_password" 
                 id="re_password"
                 placeholder="Re_Password" ><br>

     	<button type="button" onClick="signup()">Sign Up</button>
          <a href="index.php" class="ca">Already have an account?</a>
     </form>
</body>
</html>