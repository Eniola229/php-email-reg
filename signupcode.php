<?php 
    session_start();
    include('dbcon.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require 'vendor/autoload.php';

    function sendemail_verify($name, $email, $verify_token)
{
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'joshuaadeyemi445@gmail.com';              //SMTP username
    $mail->Password   = 'zfqqiuyjflogdmqq';                     //App-specific password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to

    //Recipients
    $mail->setFrom('joshuaadeyemi445@gmail.com', $name);
    $mail->addAddress($email);    

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'You have Registered with R/Lever';
    $email_template  = "Verify your email address to login
     <a href='http://localhost/ooploginemailver/verify-email.php?token=$verify_token'>Click here</a>
     <br/><b>R/Lever Team</b>
     ";
    $mail->Body = $email_template;
    
    // Attempt to send the email
    if ($mail->send()) {
        echo 'Message has been sent';
    } else {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
}


    if (isset($_POST['register_btn'])) {
        $name = htmlspecialchars($_POST['name']); 
        $phone = htmlspecialchars($_POST['phone']); 
        $email = htmlspecialchars($_POST['email']);  
        $pwd = htmlspecialchars($_POST['pwd']); 
        $verify_token = md5(rand());
    
        //check if email exists or not
        $check_email_query = "SELECT email FROM userss WHERE email=?";
        $stmt = $con->prepare($check_email_query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $_SESSION['status'] = "Email ID Already Exists";
            header("Location: register.php");
            exit; 
        } else {
            // Insert user data into the database
            $query = "INSERT INTO userss (name, pwd, email, phone, verify_token) 
                    VALUES (?, ?, ?, ?, ?)";
            $stmt = $con->prepare($query);
            $hashedpwd = password_hash($pwd, PASSWORD_BCRYPT);

            $stmt->bind_param("sssss", $name, $hashedpwd, $email, $phone, $verify_token);
            $stmt->execute();

            if ($stmt->affected_rows > 0) { 
                sendemail_verify($name, $email, $verify_token);
                $_SESSION['status'] = "Registration Successful! Please verify your Email Address";
                header("Location: register.php");
                exit; 
            } else {
                $_SESSION['status'] = "Registration Failed";
                header("Location: register.php");
                exit;
            }
        }
    }

