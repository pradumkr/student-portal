<?php
	session_start();
	
	$id = $_REQUEST['username'];
	$pswd = $_REQUEST['pswd'];
	$con = mysqli_connect('localhost','pradum','Abc@123','student-portal',3307) or die("Server can't connect try again");
	mysqli_select_db($con,'student-portal') or die("Database not found!!");
	$s = "select * from login where username='$id' and password='$pswd'";
	$result = mysqli_query($con,$s) or die(mysqli_error($con));
	if($row = mysqli_fetch_assoc($result))
	{
		$_SESSION["ss_username"] = $row['userame'];
		if($row['type'])
		{
			echo "<script>window.location='http://localhost/Project/student-portal/admin.php';</script>";
		}
		else
		{
			echo "<script>window.location='http://localhost/Project/student-portal/student.php';</script>";
		}
	}
	else
	{
		$_SESSION["ss_er"] = "w";
		echo "<script>window.location='http://localhost/project/R.Brothers/#contact-sec';</script>";
	}
	
?>