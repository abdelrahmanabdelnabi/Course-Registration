<?php

	require_once 'config.php';

	$sql = "select * from departments";

	$result = mysqli_query($db, $sql);
	$depts = [];
	while($row = mysqli_fetch_array($result))
	{
    	$depts[] = $row;
	}

?>