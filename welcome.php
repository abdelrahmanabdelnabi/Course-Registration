<?php
   include('session.php');
   require_once 'departments.php';
?>
<html">
   
   <head>
      <title>Welcome</title>
   </head>
   
   <body>
      <h1>Welcome <?php echo $_SESSION['name']; ?></h1>
      
      <?php
      	if($_SESSION['dept'] !== '') {
      		echo "<h2>your department is ".$_SESSION['dept']." </h2>";
      		echo '<h3>go to course selection <a href="/database/lab1/reg_courses.php?dept_id='.$_SESSION['dept_id'].'&sid='.$_SESSION['user_id'].'">here</a></h3>';
      
      	} else { // no deptartment.. select department
      		echo "<h2>Please select your department</h2>";
      		echo   '<form action="reg_dept.php" method="post"><select name = "department" class = "box" />';
      			$index = 1;
      			foreach($depts as $value) {
    				echo "<option value =".$index.">".$value['name']."</option>\n";
    				$index++;
    			}
	      	echo '</select>
	      			<input type = "submit" value = "Submit "/></form>';
      }

      ?>

      <h2><a href = "logout.php">Sign Out</a></h2>
   </body>
   
</html>


<?php
	
?>