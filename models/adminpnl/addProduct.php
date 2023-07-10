<?php
header("Content-type: application/json");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    include "../../config/connection.php";
    include "../functions.php";

    try{

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

        $query="INSERT INTO product(product_name,category_id,brand_id, gender_id,sale,newPrice,inStock,availableSizes,material, coo) VALUES(:name,:category,:brand,:gender,:sale,:price,:inStock,:size,:material,:coo)";
        $statusMessage="";
        $prepare=$connection->prepare($query);
        $prepare->bindParam(":name",$name);
        $prepare->bindParam(":category",$category);
        $prepare->bindParam(":brand",$brand);
        $prepare->bindParam(":gender",$gender);
        $prepare->bindParam(":sale",$sale);
        $prepare->bindParam(":price",$price);
        $prepare->bindParam(":inStock",$inStock);
        $prepare->bindParam(":size",$sizes);
        $prepare->bindParam(":material",$material);
        $prepare->bindParam(":coo",$coo);

        $result=$prepare->execute();

        if($result){
            session_start();
            $_SESSION['last_index']= $connection->lastInsertId();
            $statusMessage="<span class='fw-bold' style='color:#2aa32c; font-size:18px'>Product add successfull!</span>";
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