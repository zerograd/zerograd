<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en" ng-app="app"> <!--<![endif]-->
<head>

<!-- Basic Page Needs
================================================== -->
<meta charset="utf-8">
@yield('title')

<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
================================================== -->
<link rel="stylesheet" href="{{URL::asset('/theme/css/style.css')}}">
<link rel="stylesheet" href="{{URL::asset('/theme/css/colors/green.css')}}" id="colors">
 <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/sweetalert2/5.3.5/sweetalert2.min.css">
<link href="https://cdn.quilljs.com/1.2.6/quill.snow.css" rel="stylesheet">
<link rel="stylesheet" href="{{URL::asset('css/bootstrap.min.css')}}">
 <link rel="stylesheet" href="{{URL::asset('/Remodal-1.1.1/dist/remodal.css')}}">
<link rel="stylesheet" href="{{URL::asset('/Remodal-1.1.1/dist/remodal-default-theme.css')}}">
<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
      <script src="{{URL::asset('theme/scripts/jquery-2.1.3.min.js')}}"></script>
      
      <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.0/angular.min.js"></script>
      <script src=""></script>
      <link href="{{URL::asset('angular-xeditable-0.8.0/css/xeditable.css')}}" rel="stylesheet">
	  <script src="{{URL::asset('angular-xeditable-0.8.0/js/xeditable.js')}}"></script>
	  <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->




@yield('styles')

<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

 @yield('style_plugins')



</head>
    
<body>
<div id="wrapper">


<!-- Header
================================================== -->
<header class="sticky-header">
<div class="container">
	<div class="sixteen columns">

		<!-- Logo -->
		<div id="logo">
			<h1><a href="{{URL::to('/newtheme')}}"><img src="{{URL::asset('/theme/images/logo.png')}}" alt="Work Scout" /></a></h1>
		</div>

		<!-- Menu -->
		<nav id="navigation" class="menu">
			<ul id="responsive">

				<li><a href="{{URL::to('/')}}" @if(Request::is('/')) id="current" @endif>Home</a>
					
				</li>

				<li><a href="{{route('contact-us')}}" @if(Request::is('contact')) id="current" @endif>Contact</a>
					
				</li>
			@if(!Session::has('user_id') && !Session::has('employer_id'))
				<li><a href="#">For Candidates</a>
					<ul>
						<li><a href="{{route('browse-jobs')}}">Browse Jobs</a></li>
						
						@if(Session::has('user_id'))
							<li><a href="#">Resume Builder <span style="background-color: #26ae61; color:white;padding:2px;border-radius: 3px;">TBA</span></a></li>
						@endif
						<li><a href="{{route('add-resume')}}">Add Resume</a></li>
						<li><a href="{{route('manage-resume')}}">Manage Resumes</a></li>
						<li><a href="{{route('job-alerts')}}">Job Alerts</a></li>
					</ul>
				</li>
				<li><a href="#">For Employers</a>
					<ul>
						<li><a href="{{URL::to('employer/myaccount')}}">Login/Register</a></li>
						<li><a href="{{route('add-jobs')}}">Add Job</a></li>
						<li><a href="{{route('manage-jobs')}}">Manage Jobs</a></li>
						<li><a href="{{route('manage-applications')}}">Manage Applications</a></li>
						<li><a href="{{route('browse-resumes')}}">Browse Resumes</a></li>
					</ul>
				</li>

				<li><a href="{{route('resources')}}">Resources</a></li>
			@elseif(Session::has('user_id') && !Session::has('employer_id'))
				<li><a href="#">For Candidates</a>
					<ul>
						<li><a href="{{route('browse-jobs')}}">Browse Jobs</a></li>
						
						@if(Session::has('user_id'))
							<li><a href="#">Resume Builder <span style="background-color: #26ae61; color:white;padding:2px;border-radius: 3px;">TBA</span></a></li>
						@endif
						<li><a href="{{route('add-resume')}}">Add Resume</a></li>
						<li><a href="{{route('manage-resume')}}">Manage Resumes</a></li>
						<li><a href="{{route('job-alerts')}}">Job Alerts</a></li>
					</ul>
				</li>
			@else
				<li><a href="#">For Employers</a>
					<ul>
						<li><a href="{{URL::to('employer/myaccount')}}">Login/Register</a></li>
						<li><a href="{{route('add-jobs')}}">Add Job</a></li>
						<li><a href="{{route('manage-jobs')}}">Manage Jobs</a></li>
						<li><a href="{{route('manage-applications')}}">Manage Applications</a></li>
						<li><a href="{{route('browse-resumes')}}">Browse Resumes</a></li>
					</ul>
				</li>

			@endif
				<li><a href="{{route('resources')}}">Resources</a></li>
			</ul>


			<ul class="responsive float-right">
				@if(!Session::has('user_id') && !Session::has('employer_id'))
				<li><a href="{{route('my-account')}}#tab2"><i class="fa fa-user"></i> Sign Up</a></li>
				<li><a href="{{route('my-account')}}"><i class="fa fa-lock"></i> Log In</a></li>

				@elseif(Session::has('employer_id'))
					<li><a href="#"><i class="fa fa-user"></i>{{Session::get('company_name')}}</a>
							<ul>
								<li><a href="#">Settings</a></li>
								<li><a href="{{route('company-get',Session::get('employer_id'))}}"> Company Profile</a></li>
								<li><a href="{{URL::to('/employer/logout')}}">Logout</a></li>
							</ul>
					</li>
				@else
					<li><a href="#"><i class="fa fa-user"></i>{{Session::get('student_name')}}</a>
							<ul>
								<li><a href="{{route('student-settings')}}">Settings</a></li>
								<li><a href="{{route('public-profile-edit',Session::get('user_id'))}}">Profile</a></li>
								<li><a href="{{URL::to('/logout')}}">Logout</a></li>
							</ul>
					</li>
				@endif
			</ul>

		</nav>

		<!-- Navigation -->
		<div id="mobile-navigation">
			<a href="#menu" class="menu-trigger"><i class="fa fa-reorder"></i> Menu</a>
		</div>

	</div>
</div>
</header>
<div class="clearfix"></div>

<div>
@yield('content')
</div>

<!-- Footer
================================================== -->
<div class="margin-top-45"></div>

<div id="footer">
	<!-- Main -->
	<div class="container">

		<div class="seven columns">
			<h4>About</h4>
			<p>ZeroGrad is a site where we believe that employers need a better way to share entry-level jobs with fresh and eager graduates. We don't believe experience is the issue when applying to jobs but rather a miscommunication between the hiring companies and job seekers; Zerograd attempts to build a strong communication between the two.</p>
			<a href="#" class="button">Get Started</a>
		</div>

		<div class="three columns">
			<h4>Company</h4>
			<ul class="footer-links">
				<li><a href="#">About Us</a></li>
				<li><a href="#">Careers</a></li>
				<li><a href="#">Our Blog</a></li>
				<li><a href="#">Terms of Service</a></li>
				<li><a href="#">Privacy Policy</a></li>
				<li><a href="#">Hiring Hub</a></li>
			</ul>
		</div>
		
		<div class="three columns">
			<h4>Press</h4>
			<ul class="footer-links">
				<li><a href="#">In the News</a></li>
				<li><a href="#">Press Releases</a></li>
				<li><a href="#">Awards</a></li>
				<li><a href="#">Testimonials</a></li>
				<li><a href="#">Timeline</a></li>
			</ul>
		</div>		

		<div class="three columns">
			<h4>Browse</h4>
			<ul class="footer-links">
				<li><a href="#">Freelancers by Category</a></li>
				<li><a href="#">Freelancers in USA</a></li>
				<li><a href="#">Freelancers in UK</a></li>
				<li><a href="#">Freelancers in Canada</a></li>
				<li><a href="#">Freelancers in Australia</a></li>
				<li><a href="#">Find Jobs</a></li>

			</ul>
		</div>

	</div>

	<!-- Bottom -->
	<div class="container">
		<div class="footer-bottom">
			<div class="sixteen columns">
				<h4>Follow Us</h4>
				<ul class="social-icons">
					<li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
					<li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>
					<li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
					<li><a class="linkedin" href="#"><i class="icon-linkedin"></i></a></li>
				</ul>
				<div class="copyrights">©  Copyright 2015 by <a href="#">Work Scout</a>. All Rights Reserved.</div>
			</div>
		</div>
	</div>

</div>



<!-- Back To Top Button -->
<div id="backtotop"><a href="#"></a></div>

</div>
<!-- Wrapper / End -->

<!-- Scripts
================================================== -->

<script src="{{URL::asset('theme/scripts/custom.js')}}"></script>
<script src="{{URL::asset('theme/scripts/jquery.superfish.js')}}"></script>
<script src="{{URL::asset('theme/scripts/jquery.themepunch.tools.min.js')}}"></script>
<script src="{{URL::asset('theme/scripts/jquery.themepunch.revolution.min.js')}}"></script>
<script src="{{URL::asset('theme/scripts/jquery.themepunch.showbizpro.min.js')}}"></script>
<script src="{{URL::asset('theme/scripts/jquery.flexslider-min.js')}}"></script>
<script src="{{URL::asset('theme/scripts/chosen.jquery.min.js')}}"></script>
<script src="{{URL::asset('theme/scripts/jquery.magnific-popup.min.js')}}"></script>
<script src="{{URL::asset('theme/scripts/waypoints.min.js')}}"></script>
<script src="{{URL::asset('theme/scripts/jquery.counterup.min.js')}}"></script>
<script src="{{URL::asset('theme/scripts/jquery.jpanelmenu.js')}}"></script>
<script src="{{URL::asset('theme/scripts/stacktable.js')}}"></script>
<script src="{{URL::asset('theme/scripts/headroom.min.js')}}"></script>
<script src="{{URL::asset('theme/scripts/jquery.gmaps.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/sweetalert2/5.3.5/sweetalert2.min.js"></script>
<script src="https://cdn.quilljs.com/1.2.6/quill.js"></script>
<script src="{{URL::asset('/js/bootstrap.min.js')}}"></script>
 <script src="{{URL::asset('/Remodal-1.1.1/dist/remodal.min.js')}}"></script>


 <!-- AngularJS -->
<script src="{{URL::asset('/js/main.js')}}"></script>


 <!-- END of angular scripts -->
 @yield('script_plugins')

<!-- Style Switcher
================================================== -->

</div>


</body>
</html>