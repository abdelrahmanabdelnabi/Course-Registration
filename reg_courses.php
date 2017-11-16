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
		echo '<table>';

		while($row = mysqli_fetch_array($enrols,MYSQLI_ASSOC)) {
			$href ="enrol.php?course_id=".$row['course_id']."&sid=".$sid."&enrol=false";
			echo '<tr><td>'.$row['name'].'</td><td><a href="'.$href.'">unenrol</a></td></tr>';
		}

		echo '</table>';		
	}

	echo '<table>';
	echo '<tr>';
	echo '<th>Course</th><th>register</th>';
	echo '</tr>';
	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
		echo '<tr><td>'.$row['name'].'</td><td><a href="enrol.php?course_id='.$row['id'].'&sid='.$sid.'&enrol=true'.'">enrol</a></td></tr>';
	}

	echo '</table>';

 ?>