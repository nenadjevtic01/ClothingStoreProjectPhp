<?php
header("Content-type: application/json");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    include "../../config/connection.php";
    include "../functions.php";

    try{
        $id=$_POST['id'];
        $name=$_POST["naziv"];
        $brand=$_POST["brend"];
        $category=$_POST["kategorija"];
        $gender=$_POST["pol"];
        $price=$_POST["cena"];
        $material=$_POST["materijal"];
        $coo=$_POST["coo"];
        $sizes=$_POST["sizes"];
        $inStock=$_POST["inStock"];
        $sale=$_POST["sale"];
        $oldPrice=getOldPrice($id);
        $query="UPDATE product SET product_name=:name, category_id=:category,brand_id=:brand,gender_id=:gender, sale=:sale,oldPrice=:oldPrice,newPrice=:price, inStock=:inStock, availableSizes=:size, material=:material, coo=:coo WHERE product_id=:id";
        $statusMessage="";
        $prepare=$connection->prepare($query);
        $prepare->bindParam(":name",$name);
        $prepare->bindParam(":category",$category);
        $prepare->bindParam(":brand",$brand);
        $prepare->bindParam(":gender",$gender);
        $prepare->bindParam(":sale",$sale);
        $prepare->bindParam(":oldPrice",$oldPrice);
        $prepare->bindParam(":price",$price);
        $prepare->bindParam(":inStock",$inStock);
        $prepare->bindParam(":size",$sizes);
        $prepare->bindParam(":material",$material);
        $prepare->bindParam(":coo",$coo);
        $prepare->bindParam(":id",$id);
        $result=$prepare->execute();

        if($result){
            $statusMessage="<span class='fw-bold' style='color:#2aa32c; font-size:18px'>Product update successfull!</span>";
            http_response_code(201);
        }else{
            $statusMessage="<p style='color: red'>An error occured.</p>";
            http_response_code(408);
        }
        $answer = ["answer"=>$statusMessage];
        echo json_encode($answer);
    }catch(PDOException $e){
        http_response_code(500);
    }

}



?>