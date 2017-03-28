<?php
require_once '../inc/connection.inc.php';
require_once '../inc/function.inc.php';
$errormsg = array(
    "Deleted successfully",
    "Access denied"
);

if (isLoggedin()) {
    header("Location: index.php");
}


if ($_SERVER['REQUEST_METHOD'] === 'POST')  {
    $id = $_POST['id'];
    
    $sql    = "DELETE FROM  `csi_cms`.`registrations`
		WHERE `id`=$id";
    $result = mysqli_query($connection, $sql);
    if ($result) {
        $error = 0;
    } else {
        $error = 1;
    }
    
    $json = $errormsg[$error];
    echo json_encode($json);
}