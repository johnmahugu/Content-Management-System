<?php
	require_once 'inc/connection.inc.php';
	require_once 'inc/function.inc.php';
	require_once 'inc/session.php';
	if(isLoggedin())
	{
		header("Location: dashboard.php");
	} 
	else 
	{
		header("Location: login.html");
	}
?>

