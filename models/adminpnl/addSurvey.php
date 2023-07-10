<?php
header("Content-type: application/json");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    include "../../config/connection.php";
    include "../functions.php";


    try{
        $name=$_POST["name"];
        $status=$_POST["status"];
        $statusMessage="";
        if(trim($name)!=""){

            $surveyExist=surveyExist($name);
            if(!$surveyExist){
                $addSurvey=addSurvey($name, $status);

                if($addSurvey){
                    $statusMessage="<span class='fw-bold' style='color:#2aa32c; font-size:18px'>Survey add successfull!</span>";
                }else{
                    $statusMessage="<p style='color: red'>An error occured.</p>";
                }
            }else{
                $statusMessage="<p style='color: red'>Survey name already exist.</p>";
            }
        }
        $answer = ["answer"=>$statusMessage];
        echo json_encode($answer);
        http_response_code(201);
    }catch(PDOException $e){
        http_response_code(500);
    }
}

?>