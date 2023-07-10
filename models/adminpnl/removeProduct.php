<?php
    header("Content-type: application/json");
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        include "../../config/connection.php";
        include "../functions.php";

        try{

            if(isset($_POST["id"])){
                $statusMessage="";
                $id=$_POST["id"];
                if($id>0){
                    $query="DELETE FROM product WHERE product_id=:id";
                    $prepare=$connection->prepare($query);
                    $prepare->bindParam(":id",$id);
                    $result=$prepare->execute();
                    
                    if($result){
                        $statusMessage="<span class='fw-bold' style='color:#2aa32c; font-size:18px'>Product removed!</span>";
                    }else{
                        $statusMessage="<p style='color: red'>An error occured.</p>";
                    }
                }

                $answer = ["answer"=>$statusMessage];
                echo json_encode($answer);
                http_response_code(200);
            }
        }catch(PDOException $e){
            http_response_code(500);
        }

    }
?>