<?php
header("Content-type: application/json");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    include "../../config/connection.php";
    include "../functions.php";

    try{
        $user_id=$_POST["user"];
        $firstName= $_POST["firstName"];
        $lastName=$_POST["lastName"];
        $username=$_POST["username"];
        $email=$_POST["email"];
        $password=$_POST["password"];
        $role=$_POST["role"];
        $verified=$_POST["verified"];
        $paternName = "/^[A-Z]{1}[a-zčćšđž]{2,12}$/";
        $paternUsername="/^(?=.{8,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+$/";
        $paternPassword="/^(?=.*[a-z])(?=.*[A-Z]).{8,32}$/";

        if(preg_match($paternName,$firstName) 
        && preg_match($paternName, $lastName) 
        && preg_match($paternUsername,$username) 
        && filter_var($email, FILTER_VALIDATE_EMAIL)
        && preg_match($paternPassword, $password)){
            $encryptedPassword=md5($password);
            $statusMessage="";
            $status=ExistInDb($username, $email);
            if($status){
                $updateUser= updateUser($user_id,$firstName,$lastName,$username,$email,$encryptedPassword, $role, $verified);

                if($updateUser){
                    $statusMessage="<span class='fw-bold' style='color:#2aa32c; font-size:18px'>User updated!</span>";
                }

                    
            }else{
                $statusMessage="<p style='color: red'>Email/username does not exist</p>";
            }
            
        }

        $answer = ["answer"=>$statusMessage];
        echo json_encode($answer);
        http_response_code(200); 
    }catch(PDOException $e){
        var_dump($e->getMessage());
    }
}

?>