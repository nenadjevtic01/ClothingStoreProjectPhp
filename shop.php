<?php
  include "config/connection.php";
  include "models/functions.php";
  include "pages/head.php";
  include "pages/header.php";
?>
	<!-- ================ category section start ================= -->		  
  <section class="section-margin--small mb-5">
    <div class="container pt-5">
      <div class="row">
        <div class="col-xl-3 col-lg-4 col-md-5">
          <div class="sidebar-categories">
            <div class="head">Category</div>
            <ul class="main-categories" id="kategorije">
                <?php
                  $result=getCategory();
                  foreach($result as $red){
                    echo "<li class='filter-list'><input class='pixel-radio pixel-checkbox category' type='checkbox' id='category".$red->category_name."' name='category' value='category".$red->category_id."'/><label for='".$red->category_name."'> ".$red->category_name."</label></li>";
                  }

                ?>
            </ul>
          </div>
          <div class="sidebar-filter">
            <div class="top-filter-head">Filters</div>
            <div class="common-filter">
              <div class="head">Brand</div>
                <ul id="brendovi">
                <?php
                      $result= getBrand();
                      foreach($result as $red){
                       echo "<li class='filter-list'><input class='pixel-radio pixel-checkbox brand' type='checkbox' id='brand".$red->brand_name."' name='brand' value='brand".$red->brand_id."'/><label for='".$red->brand_name."'>".$red->brand_name."</label></li>" ;
                      }

                  ?>
                </ul>
            </div>
            <div class="common-filter">
              <div class="head">Gender</div>
                <ul id="gender">
                  <?php
                      $result= getGender();
                      foreach($result as $red){
                       echo "<li class='filter-list'><input class='pixel-radio pixel-checkbox pol' type='checkbox' id='".$red->gender_name."' value='pol".$red->gender_id."' name='gender'/><label for='".$red->gender_name."'> ".$red->gender_name."</label></li>" ;
                      }

                  ?>
                </ul>
            </div>
            <div class="common-filter">
              <div class="head">Availability</div>
              <ul id="dostupnost">
                <li class="filter-list"><input class="pixel-checkbox pixel-radio stanje" type="checkbox" id="dostupno" value="dostupno" ><label for="dostupno" id="dostupnoText"> Available</label></li>
                <li class="filter-list"><input class="pixel-checkbox pixel-radio stanje" type="checkbox" id="nedostupno" value="nedostupno"><label for="nedostupno" id="nedostupnoText"> Unavailable</label></li>
              </ul>
            </div>
            <div class="common-filter d-flex justify-content-center">
              <input type="button" class="btn btn-primary btn-sm hidden" id="clearFilters" value="Clear filters"/>
            </div>
          </div>
        </div>
        <div class="col-xl-9 col-lg-8 col-md-7">
          <!-- Start Filter Bar -->
          <div class="filter-bar d-flex flex-wrap align-items-center">
            <div class="sorting">
              <select id="sortiranje">
                <option value="0">Select sorting</option>
                <option value="priceAscending">Price ascending</option>
                <option value="priceDescending">Price descending</option>
                <option value="nameAscending">Name ascending</option>
                <option value="nameDescending">Name descending</option>
              </select>
            </div>
            <div class="sorting mr-auto">
              <select class="hidden">
                <option value="1">Show 12</option>
                <option value="1">Show 12</option>
                <option value="1">Show 12</option>
              </select>
            </div>
            <div>
              <div class="input-group filter-bar-search">
                <input type="text" placeholder="Search" id="searchText">
                <div class="input-group-append">
                  <button type="button" id="search" disabled class="iskljucen"><i class="ti-search"></i></button>
                </div>
              </div>
            </div>
          </div>
          <!-- End Filter Bar -->
          <!-- Start Best Seller -->
          <section class="lattest-product-area pb-40 category-list">
            <div class="row" id="proizvodi">
              
            
              

            
          </section>
          <!-- End Best Seller -->
        </div>
      </div>
    </div>
  </section>
	<!-- ================ category section end ================= -->		  

	<!-- ================ top product area start ================= -->	
	<section class="related-product-area">
		<div class="container">
			<div class="section-intro pb-60px">
        <p>Popular Item in the market</p>
        <h2>Top <span class="section-intro__style">Product</span></h2>
      </div>
			<div class="row mt-30" id="popularniProizvodi">
        
      </div>
		</div>
	</section>
</br>
	<!-- ================ top product area end ================= -->		
	  


<?php
  include "pages/footer.php";
?>