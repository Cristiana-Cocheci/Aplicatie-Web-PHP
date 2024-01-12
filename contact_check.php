<?php 
  

include_once 'DBconnect.php';
if (!$link) {
    echo "Error: Unable to connect to MySQL.";
    exit;
}
if(count($_POST)>0) {
echo "ceva";

    // Form fields validation check
    if(!empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['message'])){ 
echo "ceva";
         
        // reCAPTCHA checkbox validation
        if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){ 
            echo "ceva";
            // Google reCAPTCHA API secret key 
            $secret_key = '6LcNjTwpAAAAAIfq1A-BhmzI_NNQqmvJyETG5Osi'; 
             
            // reCAPTCHA response verification
            $verify_captcha = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$_POST['g-recaptcha-response']); 
            
            // Decode reCAPTCHA response 
            $verify_response = json_decode($verify_captcha); 
             
            // Check if reCAPTCHA response returns success 
            if($verify_response->success){ 
                echo "ceva";
                $first_name=$_POST['first_name'];
                $last_name = $_POST['last_name'];
                $message = $_POST['message'];
                $user = $_POST["user?"];
                $email = $_POST["email"];
                $trimitem_mail=1;
                if($user == "user"){
                    $username=$_POST['username'];
                    $password=$_POST['password'];
                    // echo $username;
                    // echo $password;
                    $query="select * from CLIENTS where UPPER(username) = UPPER('".$username."') and password = '".$password."';";
                
                    $result = $link->query($query);
                    //print_r ($result);
                    if($result->num_rows >0){
                        
                        echo "OK!";
                        //header("Location: home_page.php");
                    }
                    else{
                        $trimitem_mail=0;
                        echo "Nu am gasit acest username cu aceasta parola ;(";
                    }
                }
                if($trimitem_mail==1){
                    echo "da?";
                    require_once('class.phpmailer.php');
                    require_once('mail_config.php');
                    $message = wordwrap($message, 160, "<br />\n");
                    $mail = new PHPMailer(true); 

                    $mail->IsSMTP();
                    
                    try {
                    
                        $mail->SMTPDebug  = 0;                     
                        $mail->SMTPAuth   = true; 
                    
                        $to='cocheci.cristiana@gmail.com';
                        $nume='Neverlanes2';
                    
                        $mail->SMTPSecure = "ssl";                 
                        $mail->Host       = "smtp.gmail.com";      
                        $mail->Port       = 465;                   
                        $mail->Username   = $my_username;  			// GMAIL username
                        $mail->Password   = $my_password;            // GMAIL password
                        $mail->AddReplyTo($email, 'Contact Neverlanes');
                        $mail->AddCC($email, 'User');
                        $mail->AddAddress($to, $nume);
                    
                        $mail->SetFrom('cocheci.cristiana@gmail.com', 'Contact Neverlanes');
                        $mail->Subject = 'Contact Form';
                        $mail->AltBody = 'To view this post you need a compatible HTML viewer!'; 
                        $mail->MsgHTML($message);
                        $mail->Send();
                        echo "Message Sent OK</p>\n";
                    } catch (phpmailerException $e) {
                        echo $e->errorMessage(); //error from PHPMailer
                    } catch (Exception $e) {
                        echo $e->getMessage(); //error from anything else!
                    }
                }
                echo "nu?";
                // header("Location: login_check.php");		
                exit();
            
            
            }
        }
    }
}

////////////////////
   
mysqli_close($link);

?>

