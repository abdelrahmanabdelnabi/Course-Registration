<?php
include("config.php");
session_start();
$error = "";
if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 

   $myemail = mysqli_real_escape_string($db,$_POST['email']);
   $mypassword = mysqli_real_escape_string($db,$_POST['password']);
   $hashed_password = md5($mypassword);

   $sql = "SELECT * FROM users WHERE email = '$myemail' and password = '$hashed_password'";
   $result = mysqli_query($db,$sql);

   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
   $count = mysqli_num_rows($result);

      // If result matched $myusername and $mypassword, table row must be 1 row

   if($count == 1) {
      $_SESSION['login_user'] = $myemail;
      $_SESSION['name'] = $row['name'];
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['dept_id'] = $row['dept_id'];
      $dept_id = $row['dept_id'];

         // get user's department
      if(!isset(($dept_id)))
         $_SESSION['dept'] = '';
      else {
         $dept = "SELECT * FROM departments WHERE id = $dept_id";
         $dept_result = mysqli_query($db,$dept);
         $dept_row = mysqli_fetch_array($dept_result,MYSQLI_ASSOC);
         $_SESSION['dept'] = $dept_row['name'];            
      }

      header("location: welcome.php");
   }else {
      $error = "Your Login Name or Password is invalid";
   }
}
?>

<html>

<head>
   <title>Login Page</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

   <script src="http://code.jquery.com/jquery-1.4.min.js" type="text/javascript"></script>
   <script type="text/javascript">
         $(document).ready(function(){
            $("#register").click(function(){
                $('#result').load('register.php');
              //alert("Thanks for visiting!");
            }); 
          });
    </script>
   
</head>

<body>
	
   <div class="container">
    <h2>Sign-in</h2>

    <form class="form-horizontal" action="login.php" method="post">
     <div class="form-group">
      <label class="control-label col-md-2" for="email">Email:</label>
      <div class="col-md-10">
       <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
    </div>
 </div>

 <div class="form-group">
   <label class="control-label col-md-2" for="pwd">Password:</label>
   <div class="col-md-10">          
    <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required>
 </div>
</div>

<div class="form-group">        
   <div class="col-sm-offset-2 col-md-10">
    <button type="submit" class="btn btn-default">Submit</button>
 </div>
</div>

<?php 
   if ($error !== "")
      echo '<div class="alert alert-danger">'.$error.'</div>';
?>
</form>
<h5>Don't have an account? sign-up <input type='button' value='Register now !' id="register"></h5>
<div id="result" style="clear:both;"></div>

</div>

</div>

</div>

</body>
</html>