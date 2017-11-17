<?php

require 'config.php';
$error = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
	$myname = mysqli_real_escape_string($db,$_POST['name']);
	$myemail = mysqli_real_escape_string($db,$_POST['email']);
	$mypassword = mysqli_real_escape_string($db,$_POST['password']);
	$hashed_password = md5($mypassword);

	$sql = "SELECT id FROM users WHERE email = '$myemail'";
	$result = mysqli_query($db,$sql);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$count = mysqli_num_rows($result);

      if($count == 1) { // email already in use
      	$_SESSION['message'] = "email already in use";
      	$error = "email already in use";
      	//header("location: register.php");
      }else {
      	$insert = "INSERT INTO users (name, email, password) VALUES ('$myname','$myemail','$hashed_password');";

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
  	<title>Sign-up</title>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  </head>

  <body>
  	
  	<div class="container">
  		<h2>Sign-up</h2>

  		<form class="form-horizontal" action="register.php" method="post">
  			<div class="form-group">
  				<label class="control-label col-sm-2" for="name">Name:</label>
  				<div class="col-sm-10">
  					<input type="text" class="form-control" id="name" placeholder="Enter your name" name="name" required>
  				</div>
  			</div>
  			<div class="form-group">
  				<label class="control-label col-sm-2" for="email">Email:</label>
  				<div class="col-sm-10">
  					<input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
  				</div>
  			</div>

  			<div class="form-group">
  				<label class="control-label col-sm-2" for="pwd">Password:</label>
  				<div class="col-sm-10">          
  					<input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required>
  				</div>
  			</div>

  			<div class="form-group">        
  				<div class="col-sm-offset-2 col-sm-10">
  					<button type="submit" class="btn btn-default">Submit</button>
  				</div>
  			</div>

  			<?php 
  			if ($error !== "")
  				echo '<div class="alert alert-danger">'.$error.'</div>';
  			?>
  		</form>
  		<h5>Already have an account? sign-in <a href="login.php">here</a></h5>

  	</div>

  </div>

</div>

</body>
</html>