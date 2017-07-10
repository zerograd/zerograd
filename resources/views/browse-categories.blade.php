@extends('layout.newthemelayout')

@section('title')
	<title>Browse Categories</title>
@stop	

@section('content')

<!-- Titlebar
================================================== -->
<div id="titlebar" class="photo-bg" style="background-image: url(images/all-categories-photo.jpg);">
	<div class="container">
		<div class="ten columns">
			<h2>All Categories</h2>
		</div>

		<div class="six columns">
			<a href="add-job.html" class="button">Post a Job, It’s Free!</a>
		</div>

	</div>
</div>


<!-- Content
================================================== -->
<div id="categories">
	<!-- Categories Group -->
	<div class="categories-group">
		<div class="container">
			<div class="four columns"><h4>Web, Software & IT</h4></div>
			<div class="four columns">
				<ul>
					<li><a href="#">PHP</a></li>
					<li><a href="#">Android</a></li>
					<li><a href="#">WordPress</a></li>
					<li><a href="#">Design</a></li>
					<li><a href="#">Developer</a></li>
					<li><a href="#">iOS</a></li>
					<li><a href="#">Mobile</a></li>
				</ul>
			</div>
			<div class="four columns">
				<ul>
					<li><a href="#">MySQL</a></li>
					<li><a href="#">JavaScript</a></li>
					<li><a href="#">Software</a></li>
					<li><a href="#">Website Design</a></li>
					<li><a href="#">Programming</a></li>
					<li><a href="#">SEO</a></li>
					<li><a href="#">Java</a></li>
				</ul>
			</div>
			<div class="four columns">
				<ul>
					<li><a href="#">CSS</a></li>
					<li><a href="#">HTML5</a></li>
					<li><a href="#">Web Development</a></li>
					<li><a href="#">Web Design</a></li>
					<li><a href="#">eCommerce</a></li>
				</ul>
			</div>
		</div>
	</div>

	<!-- Categories Group -->
	<div class="categories-group">
		<div class="container">
			<div class="four columns"><h4>Design, Art & Multimedia</h4></div>
			<div class="four columns">
				<ul>
					<li><a href="#">Design</a></li>
					<li><a href="#">Logo Design</a></li>
					<li><a href="#">Graphic Design</a></li>
					<li><a href="#">Video</a></li>
					<li><a href="#">Adnimation</a></li>
					<li><a href="#">Adobe Photoshop</a></li>
					<li><a href="#">Illustration</a></li>
				</ul>
			</div>
			<div class="four columns">
				<ul>
					<li><a href="#">Art</a></li>
					<li><a href="#">3D</a></li>
					<li><a href="#">Adobe Illustrator</a></li>
					<li><a href="#">Drawing</a></li>
					<li><a href="#">Web Design</a></li>
					<li><a href="#">Cartoon</a></li>
					<li><a href="#">Graphics</a></li>
				</ul>
			</div>
			<div class="four columns">
				<ul>
					<li><a href="#">Fashion Design</a></li>
					<li><a href="#">WordPress</a></li>
					<li><a href="#">Editing</a></li>
					<li><a href="#">Writing</a></li>
					<li><a href="#">T-Shirt Design</a></li>
				</ul>
			</div>
		</div>
	</div>

	<!-- Categories Group -->
	<div class="categories-group">
		<div class="container">
			<div class="four columns"><h4>Sales & Marketing</h4></div>
			<div class="four columns">
				<ul>
					<li><a href="#">Display Advertising</a></li>
					<li><a href="#">Email Marketing</a></li>
					<li><a href="#">Lead Generation</a></li>
					<li><a href="#">Market & Customer Research</a></li>
				</ul>
			</div>
			<div class="four columns">
				<ul>
					<li><a href="#">Marketing Strategy</a></li>
					<li><a href="#">Public Relations</a></li>
					<li><a href="#">Telemarketing & Telesales</a></li>
					<li><a href="#">Other - Sales & Marketing</a></li>
				</ul>
			</div>
			<div class="four columns">
				<ul>
					<li><a href="#">SEM - Search Engine Marketing</a></li>
					<li><a href="#">SEO - Search Engine Optimization</a></li>
					<li><a href="#">SMM - Social Media Marketing</a></li>
				</ul>
			</div>
		</div>
	</div>

</div>
@stop