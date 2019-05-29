<?php
	$db_host="localhost";
	$db_username="root";
	$db_name="pharmacy";
	$con=mysqli_connect("$db_host","$db_username","");
	mysqli_select_db($con,"$db_name") or die("no database");
?>