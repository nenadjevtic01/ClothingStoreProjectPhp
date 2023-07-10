<?php
    include "config.php";

    try{
        $connection=new PDO("mysql:host=".hostname.";dbname=".dbname.";charset=utf8",username,password);

        $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>