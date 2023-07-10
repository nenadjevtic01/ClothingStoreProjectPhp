<?php

    header("Content-type: application/json");
    include "../config/connection.php";
    include "functions.php";
    if($_SERVER["REQUEST_METHOD"]=="POST"){
    try{
        if(isset($_POST["pol"])){
            $pol=$_POST["pol"];
        }else{
            $pol="";
        }
        if(isset($_POST["kategorije"])){
            $kategorije=$_POST["kategorije"];
        }else{
            $kategorije="";
        }
        if(isset($_POST["brend"])){
            $brendovi=$_POST["brend"];
        }else{
            $brendovi="";
        }
        if(isset($_POST["dostupnost"])){
            $dostupnost= $_POST["dostupnost"];
        }else{
            $dostupnost= "";
        }

        if(isset($_POST["nacinSortiranja"])){
            $nacinSortiranja=$_POST["nacinSortiranja"];
        }else{
            $nacinSortiranja="";
        }

        if(isset($_POST["search"])){
            $search=$_POST["search"];
        }else{
            $search="";
        }
        
        $query="SELECT p.product_id, p.product_name, i.src, i.alt, p.newPrice,p.oldPrice, p.sale, p.category_id, p.brand_id, p.gender_id, p.inStock, p.availableSizes, p.material, p.coo FROM product p INNER JOIN pictures i ON p.product_id= i.product_id WHERE 1";
        if($pol!=""){
            $query.=" AND gender_id IN (".implode(",",$pol).")";
        }

        if($kategorije!=""){
            $query.=" AND category_id IN(".implode(",",$kategorije).")";
        }

        if($brendovi!=""){
            $query.=" AND brand_id IN(".implode(",",$brendovi).")";
        }

        if($dostupnost!=""){
            $query.=" AND inStock IN(".implode(",",$dostupnost).")";
        }

        if($search!=""){
            $query.=" AND LOWER(p.product_name) LIKE('%".$search."%')";
        }

        if($nacinSortiranja!=""){
            $query.=" ORDER BY p.".$nacinSortiranja;
        }


        $prepare=$connection->prepare($query);
        $prepare->execute();

        $result=$prepare->fetchAll();

        $results_per_page = 12;
        $resultNumber = count($result);

        $n_o_pages = ceil ($resultNumber / $results_per_page);

        if (!isset($_POST["page"])) {  
            $page = 1;  
        } else {  
            $page = intval($_POST["page"]);  
        }  

        $page_first_result = ($page-1) * $results_per_page;

        $query.=" LIMIT ".$page_first_result.",".$results_per_page;

        $prepare=$connection->prepare($query);
        $prepare->execute();

        $result=$prepare->fetchAll();

        $output="";
        foreach($result as $red){
            $output.="<div class='col-md-6 col-lg-4'>
            <div class='card text-center card-product'>
              <div class='card-product__img '>
                <a href='single-product.php?id=".$red->product_id."'><img class='card-img slikaProizvoda' src='".$red->src."' alt='Slika ".$red->alt."' value=".$red->product_id." id='proizvod'></a>
              </div>
              <div class='card-body'>
                </br>
                <h4 class='card-product__title'><a href='single-product.php?id=".$red->product_id."'>".$red->product_name."</h4></a>";
                if($red->oldPrice!=null){
                    $output.="<p class='card-product__price newPrice'>".$red->newPrice."€</p>";
                    $output.="<p class='card-product__price strike' >".$red->oldPrice."€</p>";
                }else{
                    $output.="<p class='card-product__price'>".$red->newPrice."€</p>";
                }
             $output.="</div>
            </div>
          </div>";
        }

        $output.="</div>";
        if($n_o_pages>1){
            $output.="<div class='row d-flex flex-row justify-content-center col-12'><ul class='pagination'>";
            for($i=0;$i<$n_o_pages;$i++){
                $output.="<li class='page-item'><a class='page-link' href='shop.php?page=".($i+1)."'>".($i+1)."</a></li>";
            }
            $output.="</ul></div>";
        }
        

        $answer=["answer"=>$output];
        echo json_encode($answer);
        http_response_code(200);

    }catch(PDOException $e){
        var_dump($e->getMessage());
        http_response_code(500);
    }
    }
?>