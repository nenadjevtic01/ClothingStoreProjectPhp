<?php
header("Content-type: application/json");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    include "../config/connection.php";
    include "functions.php";

    try{

        $name=$_POST['name'];
        $subject=$_POST['subject'];
        $message=$_POST['message'];
        $email=$_POST['email'];
        $paternName="/^[A-ZČĆŠĐŽ][a-zčćšđž]{2,15}(\s[A-ZČĆŠĐŽ][a-zčćšđž]{2,15})?(\s[A-ZČĆŠĐŽ][a-zčćšđž]{2,20})\s*$/";
        if(preg_match($paternName,$name) && filter_var($email, FILTER_VALIDATE_EMAIL)){
            if(insertMessage($name, $subject, $message, $email)){
                $statusMessage="<p style='color: green'>Message sent</p>";
            }else{
                $statusMessage="<p style='color: red'>Message not sent</p>";
            }
        }else{
            $statusMessage="<p style='color: red'>Check your informations</p>";
        }

        $answer = ["answer"=>$statusMessage];
        echo json_encode($answer);
        http_response_code(201);
    }catch(PDOException $e){
        http_response_code(500);
    }


}


?>