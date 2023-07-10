<?php
    header("Content-type: application/json");
    include "../config/connection.php";
    include "functions.php";
    if($_SERVER["REQUEST_METHOD"]=="POST"){
    try{

        if(isset($_POST["korpa"])){
            $korpa=$_POST["korpa"];
        }

        if($korpa){
            $query="SELECT product_id, product_name, newPrice FROM product";

            $prepare=$connection->prepare($query);
            $prepare->execute();
            
            $result=$prepare->fetchAll();
            $output="<li style='border-bottom:1px solid #000'><a href='cart.php'><h4>Product <span>Total</span></h4></a></li>";
            for($i=0;$i<count($korpa);$i++){
                for($j=0;$j<count($result);$j++){
                    if($korpa[$i]["id"]==$result[$j]->product_id){
    
                        $output.="<li class='checkoutProizvodi'><a href='single-product.php?id=".$korpa[$i]["id"]."'>".$result[$j]->product_name." <span class='last'><span class='kolicinaKorpa'>x ".$korpa[$i]["qty"]."</span> &nbsp;&nbsp;&nbsp; ".$korpa[$i]["qty"]*$result[$j]->newPrice."$</span></a></li>";
                        break;
                    }
                }
            }
    
            
        }else{
            $output="<h4>Empty cart</h4>";
        }
        
        $answer=["answer"=>$output];
        echo json_encode($answer);
        http_response_code(201);

    }catch(PDOException $e){
        http_response_code(500);
    }
}
?>