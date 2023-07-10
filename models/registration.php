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
            $firstName= $_POST["firstName"];
            $lastName=$_POST["lastName"];
            $username=$_POST["username"];
            $email=$_POST["email"];
            $address=$_POST["adresa"];
            $city=$_POST["grad"];
            $zip=$_POST["zip"];
            $password=$_POST["password"];
            $vNumber=$_POST["Vnumber"];

            $paternName = "/^[A-Z]{1}[a-zčćšđž]{2,12}$/";
            $paternUsername="/^(?=.{8,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+$/";
            //$paternPassword="/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/";
            $paternPassword="/^(?=.*[a-z])(?=.*[A-Z]).{8,32}$/";
            $paternAdresa="/^[A-ZČĆŠĐŽ]{1}[a-zčćšđž]{2,15}(\s[A-ZČĆŠĐŽa-zčćšđž0-9]{1,15})+$/";
            $paternGrad="/^[a-zA-Z\u0080-\u024F]+(?:[\s-][a-zA-Z\u0080-\u024F]+)*$/";
            $paternZip="/^\d{5}$/";

            if(preg_match($paternName,$firstName) 
            && preg_match($paternName, $lastName) 
            && preg_match($paternUsername,$username) 
            && filter_var($email, FILTER_VALIDATE_EMAIL)
            && preg_match($paternPassword, $password)
            && preg_match($paternAdresa,$address)
            && preg_match($paternZip, $zip)){
                $encryptedPassword=md5($password);

                $status= checkStatus($username,$email);
                $statusMessage="";
                if(!$status){
                    $statusMessage="<p style='color: red'>Email/username already exist</p>";
                }else{
                    $insertUser= insertUser($firstName,$lastName,$username,$email,$encryptedPassword, $vNumber);

                    if($insertUser){
                        $user_id=$connection->lastInsertId();
                        $insertAddress=insertAddress($user_id,$address, $city, $zip);
                    }

                    if($insertAddress){
                        $statusMessage="<h4 style='color:#2aa32c'>Registration successfull!</h4>";
                        $statusMessage.="<h4 style='color:#2aa32c'>Verification needed!</h4>";
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

                    session_start();
                    $_SESSION["username"]=$username;
                    $_SESSION["role"]=2;
                }
                        $answer = ["answer"=>$statusMessage];
                        echo json_encode($answer);
                        http_response_code(201);
                
                
            }

        }catch(PDOException $e){
            http_response_code(500);
        }
    }
?>