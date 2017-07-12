<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

<!-- Basic Page Needs
================================================== -->
<meta charset="utf-8">
<title>Work Scout</title>

<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
================================================== -->
<link rel="stylesheet" href="theme/css/style.css">
<link rel="stylesheet" href="theme/css/colors/green.css" id="colors">
 <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/sweetalert2/5.3.5/sweetalert2.min.css">

<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

</head>

<body>
<div id="wrapper">


<!-- Header
================================================== -->
<header class="transparent sticky-header full-width">
<div class="container">
	<div class="sixteen columns">
	
		<!-- Logo -->
		<div id="logo">
			<h1><a href="index.html"><img src="theme/images/logo2.png" alt="Work Scout" /></a></h1>
		</div>

		<!-- Menu -->
		<nav id="navigation" class="menu">
			<ul id="responsive">

				<li><a href="{{URL::to('/newtheme')}}" id="current">Home</a>
				</li>

				<li><a href="{{route('contact-us')}}">Contact</a>
					
				</li>

				<li><a href="#">For Candidates</a>
					<ul>
						<li><a href="{{route('browse-jobs')}}">Browse Jobs</a></li>
						<li><a href="{{route('browse-categories')}}">Browse Categories</a></li>
						<li><a href="{{route('resume-builder',Session::get('user_id'))}}">Resume Builder <span style="background-color: #26ae61; color:white;padding:2px;border-radius: 3px;">NEW</span></a></li>
						<li><a href="{{route('add-resume')}}">Add Resume</a></li>
						<li><a href="{{route('manage-resume')}}">Manage Resumes</a></li>
						<li><a href="{{route('job-alerts')}}">Job Alerts</a></li>
					</ul>
				</li>

				<li><a href="#">For Employers</a>
					<ul>
						<li><a href="{{route('add-jobs')}}">Add Job</a></li>
						<li><a href="{{route('manage-jobs')}}">Manage Jobs</a></li>
						<li><a href="{{route('manage-applications')}}">Manage Applications</a></li>
						<li><a href="{{route('browse-resumes')}}">Browse Resumes</a></li>
					</ul>
				</li>

				<li><a href="{{route('resources')}}">Resources</a></li>
			</ul>


			<ul class="float-right">

				@if(!Session::has('user_id'))
				<li><a href="{{route('my-account')}}#tab2"><i class="fa fa-user"></i> Sign Up</a></li>
				<li><a href="{{route('my-account')}}"><i class="fa fa-lock"></i> Log In</a></li>
				@else
					<li><a href="#settings"><i class="fa fa-user"></i>{{Session::get('student_name')}}</a></li>
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


<!-- Banner
================================================== -->
<div id="banner" class="with-transparent-header parallax background" style="background-image: url(images/banner-home-02.jpg)" data-img-width="2000" data-img-height="1330" data-diff="300">
	<div class="container">
		<div class="sixteen columns">
			
			<div class="search-container">

				<!-- Form -->

				<form id="search-form" action="{{route('apicheck')}}" method="POST">
					{{csrf_field()}}
					<h2>Find job an entry-level job today</h2>
					<input type="text" class="ico-01" placeholder="job title, keywords or company name" value="" name="searchkeywords"  id="searchkeywords" />
					<input type="text" class="ico-02" placeholder="city, province or region" value="" name="searchlocation" id="searchlocation" />
					<button type="button" onClick="submitSearch();"><i class="fa fa-search"></i></button>
				</form>
				<!-- Browse Jobs -->
				<div class="browse-jobs">
					Browse job offers by <a href="browse-categories.html"> category</a> or <a href="#">location</a>
				</div>
				
				<!-- Announce -->
				<div class="announce">
					We’ve over <strong>{{$postingsCount}}</strong> job offers for you!
				</div>

			</div>

		</div>
	</div>
</div>


<!-- Content
================================================== -->

<!-- Categories -->
<div class="container">
	<div class="sixteen columns">
		<h3 class="margin-bottom-25">Popular Categories</h3>
		<ul id="popular-categories">
			<li><a href="#"><i class="ln  ln-icon-Bar-Chart"></i> Accounting / Finance</a></li>
			<li><a href="#"><i class="ln ln-icon-Car"></i> Automotive Jobs</a></li>
			<li><a href="#"><i class="ln ln-icon-Worker"></i> Construction / Facilities</a></li>
			<li><a href="#"><i class="ln ln-icon-Student-Female"></i> Education Training</a></li>
			<li><a href="#"><i class="ln  ln-icon-Medical-Sign"></i> Healthcare</a></li>
			<li><a href="#"><i class="ln  ln-icon-Plates"></i> Restaurant / Food Service</a></li>
			<li><a href="#"><i class="ln  ln-icon-Globe"></i> Transportation / Logistics</a></li>
			<li><a href="#"><i class="ln  ln-icon-Laptop-3"></i> Telecommunications</a></li>
		</ul>

		<div class="clearfix"></div>
		<div class="margin-top-30"></div>

		<a href="browse-categories.html" class="button centered">Browse All Categories</a>
		<div class="margin-bottom-50"></div>
	</div>
</div>


<div class="container">
	
	<!-- Recent Jobs -->
	<div class="eleven columns">
	<div class="padding-right">
		<h3 class="margin-bottom-25">Recent Jobs</h3>
		<ul class="job-list">
		@foreach($recentJobs as $job)
			<li class="highlighted"><a href="{{route('get-posting',$job->id)}}">
				<img src="theme/images/job-list-logo-01.png" alt="">
				<div class="job-list-content">
					<h4>{{$job->title}} <span class="full-time">{{$job->status}}</span></h4>
					<div class="job-icons">
						<span><i class="fa fa-briefcase"></i> {{$job->company_name}}</span>
						<span><i class="fa fa-map-marker"></i> {{$job->location}}</span>
						<span><i class="fa fa-money"></i>{{$job->salary}}</span>
					</div>
				</div>
				</a>
				<div class="clearfix"></div>
			</li>
		@endforeach
		</ul>

		<a href="{{route('browse-jobs')}}" class="button centered"><i class="fa fa-plus-circle"></i> Show More Jobs</a>
		<div class="margin-bottom-55"></div>
	</div>
	</div>

	<!-- Job Spotlight -->
	<div class="five columns">
		<h3 class="margin-bottom-5">Job Spotlight</h3>

		<!-- Navigation -->
		<div class="showbiz-navigation">
			<div id="showbiz_left_1" class="sb-navigation-left"><i class="fa fa-angle-left"></i></div>
			<div id="showbiz_right_1" class="sb-navigation-right"><i class="fa fa-angle-right"></i></div>
		</div>
		<div class="clearfix"></div>
		
		<!-- Showbiz Container -->
		<div id="job-spotlight" class="showbiz-container">
			<div class="showbiz" data-left="#showbiz_left_1" data-right="#showbiz_right_1" data-play="#showbiz_play_1" >
				<div class="overflowholder">

					<ul>

						<li>
							<div class="job-spotlight">
								<a href="#"><h4>Social Media: Advertising Coordinator <span class="part-time">Part-Time</span></h4></a>
								<span><i class="fa fa-briefcase"></i> Mates</span>
								<span><i class="fa fa-map-marker"></i> New York</span>
								<span><i class="fa fa-money"></i> $20 / hour</span>
								<p>As advertising & content coordinator, you will support our social media team in producing high quality social content for a range of media channels.</p>
								<a href="{{route('get-posting',7)}}" class="button">Apply For This Job</a>
							</div>
						</li>

						<li>
							<div class="job-spotlight">
								<a href="#"><h4>Prestashop / WooCommerce Product Listing <span class="freelance">Freelance</span></h4></a>
								<span><i class="fa fa-briefcase"></i> King</span>
								<span><i class="fa fa-map-marker"></i> London</span>
								<span><i class="fa fa-money"></i> $25 / hour</span>
								<p>Etiam suscipit tellus ante, sit amet hendrerit magna varius in. Pellentesque lorem quis enim venenatis pellentesque.</p>
								<a href="{{route('get-posting',7)}}" class="button">Apply For This Job</a>
							</div>
						</li>

						<li>
							<div class="job-spotlight">
								<a href="#"><h4>Logo Design <span class="freelance">Freelance</span></h4></a>
								<span><i class="fa fa-briefcase"></i> Hexagon</span>
								<span><i class="fa fa-map-marker"></i> Sydney</span>
								<span><i class="fa fa-money"></i> $10 / hour</span>
								<p>Proin ligula neque, pretium et ipsum eget, mattis commodo dolor. Etiam tincidunt libero quis commodo.</p>
								<a href="{{route('get-posting',7)}}" class="button">Apply For This Job</a>
							</div>
						</li>


					</ul>
					<div class="clearfix"></div>

				</div>
				<div class="clearfix"></div>
			</div>
		</div>

	</div>
</div>


<!-- Testimonials -->
<div id="testimonials">
	<!-- Slider -->
	<div class="container">
		<div class="sixteen columns">
			<div class="testimonials-slider">
				  <ul class="slides">
				    <li>
				      <p>I have already heard back about the internship I applied through Job Finder, that's the fastest job reply I've ever gotten and it's so much better than waiting weeks to hear back.
				      <span>Collis Ta’eed, Envato</span></p>
				    </li>

				    <li>
				      <p>Nam eu eleifend nulla. Duis consectetur sit amet risus sit amet venenatis. Pellentesque pulvinar ante a tincidunt placerat. Donec dapibus efficitur arcu, a rhoncus lectus egestas elementum.
				      <span>John Doe</span></p>
				    </li>
				    
				    <li>
				      <p>Maecenas congue sed massa et porttitor. Duis placerat commodo ex, ut faucibus est facilisis ac. Donec eleifend arcu sed sem posuere aliquet. Etiam lorem metus, suscipit vel tortor vitae.
				      <span>Tom Smith</span></p>
				    </li>

				  </ul>
			</div>
		</div>
	</div>
</div>


<!-- Infobox -->
<div class="infobox">
	<div class="container">
		<div class="sixteen columns">Start Building Your Own Job Board Now <a href="my-account.html">Get Started</a></div>
	</div>
</div>


<!-- Recent Posts -->
<div class="container">
	<div class="sixteen columns">
		<h3 class="margin-bottom-25">Resources</h3>
	</div>


	<div class="one-third column">

		<!-- Post #1 -->
		<div class="recent-post">
			<div class="recent-post-img"><a href="blog-single-post.html"><img src="images/recent-post-01.jpg" alt=""></a><div class="hover-icon"></div></div>
			<a href="blog-single-post.html"><h4>Hey Job Seeker, It’s Time To Get Up And Get Hired</h4></a>
			<div class="meta-tags">
				<span>October 10, 2015</span>
				<span><a href="#">0 Comments</a></span>
			</div>
			<p>The world of job seeking can be all consuming. From secretly stalking the open reqs page of your dream company to sending endless applications.</p>
			<a href="blog-single-post.html" class="button">Read More</a>
		</div>

	</div>


	<div class="one-third column">

		<!-- Post #2 -->
		<div class="recent-post">
			<div class="recent-post-img"><a href="blog-single-post.html"><img src="theme/images/recent-post-02.jpg" alt=""></a><div class="hover-icon"></div></div>
			<a href="blog-single-post.html"><h4>How to "Woo" a Recruiter and Land Your Dream Job</h4></a>
			<div class="meta-tags">
				<span>September 12, 2015</span>
				<span><a href="#">0 Comments</a></span>
			</div>
			<p>Struggling to find your significant other the perfect Valentine’s Day gift? If I may make a suggestion: woo a recruiter. </p>
			<a href="blog-single-post.html" class="button">Read More</a>
		</div>

	</div>

	<div class="one-third column">

		<!-- Post #3 -->
		<div class="recent-post">
			<div class="recent-post-img"><a href="blog-single-post.html"><img src="theme/images/recent-post-03.jpg" alt=""></a><div class="hover-icon"></div></div>
			<a href="blog-single-post.html"><h4>11 Tips to Help You Get New Clients Through Cold Calling</h4></a>
			<div class="meta-tags">
				<span>August 27, 2015</span>
				<span><a href="#">0 Comments</a></span>
			</div>
			<p>If your dream employer appears on this list, you’re certainly in good company. But it also means you’re up for some intense competition.</p>
			<a href="blog-single-post.html" class="button">Read More</a>
		</div>
	</div>

</div>


<!-- Footer
================================================== -->
<div class="margin-top-15"></div>

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
<script src="theme/scripts/jquery-2.1.3.min.js"></script>
<script src="theme/scripts/custom.js"></script>
<script src="theme/scripts/jquery.superfish.js"></script>
<script src="theme/scripts/jquery.themepunch.tools.min.js"></script>
<script src="theme/scripts/jquery.themepunch.revolution.min.js"></script>
<script src="theme/scripts/jquery.themepunch.showbizpro.min.js"></script>
<script src="theme/scripts/jquery.flexslider-min.js"></script>
<script src="theme/scripts/chosen.jquery.min.js"></script>
<script src="theme/scripts/jquery.magnific-popup.min.js"></script>
<script src="theme/scripts/waypoints.min.js"></script>
<script src="theme/scripts/jquery.counterup.min.js"></script>
<script src="theme/scripts/jquery.jpanelmenu.js"></script>
<script src="theme/scripts/stacktable.js"></script>
<script src="theme/scripts/headroom.min.js"></script>
<script src="https://cdn.jsdelivr.net/sweetalert2/5.3.5/sweetalert2.min.js"></script>

 <script type="text/javascript">


        function submitSearch(){
            var keywords = $('#searchkeywords').val();
            var location = $('#searchlocation').val();
            if(location.length > 0 || keywords.length > 0){
                $('#search-form').submit();
            }else if(location.length == 0 || keywords.length == 0){
                swal('Please enter a keyword and/or location');                
            }
        }
    </script>


</body>
</html>