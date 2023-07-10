<?php
    include "config/connection.php";
    include "models/functions.php";
    include "pages/head.php";
    include "pages/header.php";
    include "pages/main.php";
    if($_SESSION){
		if($_SESSION["role"]){
            include "pages/survey.php";
        }
    }
    include "pages/footer.php";
?>