<?php
        header("Content-type: application/json");
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;
        require '../phpMailer/vendor/autoload.php';
      if($_SERVER["REQUEST_METHOD"]=="POST"){
        include "../config/connection.php";
        include "functions.php";

        try{
          
            $username=$_POST["username"];
            $password=$_POST["password"];

            $paternUsername="/^(?=.{8,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+$/";
            //$paternPassword="/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/";
            $paternPassword="/^(?=.*[a-z])(?=.*[A-Z]).{8,32}$/";
            $statusMessage="";
            if(preg_match($paternUsername,$username)  && preg_match($paternPassword,$password)){
                $status=checkAccount($username);

                if($status){
                    $login= login($username, $password);

                    if(!$login){
                        $statusMessage="<p style='color: red'>Invalid password</p>";
                    }else{
                        $verified=isVerified($username);
                        if($verified){
                            $statusMessage="<h6 style='color: #2aa32c'>Welcome, ".$username."</h6>";
                        }else{
                            $statusMessage="<h4 style='color: #2aa32c'>Verification needed, ".$username."</h4>";
                            $email=getEmail($username);
                            $vNumber=getvNumber($username);
                            $mail = new PHPMailer(true);

                            //Server settings
                            $mail->isSMTP();                                            //Send using SMTP
                            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                            $mail->Username   = 'emailzaphp69@gmail.com';                     //SMTP username
                            $mail->Password   = 'Idegas123';                               //SMTP password
                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                            //Recipients
                            $mail->setFrom('emailzaphp69@gmail.com', 'Flex shop');
                            $mail->addAddress($email);


                            //Content
                            $mail->isHTML(true);                                  //Set email format to HTML
                            $mail->Subject = 'Verification code';
                            $mail->Body    = "<h5>This is your verification number:</h5><h1><b>$vNumber</b></h1>";
                            $mail->AltBody = $vNumber;

                            $mail->send();
                        }
                        $_SESSION['username']=$username;
                    }
                }else{
                    $statusMessage="<p style='color: red'>Username does not exist</p>";
                }
            }

            $answer = ["answer"=>$statusMessage];
            echo json_encode($answer);
            http_response_code(201);
            
        }catch(PDOException $e){
            var_dump($e->getMessage());
            http_response_code(500);
        }

      }


?>