<?php
    require("header.php");
    if(!isset($_SESSION["username"]))
    {
        header("Location: login.php");
    }
    else{
        header("Location: my_account.php");
    }

?>