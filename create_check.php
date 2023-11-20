<?php
$servername = "mysql-neverlanes.alwaysdata.net";
$username = "336043";
$password = "Elijah.R.Daneel";
$dbname = "neverlanes_database";

// Create connection

// print_r($_POST);
$link = mysqli_connect($servername, $username, $password, $dbname);

if (!$link) {
    echo "Error: Unable to connect to MySQL.";
    exit;
}

if(count($_POST)>0) {
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    // echo $username;
    // echo $password;
    $query="select * from CLIENTS where username ='".$username."' and password = '".$password."';";
    $result = $link->query($query);
    if($result->num_rows >0){
        //echo "Account already exists!! Login here.";
        header("Location: login.html");
    }
    else{
        $q2="insert into CLIENTS(username,first_name,last_name,email,password) values('".$username."','".$fname."','".$lname."','".$email."','".$password."');";
        $link->query($q2);
        header("Location: login.html");
    }
    // header("Location: login_check.php");		
    exit();

}
mysqli_close($link);

?>

