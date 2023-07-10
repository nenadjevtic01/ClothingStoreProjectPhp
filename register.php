<?php
	include "config/connection.php";
	include "models/functions.php";
	include "pages/head.php";
	include "pages/header.php";
?>
  
  <!-- ================ start banner area ================= -->	
	<section class="blog-banner-area pozadinaRegister " id="category">
		<div class="container h-100 shadowLogin">
			<div class="blog-banner">
				<div class="text-center">
					<h1>Register</h1>
					<nav aria-label="breadcrumb" class="banner-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Register</li>
            </ol>
          </nav>
				</div>
			</div>
    </div>
	</section>
	<!-- ================ end banner area ================= -->
  
  <!--================Login Box Area =================-->
	<section class="login_box_area section-margin">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="login_box_img">
						<div class="hover">
							<h4>Already have an account?</h4>
							<a class="button button-account" href="login.php">Login Now</a>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner register_form_inner">
						<h3>Create an account</h3>
						<form class="row login_form" action="#/" id="register_form" >
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="firstName" placeholder="First name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'First name'">
								<span class="placeholder hidden" data-placeholder="firstName" id="upozorenjeFirst">Enter first name!</span>
							</div>
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="lastName" placeholder="Last name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Last name'">
								<span class="placeholder hidden" data-placeholder="lastName" id="upozorenjeLast">Enter last name!</span>
							</div>
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="username" placeholder="Username" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'">
								<span class="placeholder hidden" data-placeholder="Username" id="upozorenjeUsername">Enter username!</span>
							</div>
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="email" placeholder="Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Address'">
								<span class="placeholder hidden" data-placeholder="Email" id="upozorenjeEmail">Enter username!</span>
							</div>
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="address" placeholder="Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Address'">
								<span class="placeholder hidden" data-placeholder="Address" id="upozorenjeAdresa">Enter address!</span>
							</div>
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="city" placeholder="City" onfocus="this.placeholder = ''" onblur="this.placeholder = 'City'">
								<span class="placeholder hidden" data-placeholder="Address" id="upozorenjeGrad">Enter city!</span>
							</div>
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="zip" placeholder="Postal code" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Postal code'">
								<span class="placeholder hidden" data-placeholder="Address" id="upozorenjePostanskiBroj">Enter postal code!</span>
							</div>
              				<div class="col-md-12 form-group">
								<input type="password" class="form-control" id="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
								<span class="placeholder hidden" data-placeholder="Password" id="upozorenjePassword">Enter password!</span>
							</div>
              				<div class="col-md-12 form-group">
								<input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Confirm Password'">
								<span class="placeholder hidden" data-placeholder="Password2" id="upozorenjePassword2">Re-enter password!</span>
							</div>
							<div class="col-md-12 form-group">
								<button type="button" value="Register" id="btnRegister" class="button button-register w-100">Register</button>
							</div>
							<div class="col-md-12 form-group" id="status">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Login Box Area =================-->


<?php
	include "pages/footer.php";
?>