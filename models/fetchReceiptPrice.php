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

            $query="SELECT product_id, newPrice FROM product";
            $prepare=$connection->prepare($query);
            $prepare->execute();
            $result=$prepare->fetchAll();
            $total=0;
            for($i=0;$i<count($korpa);$i++){
                for($j=0;$j<count($result);$j++){
                    if($korpa[$i]["id"]==$result[$j]->product_id){
                        $total+=$result[$j]->newPrice*$korpa[$i]["qty"];
                        break;
                    }
                }
            }

            $output="</hr><li><a href='javascript:void(0)'>Subtotal <span id='subtotal'>".$total."$</span></a></li>
            <li><a href='javascript:void(0)'>Shipping <span>Flat rate: 50.00$</span></a></li>
            <li><a href='javascript:void(0)' class='pointer'>Total <span id='total'>".($total+50)."$</span></a></li>";
        }else{
            $output="<h5>Access denied. </h5>";
        }

        $answer=["answer"=>$output];
        echo json_encode($answer);
        http_response_code(201);

    }catch(PDOException $e){
        http_response_code(500);
    }
    }
?>