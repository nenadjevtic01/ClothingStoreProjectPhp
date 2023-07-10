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
            $query=" SELECT material, coo FROM product WHERE product_id=:product_id";

            $prepare=$connection->prepare($query);
            $prepare->bindParam(":product_id",$proizvod);

            $prepare->execute();

            $result=$prepare->fetch();

            $output="<table class='table'>
            <tbody>
                <tr>
                    <td>
                        <h5>Material</h5>
                    </td>
                    <td>
                        <h5>".$result->material."</h5>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5>Country of origin</h5>
                    </td>
                    <td>
                        <h5>".$result->coo."</h5>
                    </td>
                </tr>
            </tbody>
        </table>";
        }

        $answer=["answer"=>$output];
        echo json_encode($answer);
        http_response_code(201);

    }catch(PDOException $e){
        http_response_code(500);
    }
}
?>