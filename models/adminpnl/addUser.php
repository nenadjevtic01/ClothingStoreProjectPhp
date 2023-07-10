<?php
header("Content-type: application/json");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    include "../../config/connection.php";
    include "../functions.php";

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
        $role=$_POST["role"];
        $verified=$_POST["verified"];

        $paternName = "/^[A-Z]{1}[a-zčćšđž]{2,12}$/";
        $paternUsername="/^(?=.{8,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+$/";
        $paternPassword="/^(?=.*[a-z])(?=.*[A-Z]).{8,32}$/";
        $paternAdresa="/^[A-Z]{1}[a-z]{2,15}(\s[A-Za-z0-9]{1,10})+$/";
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
                $insertUser= insertUserAdmin($firstName,$lastName,$username,$email,$encryptedPassword, $role, $vNumber, $verified);

                if($insertUser){
                    $user_id=$connection->lastInsertId();
                    $insertAddress=insertAddress($user_id,$address, $city, $zip);
                }

                if($insertAddress){
                    $statusMessage="<span class='fw-bold' style='color:#2aa32c; font-size:18px'>User add successfull!</span>";
                }
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