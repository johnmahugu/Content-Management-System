<?php
	function isLoggedin()
	{
		return (bool)(isset($_SESSION['user_id']) && !empty($_SESSION['user_id']));
	}


	function clean_string($str)
	{
		$clean_str = htmlspecialchars(strip_tags(strtolower(trim($str))));
	}
/*
	function branch($str)
	{
		$string=$str;
		return ($branch=clean_string(preg_replace("/[0-9]/", "", $string)));
	}
	*/
?>
