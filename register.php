<?php

	require 'config.php';

	if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      $myname = mysqli_real_escape_string($db,$_POST['name']);
      $myemail = mysqli_real_escape_string($db,$_POST['email']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']);
      
      $sql = "SELECT id FROM users WHERE email = '$myemail'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      
      if($count == 1) { // email already in use
         $_SESSION['message'] = "email already in use";
         $error = "Your email is already in use";
         header("location: register.php");
      }else {
         $insert = "INSERT INTO users (name, email, password) VALUES ('$myname','$myemail','$mypassword');";

         if(mysqli_query($db, $insert)) {
         	print_r("account created succesfully");
         	$_SESSION['message'] = "account created successfully";
         	header("location: welcome.php");
         }
      }
   }
?>

<html>
   
   <head>
      <title>Register Page</title>
      
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         
         .box {
            border:#666666 solid 1px;
         }
      </style>
      
   </head>
   
   <body bgcolor = "#FFFFFF">
	
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
				
            <div style = "margin:30px">
               
               <form action = "register.php" method = "post">
               	<label>name  :</label><input type = "text" name = "name" class = "box"/><br /><br />
                  <label>email  :</label><input type = "text" name = "email" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = "Register"/><br />
               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $_SESSION['message']; ?></div>
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>