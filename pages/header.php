<header class="header_area fixed">
    <div class="main_menu">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
          <a class="navbar-brand logo_h" href="index.php"><img src="img/logo.png" alt="Site logo Image"></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
            <ul class="nav navbar-nav menu_nav ml-auto mr-auto" id="meni">
              <?php
                  session_start();
                  if($_SESSION){
                    $role=$_SESSION["role"];
                    if($role==2){
                        fetchUserMenu();
                    }else if($role==1){
                      fetchAdminMenu();
                    }
                  }else{
                    fetchMenu();
                  }
              ?>
            </ul>
            <ul class="nav-shop">
              <?php
                //session_start();
                if($_SESSION){
                  echo "<li class='nav-item'><button><a href='cart.php'><i class='ti-shopping-cart'></i></a><span class='nav-shop__circle' id='numberOfProducts'></span></button> </li>";
                }else{
                  echo "<li class='nav-item hidden'><button><a href='cart.php'><i class='ti-shopping-cart'></i></a><span class='nav-shop__circle' id='numberOfProducts'></span></button> </li>";
                }
              ?>
              
              <li class="nav-item"><a class="button button-header" href="shop.php">Buy Now</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
    <a class="scrollToTop" href="#" id="scrollUp" style="display: none;">
      <i class="fa fa-angle-up"></i>
    </a>
  </header>