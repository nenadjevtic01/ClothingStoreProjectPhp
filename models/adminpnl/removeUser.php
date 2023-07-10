<?php
    header("Content-type: application/json");
    include "../../config/connection.php";
    include "../functions.php";
    if($_SERVER["REQUEST_METHOD"]=="POST"){
    try{
        
        if(isset($_POST['id'])){
            $statusText="";
            $id=$_POST['id'];
            if($id>0){
                $query="DELETE FROM user WHERE user_id= :id";
                $prepare=$connection->prepare($query);
                $prepare->bindParam(":id",$id);
    
                $result=$prepare->execute();
                if($result){
                    $statusText="<span class='fw-bold' style='color:#2aa32c; font-size:18px'>User deleted!</span>";
                }else{
                    $statusText="<p style='color: red'>An error occured.</p>";
                }
            }
        }
        $answer = ["answer"=>$statusText];
            echo json_encode($answer);
            http_response_code(201);
    }catch(PDOException $e){
        http_response_code(500);
    }
}
?>