<?php
header("Content-type: application/json");
include "../config/connection.php";
include "functions.php";

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

        $query="SELECT p.product_id, p.product_name, i.src, i.alt, p.newPrice,p.oldPrice, p.sale, p.category_id, p.brand_id, p.gender_id, p.inStock, p.availableSizes, p.material, p.coo FROM product p INNER JOIN pictures i ON p.product_img= i.picture_id WHERE product_id>0";
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

        $output="";
        for($i=0;$i<$n_o_pages;$i++){
            $output.="<li class='page-item'><a class='page-link' href='shop.php?page=".($i+1)."' >".($i+1)."</a></li>";
        }

        $answer=["answer"=>$output];
        echo json_encode($answer);
        http_response_code(201);

    }catch(PDOException $e){
        http_response_code(500);
    }

?>