<?php
include_once 'DBconnect.php';
session_start();
$_SESSION['date_log_out'] = date('Y-m-d H:i:s', time());

// Calculate the time difference
$loginTime = strtotime($_SESSION['date_log_in']);
$logoutTime = strtotime($_SESSION['date_log_out']);

$q = "INSERT INTO LOGS(client_id, login_date, time_spent) VALUES (".$_SESSION['client_id'].", '".$_SESSION['date_log_in']."',".$logoutTime-$loginTime.");";
$link->query($q);

session_unset();
session_destroy();
header("Location: home_page.php");
    
?>

