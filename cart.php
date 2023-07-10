<?php
  include "config/connection.php";
  include "models/functions.php";
	include "pages/head.php";
	include "pages/header.php";
?>

	<!-- ================ start banner area ================= -->	
	<section class="blog-banner-area" id="category">
		<div class="container h-100">
			<div class="blog-banner">
				<div class="text-center">
					<h1>Shopping Cart</h1>
					<nav aria-label="breadcrumb" class="banner-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
            </ol>
          </nav>
				</div>
			</div>
    </div>
	</section>
	<!-- ================ end banner area ================= -->
  
  

  <!--================Cart Area =================-->
  <section class="cart_area">
      <div class="container-fluid w-75">
        <?php
          if($_SESSION){
            echo "<div id='prikazKorpe'>
            </div>";
          }else{
            echo "<div id='prikazKorpe' style='display:none'>
            </div>
            <div class='d-flex justify-content-center'>
            <h3>Access denied</h3></div>";
          }
        ?>
        <!-- <div id="prikazKorpe">
        </div> -->
      </div>
  </section>
  <!--================End Cart Area =================-->



 <?php
	include "pages/footer.php";
 ?>