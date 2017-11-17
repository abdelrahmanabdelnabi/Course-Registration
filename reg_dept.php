<?php
	require 'session.php';
	require_once 'config.php';

	$dept_id = $_POST['department'];
	$user_id = $_SESSION['user_id'];
	
	$sql = "UPDATE users set dept_id=$dept_id WHERE id=$user_id";
	$result = mysqli_query($db, $sql);
	if($result === true) {
		// user data update successfully
		echo "user data updated successfully";
		// update session variables
		$_SESSION['dept_id'] = $dept_id;

		$sql = "SELECT name from departments WHERE id=$dept_id";
		$result = mysqli_query($db, $sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$_SESSION['dept'] = $row['name'];
		header("location: welcome.php");
	} else {
		echo "an error occurred updating your data";
	}

?>