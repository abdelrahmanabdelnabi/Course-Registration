
<?php

	require_once 'config.php';
	$course_id = $_GET['course_id'];
	$sid = $_GET['sid'];
	$is_insert = $_GET['enrol'];

	if($is_insert === "false") {
		$sql = "DELETE FROM enrollments WHERE course_id=".$course_id." AND sid=".$sid;
		$result = mysqli_query($db,$sql);
		header("location:reg_courses.php");

	} else {

		// check if already enrolled
		$sql = "SELECT * FROM enrollments WHERE course_id=".$course_id." AND sid=".$sid;

		$result = mysqli_query($db,$sql);

		if(mysqli_num_rows($result) === 0) {
			$insert = "INSERT INTO enrollments (course_id, sid) VALUES (".$course_id.", ".$sid.")";
			$result = mysqli_query($db,$insert);
			header("location:reg_courses.php");
		}

	}

?>
