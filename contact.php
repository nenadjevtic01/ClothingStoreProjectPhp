<?php
  include "config/connection.php";
  include "models/functions.php";
	include "pages/head.php";
	include "pages/header.php";
?>
	<!--================ End Header Menu Area =================-->


	<!-- ================ start banner area ================= -->
	<section class="blog-banner-area pozadinaContact" id="contact">
		<div class="container h-100 shadowLogin">
			<div class="blog-banner">
				<div class="text-center">
					<h1>Contact Us</h1>
					<nav aria-label="breadcrumb" class="banner-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
            </ol>
          </nav>
				</div>
			</div>
    </div>
	</section>
	<!-- ================ end banner area ================= -->

	<!-- ================ contact section start ================= -->
  <section class="section-margin--small">
    <div class="container">
      <div class="d-none d-sm-block mb-5 pb-4">
        <div id="map">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2830.358671719542!2d20.482220751324594!3d44.8142571844923!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475a7a9609031735%3A0xc17ed71f59ac4725!2z0JLQuNGB0L7QutCwINCY0KbQoiDRiNC60L7Qu9Cw!5e0!3m2!1ssr!2srs!4v1645812264616!5m2!1ssr!2srs" width="100%" height="420" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        
        
      </div>


      <div class="row">
        <div class="col-md-4 col-lg-3 mb-4 mb-md-0">
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-home"></i></span>
            <div class="media-body">
              <h3>Belgrade, Serbia</h3>
              <p>Zdravka Celara 14</p>
            </div>
          </div>
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-headphone"></i></span>
            <div class="media-body">
              <h3>+381 64 047-27-01</h3>
              <p>Mon to Fri-09h to 18h</p>
            </div>
          </div>
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-email"></i></span>
            <div class="media-body">
              <h3><a href="mailto:nenad.jevtic.60.20@ict.edu.rs">nenad.jevtic.60.20@ict.edu.rs</a></h3>
              <p>Send us your message anytime!</p>
            </div>
          </div>
        </div>
        <div class="col-md-8 col-lg-9">
          <form action="#/" class="form-contact contact_form" action="contact_process.php" method="post" id="contactForm" novalidate="novalidate">
            <div class="row">
              <div class="col-lg-5">
                <div class="form-group">
                  <input class="form-control" name="name" id="name" type="text" placeholder="Full name">
				  <span class="greska hidden" id="upozorenjeIme">Enter your first name and last name!</span>
                </div>
                <div class="form-group">
                  <input class="form-control" name="email" id="email" type="email" placeholder="Enter email address">
				  <span class="greska hidden" id="upozorenjeEmail">Enter email!</span>
                </div>
                <div class="form-group">
                  <input class="form-control" name="subject" id="subject" type="text" placeholder="Enter Subject">
				  <span class="greska hidden" id="upozorenjeTema">Enter subject!</span>
                </div>
              </div>
              <div class="col-lg-7">
                <div class="form-group">
                    <textarea class="form-control different-control w-100 textareaHeight" name="message" id="message" cols="30" maxlength="300" placeholder="Enter Message"></textarea>
					<span class="greska hidden" id="upozorenjeText">Enter Message!</span>
                </div>
              </div>
            </div>
            <div class="form-group text-center text-md-right mt-3">
              <button type="button" class="button button--active button-contactForm" id="form-submit">Send Message</button>
            </div>
            <div class="form-group text-center text-md-right mt-3" id='statusContact'>
              
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
	<!-- ================ contact section end ================= -->
  
  

  <?php
	include "pages/footer.php";
  ?>