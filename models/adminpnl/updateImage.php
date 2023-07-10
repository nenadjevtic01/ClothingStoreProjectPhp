<?php
header("Content-type: application/json");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    include "../../config/connection.php";
    include "../functions.php";

    try{
        $slika=$_FILES['slika'];
        $id=$_POST['product_id'];
        $dozvoljeniTipoviSlika = ["image/jpg", "image/jpeg", "image/png"];
        $slikaIme = $slika['name'];
        $slikaTmpFajla = $slika['tmp_name'];
        $slikaVelicina = $slika['size'];
        if($slikaVelicina<2500000){
            $slikaTipFajla = $slika['type'];
            if (in_array($slikaTipFajla, $dozvoljeniTipoviSlika)){
                $novoImeSlike = time() . "_" . $slikaIme;
                $putanja = "../../img/imagesDB/" . $novoImeSlike;
                $putanjaAdd=substr($putanja,6);
                if (move_uploaded_file($slikaTmpFajla, $putanja)) {
                    $upitInsertSlike = $connection->prepare("UPDATE pictures SET src=:src,alt=:alt WHERE product_id=:proizvod_id");
                    $upitInsertSlike->bindParam(":proizvod_id", $id);
                    $upitInsertSlike->bindParam(":src", $putanjaAdd);
                    $upitInsertSlike->bindParam(":alt", $slikaIme);
                    $upitInsertSlike->execute();

                    if ($upitInsertSlike) {
                        http_response_code(201);
                    }
                }
            }
        }
        
    }catch(PDOException $e){
        http_response_code(500);
    }
}


?>