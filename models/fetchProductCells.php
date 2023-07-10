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
        $query="SELECT product_name, category_id, brand_id, gender_id,sale,newPrice, inStock, availableSizes, material, coo FROM product WHERE product_id = :id";
        $prepare=$connection->prepare($query);
        $prepare->bindParam(":id",$id);
        $prepare->execute();
    
        $result=$prepare->fetch();
    
        $answer=array("product_name"=>$result->product_name,"category"=>$result->category_id,"brand"=>$result->brand_id,"gender"=>$result->gender_id,"sale"=>$result->sale,"price"=>$result->newPrice,"inStock"=>$result->inStock,"sizes"=>$result->availableSizes,"material"=>$result->material,"coo"=>$result->coo);
    }
    
    echo json_encode($answer);
    http_response_code(200);

}catch(PDOException $e){
    http_response_code(500);
}
}

?>