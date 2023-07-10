<?php
	include "config/connection.php";
    include "models/functions.php";
	include "pages/head.php";
	include "pages/header.php";
?>


  <!--================Single Product Area =================-->
	<div class="product_image_area">
		<div class="container"id="jedanProizvod">
			
		</div>
	</div>
	<!--================End Single Product Area =================-->

	<!--================Product Description Area =================-->
	<section class="product_description_area">
		<div class="container">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active show" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
					 aria-selected="true">Specification</a>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
					<div class="table-responsive" id="tabelaSpecs">
						
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Product Description Area =================-->

	<!--================ Start related Product area =================-->  
	<section class="related-product-area section-margin--small mt-0">
		<div class="container">
			<div class="section-intro pb-60px">
        <p>Popular Item in the market</p>
        <h2>Top <span class="section-intro__style">Product</span></h2>
      </div>
		<div class="row mt-30" id="popularniProizvodi">
        
      </div>
		</div>
	</section>
	<!--================ end related Product area =================-->  	

 <?php
	include "pages/footer.php";
 ?>