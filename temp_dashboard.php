<?php
	require_once 'inc/connection.inc.php';
	require_once 'inc/function.inc.php';
	require_once 'inc/session.php';
	if(!isLoggedin()){
		header("Location: index.php");
	}

	$current_user_id = (int)$_SESSION['user_id'];
	
	$query 	= "SELECT * FROM `team` WHERE `user_id`='$current_user_id'";
	$row	= mysqli_fetch_assoc(mysqli_query($connection,$query));

	$current_fullname	= $row['full_name'];
	$current_username	= $row['username'];
	$current_photo		= $row['photo'];
	$current_fb_link 	= $row['fb_link'];

	$json =array(
		"user_id"	=>	$current_user_id,
		"name"		=>	$current_fullname,
		"photo"		=>	$current_photo,
		);
	echo json_encode($json);
?>