<?php
include_once 'DBconnect.php';

if(count($_POST)>0) {
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
            $username=$_POST['username'];
            $password=$_POST['password'];
            if($_SESSION['username']==$username){
                // echo $username;
                // echo $password;
                $query="select * from CLIENTS where UPPER(username) = UPPER('".$username."') and password = '".md5($password)."';";

                $result = $link->query($query);
                // print_r ($result);
                if($result->num_rows >0){
                    $q2="delete from CLIENTS where UPPER(username) = UPPER('".$username."') and password = '".md5($password)."';";
                    $link->query($q2);
                    header("Location: home_page.php");
                }
                else{
                    echo "Nu am gasit acest username cu aceasta parola ;(";
                }
                // header("Location: login_check.php");		
                exit();
            }
            echo "This is not your account";
        }
    }
}
mysqli_close($link);

?>

