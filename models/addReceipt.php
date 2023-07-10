<?php
header("Content-type: application/json");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    include "../config/connection.php";
    include "functions.php";

    try{
        $address=$_POST['address'];
        $city=$_POST['city'];
        $zip=$_POST['zip'];
        $subtotal=$_POST['subtotal'];
        $total=$_POST['total'];
        $products=$_POST['products'];
        $note=$_POST['note'];
        session_start();
        $username=$_SESSION['username'];
        $id=fetchId($username);
        if($products){
            $query="INSERT INTO receipt(user_id,address,city,zip,subtotal,total,order_note)VALUES(:id,:address,:city,:zip,:subtotal,:total,:note)";
            $prepare=$connection->prepare($query);
            $prepare->bindParam(":id",$id);
            $prepare->bindParam(":address",$address);
            $prepare->bindParam(":city",$city);
            $prepare->bindParam(":zip",$zip);
            $prepare->bindParam(":subtotal",$subtotal);
            $prepare->bindParam(":total",$total);
            $prepare->bindParam(":note",$note);
            $result=$prepare->execute();
            $statusMessage="";
            if($result){
                $receipt_id=$connection->lastInsertId();
                foreach($products as $product){
                    $price=getPrice($product['id']);
                    $query="INSERT INTO receipt_item(product_id,price,quantity,size,receipt_id) VALUES (:id,:price,:quantity,:size,:receipt_id)";
                    $prepare=$connection->prepare($query);
                    $prepare->bindParam(":id",$product["id"]);
                    $prepare->bindParam(":price",$price);
                    $prepare->bindParam(":size",$product['size']);
                    $prepare->bindParam(":quantity",$product['qty']);
                    $prepare->bindParam(":receipt_id",$receipt_id);
                    $result=$prepare->execute();
                    if($result){
                        $statusMessage="<h6 style='font-size:18px; color:green'>Order sent!</h6>";
                    }else{
                        $statusMessage="<p style='font-size:18px; color:red'>An error occured!</p>";
                    }
                }
            }else{
                $statusMessage="<p style='font-size:18px; color:red'>An error occured!</p>";
            }
        }else{
            $statusMessage="<p style='font-size:18px; color:red'>Cart empty!</p>";
        }
        

        $answer = ["answer"=>$statusMessage];
        echo json_encode($answer);
        http_response_code(201);
    }catch(PDOException $e){
        http_response_code(500);
    }
}


?>