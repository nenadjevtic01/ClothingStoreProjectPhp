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
        $query="SELECT poll_name, status FROM poll WHERE poll_id = :poll";
        $prepare=$connection->prepare($query);
        $prepare->bindParam(":poll",$id);
        $prepare->execute();
    
        $result=$prepare->fetch();
    
        $answer=array("pollName"=>$result->poll_name,"status"=>$result->status);
    }
    
    echo json_encode($answer);
    http_response_code(200);

}catch(PDOException $e){
    http_response_code(500);
}
}

?>