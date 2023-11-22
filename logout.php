<?php
session_start();
if($_SESSION["username"]!=-1) {
    $_SESSION["username"]=-1;
    $_SESSION["client_id"]=-1;
    echo "OK!";
    header("Location: home_page.php");
}
else{
    header("Location: home_page.php");
}
    
?>

