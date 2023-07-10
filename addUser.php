<?php
    include "config/connection.php";
	include "models/functions.php";
	include "pages/head.php";
	include "pages/header.php";
?>

<?php
if($_SESSION){
    if($_SESSION["role"]==1){
		echo "<section class='section-margin--small mb-5'>
		<div class='container d-flex justify-content-center mt-5'>
			<div class='col-12 col-md-9 col-lg-6 mt-5 d-flex flex-column align-items-center'>
				<h3 class='center mb-5'>Add user</h3>
				<form class='row login_form' action='#/' id='register_form' >
									<div class='col-md-12 col-lg-6 form-group'>
										<input type='text' class='form-control' id='firstName' placeholder='First name'/>
										<span class='placeholder hidden' data-placeholder='firstName' id='upozorenjeFirst'>Enter first name!</span>
									</div>
									<div class='col-md-12 col-lg-6 form-group'>
										<input type='text' class='form-control' id='lastName' placeholder='Last name'/>
										<span class='placeholder hidden' data-placeholder='lastName' id='upozorenjeLast'>Enter last name!</span>
									</div>
									<div class='col-md-12 form-group'>
										<input type='text' class='form-control' id='username' placeholder='Username'/>
										<span class='placeholder hidden' data-placeholder='Username' id='upozorenjeUsername'>Enter username!</span>
									</div>
									<div class='col-md-12 form-group'>
										<input type='text' class='form-control' id='email' placeholder='Email Address'/>
										<span class='placeholder hidden' data-placeholder='Email' id='upozorenjeEmail'>Enter username!</span>
									</div>
									<div class='col-md-12 form-group'>
										<input type='text' class='form-control' id='address' placeholder='Address'/>
										<span class='placeholder hidden' data-placeholder='Address' id='upozorenjeAdresa'>Enter address!</span>
									</div>
									<div class='col-md-12 form-group'>
										<input type='text' class='form-control' id='city' placeholder='City'/>
										<span class='placeholder hidden' data-placeholder='Address' id='upozorenjeGrad'>Enter city!</span>
									</div>
									<div class='col-md-12 form-group'>
										<input type='text' class='form-control' id='zip' placeholder='Postal code'/>
										<span class='placeholder hidden' data-placeholder='Address' id='upozorenjePostanskiBroj'>Enter postal code!</span>
									</div>
									<div class='col-md-12 form-group'>
										<select id='role'>
											<option value='1'>Administrator</option>
											<option value='2'>User</option>
										</select>
									</div>
									  <div class='col-md-12 form-group'>
										<input type='password' class='form-control' id='password' placeholder='Password'/>
										<span class='placeholder hidden' data-placeholder='Password' id='upozorenjePassword'>Enter password!</span>
									</div>
									  <div class='col-md-12 form-group'>
										<input type='password' class='form-control' id='confirmPassword' placeholder='Confirm Password'/>
										<span class='placeholder hidden' data-placeholder='Password2' id='upozorenjePassword2'>Re-enter password!</span>
									</div>
									<div class='col-md-12 form-group'>
										<button type='button' value='Register' id='btnAddUser' class='button button-register w-100'>Add user</button>
									</div>
									<div class='col-md-12 form-group d-flex justify-content-center' id='status'>
									</div>
					</form>
			</div>
		</div>
	</section>";
	}else{
		echo "<section class='section-margin--small mb-5'><div class='container mt-5'>
		<div class='d-flex justify-content-center mt-5'>
		<h1 class='mt-5'>Restricted area</h1>
		</div>
		</div></section>";
	  }
}else{
	echo "<section class='section-margin--small mb-5'><div class='container mt-5'>
	<div class='d-flex justify-content-center mt-5'>
	<h1 class='mt-5'>Restricted area</h1>
	</div>
	</div></section>";
  }
?>


<?php
    include "pages/footer.php";
?>
