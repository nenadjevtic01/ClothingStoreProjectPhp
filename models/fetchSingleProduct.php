<?php
    header("Content-type: application/json");
    include "../config/connection.php";
    include "functions.php";

    if($_SERVER["REQUEST_METHOD"]=="POST"){
    try{

        if(isset($_POST["id_proizvoda"])){
            $proizvod=$_POST["id_proizvoda"];
        }else{
            $proizvod="";
        }
    
        if($proizvod!=""){
            $query="SELECT p.product_id, p.product_name, i.src, i.alt, p.newPrice,p.oldPrice, c.category_name, p.gender_id, p.inStock, p.availableSizes FROM product p INNER JOIN pictures i ON p.product_id= i.product_id INNER JOIN category c ON p.category_id=c.category_id INNER JOIN brand b ON p.brand_id=b.brand_id WHERE p.product_id= :product_id";
    
            $prepare=$connection->prepare($query);
            $prepare->bindParam(":product_id",$proizvod);
            $prepare->execute();
    
            $result=$prepare->fetch();
    
            $output="<div class='row s_product_inner proizvodMargin'>
            <div class='col-lg-6'>
                <div>
                    <div class='single-prd-item'>
                        <img class='img-fluid col-md-12' src='".$result->src."' alt='".$result->alt."'>
                    </div>
                </div>
            </div>
            <div class='col-lg-5 offset-lg-1'>
                <div class='s_product_text jedanProizvod'>
                    <h3>".$result->product_name."</h3>";
                    if($result->oldPrice!=null){
                        $output.="<h2 class='newPrice'>".$result->newPrice."$</h2>";
                        $output.="<h4 class='strike'>".$result->oldPrice."$</h4>";
                    }else{
                        $output.="<h2>".$result->newPrice."$</h2>";
                    }
                    $output.="<ul class='list'>
                        <li><span>Category</span> : ".$result->category_name."</li>
                        <li><span>Availibility</span> : ".($result->inStock ? "In stock" : "Unavailable")."</li>
                    </ul>";
                        session_start();
                        if($_SESSION){
                            if($_SESSION["role"]){
                                if($result->availableSizes!=null){
                                    $output.="<p>Available sizes: </br>";
                                    $sizes=explode(",",$result->availableSizes);
                                    for($j=0;$j<count($sizes);$j++){
                                        $output.="<input type='radio' class='pixel-radio size' name='size' value='".$sizes[$j]."' id='".$sizes[$j]."'/><label for='".$sizes[$j]."'>".$sizes[$j]."</label>";
                                        $output.="</br>";
                                    }
                                        $output.="<h6 class='hidden crveno' id='izaberiVelicinu'>SELECT SIZE</h6>";
                                    if($result->gender_id==1){
                                        $output.="<a class='underlined' href='img/Size guide for Men.png' target='_blank'><span>Size guide</span></a>";
                                    }else{
                                        $output.="<a class='underlined' href='img/Size guide for Women.png' target='_blank'><span>Size guide</span></a>";
                                    }
                                    $output.="</p>";
                                    $output.="<div class='product_count'>
                                    <label for='qty'>Quantity:</label>
                                                    <input type='number' name='qty' id='qty' size='2' maxlength='12' value='1' min=1 max=99 title='Quantity:' class='input-text qty'/>
                                                    <a class='button primary-btn' id='addToCart' data-id='".$result->product_id."' href='javascript:void(0)' onclick='dodajUkorpu(".$result->product_id.")'>Add to Cart</a>
                                                    <h6 class='hidden crveno' id='izaberiKolicinu'>INVALID QUANTITY</h6>            
                                              </div>";
                                }else{
                                    $output.="<p>No sizes available</p>";
                                    $output.="<h3>Product unavailable</h3>";
                                }
                            }
                        }else{
                            $output.="<h5 class='mt-5' style='color: green'>Login to buy</h5>";
                        }
                        
                    
                        $output.="</div>
                        </div>
                    </div>";
        }else{
            $output.="Forbidden";
        }


        $answer=["answer"=>$output];
        echo json_encode($answer);
        http_response_code(201);
    }catch(PDOException $e){
        http_response_code(500);
    }
}

?>