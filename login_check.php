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
    // Form fields validation check
    if(!empty($_POST['username']) && !empty($_POST['password'])){ 
         
        // reCAPTCHA checkbox validation
        if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){ 
            // Google reCAPTCHA API secret key 
            $secret_key = '6LcNjTwpAAAAAIfq1A-BhmzI_NNQqmvJyETG5Osi'; 
             
            // reCAPTCHA response verification
            $verify_captcha = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$_POST['g-recaptcha-response']); 
            
            // Decode reCAPTCHA response 
            $verify_response = json_decode($verify_captcha); 
             
            // Check if reCAPTCHA response returns success 
            if($verify_response->success){ 
                echo $password;
                $username=$_POST['username'];
                $password= md5($_POST['password']);
                echo $password;
                // echo $username;
                // echo $password;
                $query="select * from CLIENTS where UPPER(username) = UPPER('".$username."') and password = '".$password."';";
            
                $result = $link->query($query);
                //print_r ($result);
                if($result->num_rows >0){
                    session_start();
                    $_SESSION["username"]=$username;
                    $row = $result->fetch_assoc();
                    $_SESSION["client_id"]=$row['client_id'];
                    $_SESSION["first_name"]=$row['first_name'];
                    $_SESSION["last_name"]=$row['last_name'];
                    $_SESSION["email"]=$row['email'];
                    $_SESSION["role"]=$row['role'];
                    echo "OK!";
                    header("Location: home_page.php");
                }
                else{
                    echo "Nu am gasit acest username cu aceasta parola ;(";
                }
                // header("Location: login_check.php");		
                exit();
            
            }
        }
    }
}

////////////////////
   
mysqli_close($link);

?>

