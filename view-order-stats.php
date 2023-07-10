<?php
    include "config/connection.php";
    include "models/functions.php";
    include "pages/head.php";
    include "pages/header.php";
?>

<?php
    if($_SESSION){
        if($_SESSION["role"]==1){
            $id=$_GET['id'];
            if($id){
                echo "<section class='section-margin--small mb-5'>
                <h1 class='text-center pt-5'>Order details</h1></br>
                <div class='d-flex justify-content-center'>
                    <table class='w-75 table table-striped table-responsive-md'>
                      <thead>
                        <th>Receipt Item ID</th>
                        <th>Product name</th>
                        <th>Price</th>
                        <th>Size</th>
                        <th>Quantity</th>
                      </thead>
                      <tbody>";
                      echo fetchOrderDetails($id);  
                      echo "</tbody>
                    </table>
                </div>
                <div class='d-flex justify-content-center'>
                    <input type='button' class='btn btn-primary' value='Back' onclick='redirectAdmin()'/>
                </div>
              </section></br>";
            }
        }
    }
?>

<?php
    include "pages/footer.php";
?>