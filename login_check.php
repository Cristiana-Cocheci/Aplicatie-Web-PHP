<?php 
  
include_once 'DBconnect.php';

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

                $username=$_POST['username'];
                $password= md5($_POST['password']);
               
                // echo $username;
                // echo $password;
                $query="select * from CLIENTS where UPPER(username) = UPPER(?) and password = ?;";
                // Prepare statement
                $stmt = $link->prepare($query);

                // Check if the statement is prepared successfully
                if (!$stmt) {
                    die("Error in preparing statement: " . $link->error);
                }

                // Bind parameters
                $stmt->bind_param("ss", $username, $password);

                // Execute the statement
                $stmt->execute();
                $result = $stmt->get_result();
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
                    $stmt->close();
                    header("Location: home_page.php");
                }
                else{
                    echo "Nu am gasit acest username cu aceasta parola ;(";
                }
                exit();
            
            }
        }
        else{
            header("login.php");
        }
    }
    else{
        header("login.php");
    }
}
    header("login.php");


////////////////////
   
mysqli_close($link);

?>

