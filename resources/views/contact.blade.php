@extends('layout.newthemelayout')

@section('title')
	<title>Contact Us</title>
@stop



@section('content')
<!-- Titlebar
================================================== -->
<div id="titlebar" class="single">
	<div class="container">

		<div class="sixteen columns">
			<h2>Contact</h2>
			<nav id="breadcrumbs">
				<ul>
					<li>You are here:</li>
					<li><a href="#">Home</a></li>
					<li>Contact</li>
				</ul>
			</nav>
		</div>

	</div>
</div>




<!-- Content
================================================== -->
<!-- Container -->
<div class="container">
	<div class="sixteen columns">

		<h3 class="margin-bottom-20">Our Office</h3>

		<!-- Google Maps -->
		<section class="google-map-container">
			<div id="googlemaps" class="google-map google-map-full"></div>
		</section>
		<!-- Google Maps / End -->

	</div>
</div>
<!-- Container / End -->
			

<!-- Container -->
<div class="container">

<div class="eleven columns">

	<h3 class="margin-bottom-15">Contact Form</h3>
	
		<!-- Contact Form -->
		<section id="contact" class="padding-right">

			<!-- Success Message -->
			<mark id="message"></mark>

			<!-- Form -->
			<form method="post" name="contactform" id="contactform">

				<fieldset>

					<div>
						<label>Name:</label>
						<input name="name" type="text" id="name" />
					</div>

					<div>
						<label >Email: <span>*</span></label>
						<input name="email" type="email" id="email" pattern="^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$" />
					</div>

					<div>
						<label>Message: <span>*</span></label>
						<textarea name="comment" cols="40" rows="3" id="comment" spellcheck="true"></textarea>
					</div>

				</fieldset>
				<div id="result"></div>
				<input type="submit" class="submit" id="submit" value="Send Message" />
				<div class="clearfix"></div>
				<div class="margin-bottom-40"></div>
			</form>

		</section>
		<!-- Contact Form / End -->

</div>
<!-- Container / End -->


<!-- Sidebar
================================================== -->
<div class="five columns">

	<!-- Information -->
	<h3 class="margin-bottom-10">Information</h3>
	<div class="widget-box">
		<p>Morbi eros bibendum lorem ipsum dolor pellentesque pellentesque bibendum. </p>

		<ul class="contact-informations">
			<li>45 Park Avenue, Apt. 303</li>
			<li>New York, NY 10016 </li>
		</ul>

		<ul class="contact-informations second">
			<li><i class="fa fa-phone"></i> <p>+48 880 440 110</p></li>
			<li><i class="fa fa-envelope"></i> <p>info@zerograd.com</p></li>
			<li><i class="fa fa-globe"></i> <p>zerograd.com</p></li>
		</ul>

	</div>
	
	<!-- Social -->
	<div class="widget margin-top-30">
		<h3 class="margin-bottom-5">Social Media</h3>
		<ul class="social-icons">
			<li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
			<li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>
			<li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
			<li><a class="linkedin" href="#"><i class="icon-linkedin"></i></a></li>
		</ul>
		<div class="clearfix"></div>
		<div class="margin-bottom-50"></div>
	</div>

</div>
</div>
<!-- Container / End -->
@stop




<!-- Google Maps -->

@section('script_plugins')


<script type="text/javascript">
	(function($){
		$(document).ready(function(){

			$('#googlemaps').gMap({
				maptype: 'ROADMAP',
				scrollwheel: false,
				zoom: 13,
				markers: [
					{
						address: 'New York, 45 Park Avenue', // Your Adress Here
						html: '<strong>Our Office</strong><br>45 Park Avenue, Apt. 303 </br>New York, NY 10016 ',
						popup: true,
					}
				],
			});

		   });

	})(this.jQuery);
</script>
@stop


