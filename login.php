<?php
	require_once 'inc/connection.inc.php';
	require_once 'inc/function.inc.php';
	require_once 'inc/session.php';

	error_reporting(E_ERROR | E_PARSE);

	$errormsg = array("Login successful", "Access disabled", "Incorrect Username - Password combination",);

	if(isLoggedin())
	{
		header("Location: index.php");
	}

	if(isset($_POST['submit']))
	{
		$entered_username 	= ($_POST['username']);
		$entered_pass		= md5($_POST['pass']);
		
		$query = "SELECT `user_id`,`current_team` FROM `team` WHERE `username`='$entered_username' AND `password`='$entered_pass'";

		$query_row = mysqli_fetch_assoc(mysqli_query($connection, $query));

		
		if(isset($query_row['user_id'])) 
		{
			if($query_row['current_team']==0)
			{
				$_SESSION['user_id']			= $query_row['user_id'];
				$error = 0;
			}
			else
			{
				$error=1;
			}
		} 
		else
		{
			$error = 2;
		}
		$message = $errormsg[$error];
		if($error==0)
			header("Location: index.php");
		else
			echo "<script type='text/javascript'>alert('$message');</script>";
	}
?>