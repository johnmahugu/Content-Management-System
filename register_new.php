<?php

	require_once 'inc/connection.inc.php';
	require_once 'inc/function.inc.php';

	$errormsg = array("Registration successful", "Username already used", "Technical glitch. Try again.");

	if(isset($_POST['submit']))
	{
		$entered_name			= "Pending";
		$entered_username		= $_POST['username'];
		$entered_pass			= md5($_POST['pass']);
		$entered_conf_pass		= md5($_POST['confpass']);

		if($_POST['fb_link'])
			$entered_fb_link	= $_POST['fb_link'];
		else
			$entered_fb_link 	= "Pending";

		if(isset($_FILES['file']))
		{
			$errors= "";
		  	$error_trigger = 0;
		  	$file_name = $_FILES['file']['name'];
		  	$file_tmp =$_FILES['file']['tmp_name'];

		  	$allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
			$detectedType = exif_imagetype($_FILES['file']['tmp_name']);
			$error = !in_array($detectedType, $allowedTypes);
		  	if(empty($errors)==true)
		  	{
		    	$filepath = "images/team_photo/" . $file_name;
		    	move_uploaded_file($file_tmp,$filepath);	
			} 
			$entered_photo = $_FILES['file']['name']; 
		}
		else
			$entered_photo = "default_user.png";
		$entered_designation	= "Executive member";
		$current_team			= 0;
		 
		
		$query = "SELECT `username` FROM `team` WHERE `username`= '$entered_username'";
		
		if(mysqli_num_rows(mysqli_query($connection, $query))!=0)
		{
			$error = 1;
		} 
		else 
		{
			
			//echo $entered_name, $entered_username, $entered_pass, $entered_photo, $entered_fb_link, $entered_designation, $current_team;
			$query = "INSERT INTO `team` (`full_name`,`username`,`password`, `photo`,`fb_link`, `designation`, `current_team`) 
			VALUES ('$entered_name','$entered_username','$entered_pass','$entered_photo', '$entered_fb_link', '$entered_designation', '$current_team')";

			if(mysqli_query($connection, $query))
			{
				$error = 0;
			} 
			else 
			{
				$error = 2;
			}
		}
		
		echo "<script>alert('".$errormsg[$error]."');</script>";
		if($error==0)
			header("Location:login.html");
		else
			header("Location:register.html");
	}
?>