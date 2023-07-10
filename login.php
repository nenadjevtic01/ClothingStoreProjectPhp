<?php
	include "config/connection.php";
	include "models/functions.php";
	include "pages/head.php";
	include "pages/header.php";
?>
  
  <!-- ================ start banner area ================= -->	
	<section class="blog-banner-area pozadinaLogin textLogin" id="category">
			<div class="container h-100 shadowLogin">
				<div class="blog-banner">
					<div class="text-center">
						<h1>Login</h1>
						<nav aria-label="breadcrumb" class="banner-breadcrumb">
        	    			<ol class="breadcrumb">
        	      				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
        	      				<li class="breadcrumb-item active" aria-current="page">Login</li>
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
							<h4>New to our website?</h4>
							<a class="button button-account" href="register.php">Create an Account</a>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner">
						<h3>Log in to enter</h3>
						<form class="row login_form" action="#/" id="contactForm" >
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="username" name="username" placeholder="Username">
								<span class="placeholder hidden" data-placeholder="Username" id="upozorenjeUsername">Enter username!</span>
							</div>
							<div class="col-md-12 form-group">
								<input type="password" class="form-control" id="password" name="password" placeholder="Password">
								<span class="placeholder hidden" data-placeholder="Password" id="upozorenjePassword">Enter password!</span>
							</div>
							<!-- <div class="col-md-12 form-group">
								<div class="creat_account">
									<input type="checkbox" id="f-option2" name="selector">
									<label for="f-option2">Keep me logged in</label>
								</div>
							</div> -->
							<div class="col-md-12 form-group">
								<button type="button" class="button button-login w-100" id="btnLogIn" value="Log in">Log In</button>
								<!-- <button type="button" value="Register" id="btnRegister" class="button button-register w-100">Register</button> -->
							</div>
							<div class="col-md-12 form-group mb-5" id="status">
								
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