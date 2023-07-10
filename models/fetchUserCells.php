<?php
header("Content-type: application/json");
include "../config/connection.php";
include "functions.php";
if($_SERVER["REQUEST_METHOD"]=="POST"){
try{
    if(isset($_POST["id"])){
        $id=$_POST["id"];
    }
    $answer="";
    if($id>0){
        $query="SELECT first_name, last_name, username, email, role_id FROM user WHERE user_id = :user_id";
        $prepare=$connection->prepare($query);
        $prepare->bindParam(":user_id",$id);
        $prepare->execute();
    
        $result=$prepare->fetch();
    
        $answer=array("firstName"=>$result->first_name,"lastName"=>$result->last_name,"username"=>$result->username,"email"=>$result->email,"role"=>$result->role_id);
    }
    
    echo json_encode($answer);
    http_response_code(200);

}catch(PDOException $e){
    http_response_code(500);
}
}
?>