<?php
	require_once '../inc/connection.inc.php';
    require_once '../inc/function.inc.php';
    $errormsg = array("Updated successfully", "Access denied");
    
    if(isLoggedin()){
        header("Location: index.php");
    }

    
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $error=0;
        /*
	if(isset($_POST['edit']))
	{
		$sql="UPDATE  `csi_cms`.`registrations`
		SET `name`='clean_string($_POST['name'])',`roll_no`='clean_string($_POST['rollno'])',`div`='clean_string($_POST['div'])',`mob`='clean_string($_POST['mob'])',`email_id`='clean_string($_POST['emailid'])',`receipt_no`='clean_string($_POST['rno'])',`board_mem`='$_SESSION['full_name']'
		WHERE `id`=$id";
		$result=mysqli_query($connection,$sql);
		if($result){
			$error=1;
		}
		else{
			$error=2;
		}
	}
	*/
        $json=array('message' => $errormsg[$error],);
        echo json_encode($json);
    }