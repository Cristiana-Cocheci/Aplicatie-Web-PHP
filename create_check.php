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
    if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){ 
        // Google reCAPTCHA API secret key 
        $secret_key = '6LcNjTwpAAAAAIfq1A-BhmzI_NNQqmvJyETG5Osi'; 
         
        // reCAPTCHA response verification
        $verify_captcha = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$_POST['g-recaptcha-response']); 
        
        // Decode reCAPTCHA response 
        $verify_response = json_decode($verify_captcha); 
         
        // Check if reCAPTCHA response returns success 
        if($verify_response->success){ 

                $fname=$_POST['fname'];
                $lname=$_POST['lname'];
                $email=$_POST['email'];
                $username=$_POST['username'];
                $password=md5($_POST['password']);
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
        }
}
mysqli_close($link);

?>

