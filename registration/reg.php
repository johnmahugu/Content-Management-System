<?php
require_once '../inc/connection.inc.php';
require_once '../inc/function.inc.php';
$errormsg = array(
    "Displayed successfully",
    "Access denied"
);

if (isLoggedin()) {
    header("Location: index.php");
}

$sql    = "SELECT * FROM `registrations`";
$result = mysqli_query($connection, $sql);
$json   = array();

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $json[] = $row;
    }
    
    $error = 1;
} else {
    $error = 2;
}

echo json_encode($json);

?>