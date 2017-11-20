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
		<div class="row">
			<div class="col-md-3">
				<h1>Welcome <?php echo $_SESSION['name']; ?></h1>
				<?php  if($_SESSION['dept'] !== '') {
					echo '<h1><a href="reg_courses.php">Courses</a></h1>';
				}
				?>
				<h1><a href = "logout.php">Sign Out</a></h1>

			</div>
			<div class="col-md-9">
				<?php
				if($_SESSION['dept'] !== '') {
					echo "<h2>your department is ".$_SESSION['dept']." </h2>";
					echo '<h3>go to course selection <a href="reg_courses.php">here</a></h3>';
				} else { // no deptartment.. select department

					echo "<h2>Please select your department</h2>";
					echo   '<form action="reg_dept.php" method="post"><div class="form-group"><select name="department" class="form-control"/>';
					$index = 1;
					foreach($depts as $value) {
						echo "<option value =".$index.">".$value['name'].' ( '.$value['description'].' )'."</option>\n";
						$index++;
					}
					echo '</select></div>
					<div class="form-group"><button type="submit" class="btn btn-primary">Submit</button></div></form>';
				}

				?>


			</div>
		</div>
	</div>
</body>

</html>


<?php

?>