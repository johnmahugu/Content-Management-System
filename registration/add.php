<?php
require_once '../inc/connection.inc.php';
require_once '../inc/function.inc.php';

$errormsg = array(
    "New record created successfully!!",
    "Access denied!!"
);

if (isLoggedin()) {
    header("Location: index.php");
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $sql = "INSERT INTO `registrations`(`name`, `roll_no`, `div`, `mob`, `email_id`, `receipt_no`, `board_mem`) 
        VALUES ('{$_POST['name']}','{$_POST['roll_no']}','{$_POST['div']}','{$_POST['mob']}'
    ,'{$_POST['email_id']}','{$_POST['receipt_no']}','{$_POST['board_mem']}')";
    
    
    if (mysqli_query($connection, $sql)) {
        $error = 0;
    } else {
        $error = 1;
    }
    
    $json = $errormsg[$error];
    echo json_encode($json);
}
?>