<?php
include 'DBconnect.php';
include_once 'header.php';

if(count($_POST)>0) {
  if (isset($_POST['stop'])) { 
    $q = 'UPDATE VEHICLES SET position_id = '.$_POST['stop'].' WHERE vehicle_id = '.$_SESSION['vehicle_id'].';';
    $link->query($q);

    $q2 = 'INSERT INTO ACTION_LOGS (client_id, action_type) VALUES ( '.$_SESSION['client_id'].', "stop_update");';
    $link->query($q2);
  }
}

header("Location: my_account.php");

mysqli_close($link);  
?>