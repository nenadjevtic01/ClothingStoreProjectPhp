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
			<div class='container d-flex justify-content-center mt-5 w-100'>
				<div class='col-12 col-md-9 col-lg-6 mt-5 d-flex flex-column align-items-center'>
						<h3 class='center mb-5'>Update product</h3>
						<form class='row login_form w-100' action='#/' method='POST' id='register_form' enctype='multipart/form-data'>
                                <div class='col-md-12 form-group'>
                                   <select id='product'>
                                        <option value='0'>Select product</option>";
                                        echo fetchProductCombo();   
                                   echo "</select>
                                        <span class='placeholder hidden ml-2' data-placeholder='category' id='upozorenjeCategory'>Select category!</span>
								</div>
								<div class='col-md-12 form-group'>
									<input type='text' class='form-control' id='productName' placeholder='Product name'/>
									<span class='placeholder hidden ml-2' data-placeholder='productName' id='upozorenjeProductName'>Enter product name!</span>
								</div>
								<div class='col-md-12 form-group'>
                                   <select id='category'>
                                        <option value='0'>Select category</option>";
                                        echo fetchCategoryCombo();   
                                   echo "</select>
                                        <span class='placeholder hidden ml-2' data-placeholder='category' id='upozorenjeCategory'>Select category!</span>
								</div>
								<div class='col-md-12 form-group'>
									<select id='brand'>
                                        <option value='0'>Select brand</option>";
                                        echo fetchBrandCombo();
                                    echo "</select>
                                    <span class='placeholder hidden ml-2' data-placeholder='brand' id='upozorenjeBrand'>Select brand!</span>
								</div>
								<div class='col-md-12 form-group'>
                                    <select id='gender'>
                                        <option value='0'>Select gender</option>
                                        <option value='1'>1 - Male</option>
                                        <option value='2'>2 - Female</option>
                                    </select>
                                    <span class='placeholder hidden ml-2' data-placeholder='gender' id='upozorenjeGender'>Select gender!</span>
								</div>
								<div class='col-md-12 form-group'>
									<select id='sale'>
                                        <option value='0'>Not on sale</option>
										<option value='1'>On sale</option>
									</select>
								</div>
                                <div class='col-md-12 form-group'>
									<input type='text' class='form-control' id='newPrice' placeholder='Enter price'/>
									<span class='placeholder hidden ml-2' data-placeholder='newPrice' id='upozorenjePrice'>Enter price!</span>
								</div>
                                <div class='col-md-12 form-group d-flex flex-column'>
                                    <label for='inStock'>In stock:</label>
									<select id='inStock' class='w-50'>
                                        <option value='0'>Unavailable</option>
										<option value='1'>In stock</option>
									</select>
								</div>
                                <div class='col-md-12 form-group'>
                                    <label for='sizes'>Sizes:</label>
									        <ul id='sizes' class='ml-2'>
                                                <li><input class='pixel-radio pixel-checkbox size' type='checkbox' value='XS' id='chbXs'/><label for='chbXs'>XS</label></li>
                                                <li><input class='pixel-radio pixel-checkbox size' type='checkbox' value='S' id='chS'/><label for='chbXs'>S</label></li>
                                                <li><input class='pixel-radio pixel-checkbox size' type='checkbox' value='M' id='chM'/><label for='chbM'>M</label></li>
                                                <li><input class='pixel-radio pixel-checkbox size' type='checkbox' value='L' id='chL'/><label for='chbL'>L</label></li>
                                                <li><input class='pixel-radio pixel-checkbox size' type='checkbox' value='XL' id='chXl'/><label for='chbXl'>XL</label></li>
									        </ul>
                                        <span class='placeholder hidden ml-2' data-placeholder='sizes' id='upozorenjeSize'>Select size!</span>
								</div>
                                <div class='col-md-12 form-group'>
									<input type='text' class='form-control' id='material' placeholder='Enter material'/>
									<span class='placeholder hidden ml-2' data-placeholder='material' id='upozorenjeMaterijal'>Enter material!</span>
								</div>
                                <div class='col-md-12 form-group'>
									<input type='text' class='form-control' id='coo' placeholder='Enter country of origin'/>
									<span class='placeholder hidden ml-2' data-placeholder='coo' id='upozorenjeCoo'>Enter country of origin!</span>
								</div>
								<div class='col-md-12 form-group'>
									<p>Upload image</p>
									<input type='file' name='slika' accept='.jpg,.jpeg,.png' class='form-control' id='productImage'/>
									<span class='placeholder hidden ml-2' data-placeholder='productImage' id='upozorenjeImage'>Select image!</span>
								</div>
								<div class='col-md-12 form-group'>
									<button type='button' value='Register' id='btnUpdateProduct' class='button button-register w-100'>Update product</button>
								</div>
								<div class='col-md-12 form-group d-flex justify-content-center' id='statusProduct'>
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