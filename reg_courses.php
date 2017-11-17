<!DOCTYPE html>
<html lang="en">
<head>
	<title>Course Registeration</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<h1><a href="welcome.php">Homepage</a></h1>
				<h1>Courses</h1>
				<h1><a href="logout.php">Logout</a></h1>
			</div>
			<div class="col-sm-8">

				<?php
				require_once 'session.php';

				$dept_id = $_SESSION['dept_id'];
				$sid = $_SESSION['user_id'];

		// get the list of courses available in this department
				$sql = "SELECT * FROM courses WHERE dept_id = ".$dept_id;
				$result = mysqli_query($db,$sql);

		// get this student's enrollments
				$enrol_query = "SELECT enrollments.*, courses.name FROM enrollments inner JOIN courses on enrollments.course_id=courses.id  WHERE sid=".$sid;
				$enrols = mysqli_query($db, $enrol_query);

				if(mysqli_num_rows($enrols) === 0) {
					echo "<h2>You are currently not enrolled in any course</h2>";
				} else {
					echo "<h2>Your enrollments</h2>";
					echo '<table class="table table-hover">';
					echo '<tr><th>Course</th><th>un-register</th></tr>';

					while($row = mysqli_fetch_array($enrols,MYSQLI_ASSOC)) {
						$href ="enrol.php?course_id=".$row['course_id']."&sid=".$sid."&enrol=false";
						echo '<tr><td>'.$row['name'].'</td><td><a class="btn btn-danger" href="'.$href.'">unenrol</a></td></tr>';
					}

					echo '</table>';		
				}

				echo '<h2>Available Courses</h2>';
				echo '<table class="table table-hover">';
				echo '<tr>';
				echo '<th>Course</th><th>register</th>';
				echo '</tr>';
				while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
					echo '<tr><td>'.$row['name'].'</td><td><a class="btn btn-primary" href="enrol.php?course_id='.$row['id'].'&sid='.$sid.'&enrol=true'.'">enrol</a></td></tr>';
				}

				echo '</table>';

				?>
			</div>
		</div>
	</div>
</body>
</html>