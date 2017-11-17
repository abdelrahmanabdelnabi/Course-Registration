<?php
   include('session.php');
   require_once 'departments.php';
   include 'bootstrap.css';
?>
<html>
   
   <head>
      <title>Welcome</title>
   </head>
   
   <body>
   	<div class="container">
      <h1>Welcome <?php echo $_SESSION['name']; ?></h1>
      
      <?php
      	if($_SESSION['dept'] !== '') {
      		echo "<h2>your department is ".$_SESSION['dept']." </h2>";
      		echo '<h3>go to course selection <a href="/database/lab1/reg_courses.php">here</a></h3>';
      
      	} else { // no deptartment.. select department
      		echo "<h2>Please select your department</h2>";
      		echo   '<form action="reg_dept.php" method="post"><div class="form-group"><select name="department" class="form-control"/>';
      			$index = 1;
      			foreach($depts as $value) {
    				echo "<option value =".$index.">".$value['name']."</option>\n";
    				$index++;
    			}
	      	echo '</select></div>
	      			<div class="form-group"><button type="submit" class="btn btn-primary">Submit</button></div></form>';
      }

      ?>

      <h2><a href = "logout.php">Sign Out</a></h2>
  </div>
   </body>
   
</html>


<?php
	
?>