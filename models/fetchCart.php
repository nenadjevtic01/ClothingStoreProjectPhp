<?php

    header("Content-type: application/json");
    include "../config/connection.php";
    include "functions.php";
    if($_SERVER["REQUEST_METHOD"]=="POST"){
    try{

        if(isset($_POST["korpa"])){
            $korpa=$_POST["korpa"];
        }

        $query="SELECT p.product_id, p.product_name, i.src, i.alt, p.newPrice,p.oldPrice, p.sale, p.category_id, p.brand_id, p.gender_id, p.inStock, p.availableSizes, p.material, p.coo FROM product p INNER JOIN pictures i ON p.product_id= i.product_id ";

        $prepare=$connection->prepare($query);
        $prepare->execute();

        $result=$prepare->fetchAll();
        $output="";
        $total=0;
        if(!$korpa){
            $output="<div class='col-12' style='display:flex;align-items:center;flex-direction:column'>
            <h3>Cart is empty</h3>
            <a class='button button-header' href='shop.php'>Buy Now</a>
            </div>";
        }else{
            for($i=0;$i<count($korpa);$i++){
                for($j=0;$j<count($result);$j++){
                    if($korpa[$i]["id"]==$result[$j]->product_id){
                        if($i==0){
                            $total+=intval($korpa[$i]["qty"])*$result[$j]->newPrice;
                            $output.="<div class='row p-5 korpaItem prviRedKorpa'>
                            <div class='col-sm-6 col-md-4 col-lg-2 centar'>
                                <img class='malaSlikaKorpa' src='".$result[$j]->src."' alt='".$result[$j]->alt."'/></br>
                            </div>
                            <div class='col-sm-6 col-md-4 col-lg-2 centar'>
                                <h5><a href='single-product.php?id=".$result[$j]->product_id."'>".$result[$j]->product_name."</a></h5>
                            </div>
                            <div class='col-sm-6 col-md-4 col-lg-2 centar'>
                                <span>Quantity: </span>
                                <button class='btn-plus' type='button' value='".$korpa[$i]["id"].",".$korpa[$i]["size"].",".$korpa[$i]["qty"]."' name='btnQty' onclick='dodajQty(this)'><img src='img/plus.svg' alt='Plus svg'/></button>
                                <input class='kolicinaKorpa' type='number' value='".$korpa[$i]["qty"]."' max='99' min='0' >
                                <button class='btn-minus' type='button' value='".$korpa[$i]["id"].",".$korpa[$i]["size"].",".$korpa[$i]["qty"]."' name='btnQty' onclick='smanjiQty(this)'><img src='img/minus.svg' alt='Minus svg'/></button>
                            </div>
                            <div class='col-sm-6 col-md-4 col-lg-2 centar'><span>Selected size: ".$korpa[$i]["size"]."</span></div>
                            <div class='col-sm-6 col-md-4 col-lg-2 centar'><span>Total price: ".$korpa[$i]["qty"]*$result[$j]->newPrice."$</span></div>
                            <div class='col-sm-6 col-md-4 col-lg-2 centar'>
                                <button class='removeItem button primary-btn' type='button' value='".$korpa[$i]["id"].",".$korpa[$i]["size"].",".$korpa[$i]["qty"]."' onclick='UkloniProizvod(this)'>Remove</button>
                            </div>
                            </div>";
                            break;
                        }
                        $total+=intval($korpa[$i]["qty"])*$result[$j]->newPrice;
                        $output.="<div class='row p-5 korpaItem'>
                            <div class='col-sm-6 col-md-4 col-lg-2 centar'>
                                <img class='malaSlikaKorpa' src='".$result[$j]->src."' alt='".$result[$j]->alt."'/></br>
                            </div>
                            <div class='col-sm-6 col-md-4 col-lg-2 centar'>
                                <h5><a href='single-product.php?id=".$result[$j]->product_id."'>".$result[$j]->product_name."</a></h5>
                            </div>
                            <div class='col-sm-6 col-md-4 col-lg-2 centar'>
                                <span>Quantity: </span>
                                <button class='btn-plus' type='button' value='".$korpa[$i]["id"].",".$korpa[$i]["size"].",".$korpa[$i]["qty"]."' name='btnQty' onclick='dodajQty(this)'><img src='img/plus.svg' alt='Plus svg'/></button>
                                <input class='kolicinaKorpa' type='number' value='".$korpa[$i]["qty"]."' max='99' min='0' >
                                <button class='btn-minus' type='button' value='".$korpa[$i]["id"].",".$korpa[$i]["size"].",".$korpa[$i]["qty"]."' name='btnQty' onclick='smanjiQty(this)'><img src='img/minus.svg' alt='Minus svg'/></button>
                            </div>
                            <div class='col-sm-6 col-md-4 col-lg-2 centar'><span>Selected size: ".$korpa[$i]["size"]."</span></div>
                            <div class='col-sm-6 col-md-4 col-lg-2 centar'><span>Total price: ".$korpa[$i]["qty"]*$result[$j]->newPrice."$</span></div>
                            <div class='col-sm-6 col-md-4 col-lg-2 centar'>
                                <button class='removeItem button primary-btn' type='button' value='".$korpa[$i]["id"].",".$korpa[$i]["size"].",".$korpa[$i]["qty"]."' onclick='UkloniProizvod(this)'>Remove</button>
                            </div>
                            </div>";
                    }
                }
            }
    
            $output.="<div class='row p-5 korpaItem'>
            <div class='col-sm-6 col-md-4 col-lg-2'></div>
            <div class='col-sm-6 col-md-4 col-lg-2'></div>
            <div class='col-sm-6 col-md-4 col-lg-2'></div>
            <div class='col-sm-6 col-md-4 col-lg-2 centar'><a href='checkout.php' class='button primary-btn'>Checkout</a></div>
            <div class='col-sm-6 col-md-4 col-lg-2 centar'><h5>Subtotal:</h5></div>
            <div class='col-sm-6 col-md-4 col-lg-2 centar'><h5>".$total."$</h5></div>
            </div>";
        }
        

        $answer=["answer"=>$output];
        echo json_encode($answer);
        http_response_code(201);

    }catch(PDOException $e){
        http_response_code(500);
    }
}
?>