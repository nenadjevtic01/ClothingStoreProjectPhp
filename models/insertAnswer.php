<?php
    header("Content-type: application/json");

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        include "../config/connection.php";
        include "functions.php";

        try{
            $statusMessage="";
            $answer=$_POST['answer'];
            session_start();
            $username=$_SESSION['username'];
            $poll_id=$_SESSION['poll_id'];
            $id=fetchId($username);
            $query="INSERT INTO poll_answers(poll_id,user_id,answer) VALUES(:poll,:id,:answer)";
            $prepare=$connection->prepare($query);
            $prepare->bindParam(":poll",$poll_id);
            $prepare->bindParam(":answer",$answer);
            $prepare->bindParam(":id",$id);
            $result=$prepare->execute();

            if($result){
                $statusMessage="<p style='color: green'>Answer submited.</p>";
            }else{
                $statusMessage="<p style='color: red'>An error occured.</p>";
            }

            $answer = ["answer"=>$statusMessage];
            echo json_encode($answer);
            http_response_code(201);
        }catch(PDOException $e){
            var_dump($e->getMessage());
        }

    }



?>