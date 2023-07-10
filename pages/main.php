<main class="site-main">
    
    <!--================ Hero banner start =================-->
    <section class="hero-banner">
      <div class="container">
        <div class="row no-gutters align-items-center pt-60px">
          <div class="col-5 d-none d-sm-block">
            <div class="hero-banner__img">
              <img class="img-fluid" src="img/index/banner.png" alt="Shop banner">
            </div>
          </div>
          <div class="col-sm-7 col-lg-6 offset-lg-1 pl-4 pl-md-5 pl-lg-0">
            <div class="hero-banner__content">
              <h1 class="naslovIndex">WE make clothes</br>
                <b>YOU</b> make fashion</h1>
              <p class="quoteSize">
                Browse Our Premium Products</p>
              <a class="button button-hero" href="shop.php">Browse Now</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================ Hero banner start =================-->

    <!--================ Hero Carousel start =================-->
    <section class="section-margin mt-0">
      <div class="owl-carousel owl-theme hero-carousel">
        <div class="hero-carousel__slide">
          <img src="img/index/slide1.jpg" alt="Quality guarantee Image" class="img-fluid">
          <a href="javascript:void(0)" class="hero-carousel__slideOverlay linkPointer">
            <h3>Quality guarantee</h3>
          </a>
        </div>
        <div class="hero-carousel__slide">
          <img src="img/index/slide2.jpg" alt="Product reliability Image" class="img-fluid">
          <a href="javascript:void(0)" class="hero-carousel__slideOverlay linkPointer">
            <h3>Product reliability</h3>
          </a>
        </div>
        <div class="hero-carousel__slide">
          <img src="img/index/slide3.jpg" alt="Affordable prices Image" class="img-fluid">
          <a href="javascript:void(0)" class="hero-carousel__slideOverlay linkPointer">
            <h3>Affordable prices</h3>
          </a>
        </div>
      </div>
    </section>
    <!--================ Hero Carousel end =================-->

    <!-- ================ trending product section start ================= -->  
    <section class="section-margin calc-60px">
      <div class="container">
        <div class="section-intro pb-60px">
          <p>Popular Item in the market</p>
          <h2>Trending <span class="section-intro__style">Product</span></h2>
        </div>
        <div class="row" id="proizvodiPrvaStrana">
          <?php
            fetchProductsIndex();
          ?>
        </div>
      </div>
    </section>
    <!-- ================ trending product section end ================= -->  


    <!-- ================ offer section start ================= --> 
    <section class="offer" id="parallax-1" data-anchor-target="#parallax-1" data-300-top="background-position: 20px 30px" data-top-bottom="background-position: 0 20px">
      <div class="container">
        <div class="row">
          <div class="col-xl-5">
            <div class="offer__content text-center">
              <h3>Up To 60% Off</h3>
              <h4>Year Sale</h4>
              <a class="button button--active mt-3 mt-xl-4" href="shop.php">Shop Now</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ================ offer section end ================= --> 

    <!-- ================ Best Selling item  carousel ================= --> 
    <section class="section-margin calc-60px">
      <div class="container">
        <div class="section-intro pb-60px">
          <p>Popular Item in the market</p>
          <h2>Best <span class="section-intro__style">Sellers</span></h2>
        </div>
        <div class="owl-carousel owl-theme" id="bestSellerCarousel">
          <?php
            fetchSliderProducts();
          ?>
        </div>
      </div>
    </section>
    <!-- ================ Best Selling item  carousel end ================= --> 




    

  </main>