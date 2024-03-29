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
			<div class="col-md-3">
				<h1><a href="welcome.php">Homepage</a></h1>
				<h1>Courses</h1>
				<h1><a href="logout.php">Logout</a></h1>
			</div>
			<div class="col-md-9">

				<?php
				require_once 'session.php';

				$dept_id = $_SESSION['dept_id'];
				$sid = $_SESSION['user_id'];
				
				if($dept_id==null){
					header("Location: welcome.php"); /* Redirect browser */
					exit();
				}

		// get the list of courses available in this department
				$sql = "SELECT * FROM courses WHERE dept_id = ".$dept_id;
				$result = mysqli_query($db,$sql);

		// get this student's enrollments
				$enrol_query = "SELECT enrollments.*, courses.* FROM enrollments inner JOIN courses on enrollments.course_id=courses.id  WHERE sid=".$sid;
				$enrols = mysqli_query($db, $enrol_query);
				$table_html_schema = '<tr><th>Course</th><th>Description</th><th>Instructor</th><th>Credit Hours</th><th>registration</th></tr>';

				if(mysqli_num_rows($enrols) === 0) {
					echo "<h2>You are currently not enrolled in any course</h2>";
				} else {
					echo "<h2>Your enrollments</h2>";
					echo '<table class="table table-hover">';
					echo $table_html_schema;

					while($row = mysqli_fetch_array($enrols,MYSQLI_ASSOC)) {
						$href ="enrol.php?course_id=".$row['course_id']."&sid=".$sid."&enrol=false";
						echo '<tr><td>'.$row['name'].'</td><td>'.$row['description'].'</td><td>'.$row['instructor_name'].'</td><td>'.$row['credit_hours'].'</td><td><a class="btn btn-danger" href="'.$href.'">unenrol</a></td></tr>';
					}

					echo '</table>';		
				}

				echo '<h2>Available Courses</h2>';
				echo '<table class="table table-hover">';
				echo $table_html_schema;
				$enrols = mysqli_query($db, $enrol_query);				
				while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
					$flag=false;
									$enrols = mysqli_query($db, $enrol_query);				

					while($enrolrow = mysqli_fetch_array($enrols,MYSQLI_ASSOC)) {
						if($row['id']==$enrolrow['course_id']){
							$flag=true;
							break;							
						}
					}
					if($flag==false)
						echo '<tr><td>'.$row['name'].'</td><td>'.$row['description'].'</td><td>'.$row['instructor_name'].'</td><td>'.$row['credit_hours'].'</td><td><a class="btn btn-primary" href="enrol.php?course_id='.$row['id'].'&sid='.$sid.'&enrol=true'.'">enrol</a></td></tr>';
				}

				echo '</table>';

				?>
			</div>
		</div>
	</div>
</body>
</html>