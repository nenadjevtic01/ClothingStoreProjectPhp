<?php
    header("Content-type: application/json");

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        include "../../config/connection.php";
        include "../functions.php";

        try{
            $id=$_POST["id"];
            $name=$_POST["name"];
            $q1=$_POST["q1"];
            $q2=$_POST["q2"];
            $q3=$_POST["q3"];
            $status=$_POST["status"];
            $statusMessage="";

            if(trim($name)!="" && trim($q1)!="" && trim($q2)!="" && trim($q3)!=""){

                $surveyExist=surveyExist($name);
                if($surveyExist){
                    $updateSurvey=updateSurvey($id,$name,$q1, $q2, $q3, $status);
    
                    if($updateSurvey){
                        $statusMessage="<span class='fw-bold' style='color:#2aa32c; font-size:18px'>Survey updated!</span>";
                    }else{
                        $statusMessage="<p style='color: red'>An error occured.</p>";
                    }
                }else{
                    $statusMessage="<p style='color: red'>Survey name does not exist.</p>";
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