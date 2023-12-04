<?php
    require("header.php");
    if(!isset($_SESSION["username"]))
    {
        header("Location: login.html");
    }
    else{
        header("Location: my_account.php");
    }

?>