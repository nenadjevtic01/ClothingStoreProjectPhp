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
						<h3 class='center mb-5'>Add survey</h3>
						<form class='row login_form' action='#/' id='register_form' >
								<div class='col-md-12 form-group'>
									<input type='text' class='form-control' id='surveyName' placeholder='Survey question'/>
									<span class='placeholder hidden' data-placeholder='surveyName' id='upozorenjeSurveyName'>Enter survey question!</span>
								</div>
								<div class='col-md-12 form-group'>
									<select id='statusSurvey'>
										<option value='0'>Disabled</option>
										<option value='1'>Enabled</option>
									</select>
								</div>
								<div class='col-md-12 form-group'>
									<button type='button' value='addSurvey' id='btnAddSurvey' class='button button-register w-100'>Add survey</button>
								</div>
								<div class='col-md-12 form-group d-flex justify-content-center' id='statusSurveyText'>
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