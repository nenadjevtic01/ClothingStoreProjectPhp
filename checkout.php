<?php
    include "config/connection.php";
    include "models/functions.php";
    include "pages/head.php";
    include "pages/header.php";
?>

	<!-- ================ start banner area ================= -->	
	<section class="blog-banner-area pozadinaCheckout" id="category">
		<div class="container h-100 shadowLogin">
			<div class="blog-banner">
				<div class="text-center">
					<h1>Checkout</h1>
					<nav aria-label="breadcrumb" class="banner-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
          </nav>
				</div>
			</div>
    </div>
	</section>
	<!-- ================ end banner area ================= -->
  
  
  <!--================Checkout Area =================-->
  <section class="checkout_area section-margin--small">
    <div class="container">
        <div class="billing_details">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Billing Details</h3>
                    <form class="row contact_form" action="#" method="post" novalidate="novalidate">
                        <!-- <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Full name">
                            <span class="placeholder hidden" data-placeholder="Last name" id="upozorenjeIme">Enter your name!</span>
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="company" name="company" placeholder="Company name(Optional)">
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="number" name="number" placeholder="Phone number - in + format">
                            <span class="placeholder hidden" data-placeholder="Phone number" id="upozorenjeTelefon">Enter your phone number!</span>
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="email" name="compemailany" placeholder="Email">
                            <span class="placeholder hidden" data-placeholder="Email Address" id="upozorenjeEmail">Enter email address!</span>
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <select class="country_select" style="color:#777777" id="CountrySelect">
                                <option value>Select country</option>
                                <option value="SRB">Serbia</option>
                                <option value="MNG">Montenegro</option>
                                <option value="BIH">Bosnia & Hercegovina</option>
                                <option value="CRO">Croatia</option>
                            </select>
                            <span class="placeholder hidden" data-placeholder="Country" id="upozorenjeZemlja">Select country!</span>
                        </div> -->
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" id="address" name="address" placeholder="Address">
                            <span class="placeholder hidden" data-placeholder="Address" id="upozorenjeAdresa">Enter your address!</span>
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" id="city" name="city" placeholder="City">
                            <span class="placeholder hidden" data-placeholder="Town/City" id="upozorenjeGrad">Enter city name!</span>
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="zip" name="zip" placeholder="Postcode/ZIP">
                            <span class="placeholder hidden" data-placeholder="Town/City" id="upozorenjePostanskiBroj">Enter postcode/ZIP!</span>
                        </div>
                        <div class="col-md-12 form-group mb-0">
                            <textarea class="form-control textareaHeight" name="message" id="message" maxlength="500" placeholder="Order Notes - Optional"></textarea>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4">
                    <div class="order_box">
                        <h2>Your Order</h2>
                        <ul class="list" id="listaProizvodaCheckout">
    
                        </ul>
                        <ul class="list list_2 listaCena" id="cenaCheckout">
                            <li>Subtotal <span>$2160.00</li>
                            <li>Shipping <span>Flat rate: $50.00</span></li>
                            <li>Total <span>$2210.00</span></li>
                        </ul>
                        <div class="payment_item">
                            <div class="radion_btn">
                                <input type="radio" id="f-option5" name="selector" checked>
                                <label for="f-option5">Check payments</label>
                                <div class="check"></div>
                            </div>
                            <p>Please send a check to Flex shop, Zdravka Celara 16, Belgrade, Serbia, 11000 .</p>
                        </div>
                        <div class="payment_item active">
                            <div class="radion_btn">
                                <input type="radio" id="f-option6" name="selector">
                                <label for="f-option6">Paypal </label>
                                <img src="img/card1.jpg" alt="Image for paypal cards">
                                <div class="check"></div>
                            </div>
                            <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal
                                account.</p>
                        </div>
                        <div class="creat_account">
                            <input type="checkbox" id="f-option4" name="selector">
                            <label for="f-option4" id="labelCheckbox">I’ve read and accept the </label>
                            <a href="javascript:void(0)" class="linkPointer" id="linkCheckbox">terms & conditions*</a>
                        </div>
                        <div class="text-center">
                          <button type='button' class="button button-paypal" id="submitBtn">Proceed</button>
                            <div class='col-md-12 form-group d-flex justify-content-center mt-5' id='statusOrder'>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>
  <!--================End Checkout Area =================-->



  <?php
    include "pages/footer.php";
  ?>