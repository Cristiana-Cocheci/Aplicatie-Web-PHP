<?php
$servername = "mysql-neverlanes.alwaysdata.net";
$username = "336043";
$password = "m.2a*Z!#mV!9vWH";
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
    $acc_type = $_POST['account_type'];
    // echo $username;
    // echo $password;
    $query="select * from CLIENTS where username ='".$username."' and password = '".$password."';";
    $result = $link->query($query);
    if($result->num_rows >0){
        if($acc_type == 'DRIVER'){
            foreach ($link->query($query) as $row) {
                $id = $row['client_id'];
                $query_driver = "select * from DRIVERS where client_id = ".$id.";";
                $result_driver = $link->query($query_driver);
                if($result_driver->num_rows >0){
                    //make the current account a driver account
                    $q3 = "UPDATE CLIENTS SET role = 'DRIVER' where client_id = ".$id.";";
                    $link->query($q3);
                    header("Location: login.php");
                }
                else{
                    //not a driver
                    header("Location: login.php");
                }
            }
        }
        else{
            //echo "Account already exists!! Login here.";
            header("Location: login.php");
        }
        echo 'What went wrong';
    }
    else{
        if($acc_type == 'DRIVER'){
            //nu poti sa ai direct cont de sofer
            header("Location: login.php");
        }
        $q2="insert into CLIENTS(username,first_name,last_name,email,password,role) values('".$username."','".$fname."','".$lname."','".$email."','".$password."','".$acc_type."');";
        $link->query($q2);
        header("Location: login.php");
    }
    // header("Location: login_check.php");		
    exit();

}
mysqli_close($link);

?>

