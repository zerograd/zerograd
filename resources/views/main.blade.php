<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

<!-- Basic Page Needs
================================================== -->
<meta charset="utf-8">
<title>ZeroGrad</title>

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
			<h1><a href="{{URL::to('/newtheme')}}"><img src="theme/images/logo2.png" alt="Work Scout" /></a></h1>
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
						<li><a href="{{route('browse-jobs')}}" @if(Request::is('browse-jobs')) id="current" @endif>Browse Jobs</a></li>
						
						@if(Session::has('user_id'))
							<li><a href="{{route('resume-builder',Session::get('user_id'))}}">Resume Builder <span style="background-color: #26ae61; color:white;padding:2px;border-radius: 3px;">NEW</span></a></li>
						@endif
						<li><a href="{{route('add-resume')}}" @if(Request::is('/add-resume')) id="current" @endif>Add Resume</a></li>
						<li><a href="{{route('manage-resume')}}" @if(Request::is('/manage-resume')) id="current" @endif>Manage Resumes</a></li>
						<li><a href="{{route('job-alerts')}}" @if(Request::is('/job-alerts')) id="current" @endif>Job Alerts</a></li>
					</ul>
				</li>
				<li><a href="#">For Employers</a>
					<ul>
						<li><a href="{{URL::to('employer/myaccount')}}" @if(Request::is('/employer/myaccount')) id="current" @endif>Login/Register</a></li>
						<li><a href="{{route('add-jobs')}}" @if(Request::is('/add-jobs')) id="current" @endif>Add Job</a></li>
						<li><a href="{{route('manage-jobs')}}" @if(Request::is('/manage-jobs')) id="current" @endif>Manage Jobs</a></li>
						<li><a href="{{route('manage-applications')}}" @if(Request::is('/manage-applications')) id="current" @endif>Manage Applications</a></li>
						<li><a href="{{route('browse-resumes')}}" @if(Request::is('/browse-resumes')) id="current" @endif>Browse Resumes</a></li>
					</ul>
				</li>


			@elseif(Session::has('user_id') && !Session::has('employer_id'))
				<li><a href="#">For Candidates</a>
					<ul>
						<li><a href="{{route('browse-jobs')}}" @if(Request::is('/')) id="current" @endif>Browse Jobs</a></li>
						
						@if(Session::has('user_id'))
							<li><a href="{{route('resume-builder',Session::get('user_id'))}}">Resume Builder <span style="background-color: #26ae61; color:white;padding:2px;border-radius: 3px;">NEW</span></a></li>
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


			<ul class="float-right">

				@if(!Session::has('user_id') && !Session::has('employer_id'))
				<li><a href="{{route('my-account')}}#tab2"><i class="fa fa-user"></i> Sign Up</a></li>
				<li><a href="{{route('my-account')}}"><i class="fa fa-lock"></i> Log In</a></li>

				@elseif(Session::has('employer_id'))
					<li><a href="#"><i class="fa fa-user"></i>{{Session::get('company_name')}}</a>
							<ul>
								<li><a href="#">Settings</a></li>
								<li><a href="{{URL::to('/employer/logout')}}">Logout</a></li>
							</ul>
					</li>
				@else
					<li><a href="#"><i class="fa fa-user"></i>{{Session::get('student_name')}}</a>
							<ul>
								<li><a href="#">Settings</a></li>
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


<!-- Banner
================================================== -->
<div id="banner" class="with-transparent-header parallax background" style="background-image: url(images/banner-home-02.jpg)" data-img-width="2000" data-img-height="1330" data-diff="300">
	<div class="container">
		<div class="sixteen columns">
			
			<div class="search-container">

				<!-- Form -->

				<form id="search-form" action="{{route('apicheck')}}" method="POST">
					{{csrf_field()}}
					<h2>Find an entry-level job today</h2>
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
					We’ve over <strong>5000+</strong> job offers for you!
				</div>

			</div>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="clearfix"></div>
</div>


<!-- Content
================================================== -->

<!-- Counters -->
<div id="counters">
	<div class="container">

		<div class="four columns">
			<div class="counter-box">
				<span class="counter">5000</span>
				<p>Job Offers</p>
			</div>
		</div>

		<div class="four columns">
			<div class="counter-box">
				<span class="counter">{{$sizeOfMembers}}</span>
				<p>Members</p>
			</div>
		</div>

		<div class="four columns">
			<div class="counter-box">
				<span class="counter">{{$sizeOfResumes}}</span>
				<p>Resumes Posted</p>
			</div>
		</div>

		<div class="four columns">
			<div class="counter-box">
				<span class="counter">{{$sizeOfCompanies}}</span>
				<p>Clients Who Rehire</p>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="clearfix"></div>
</div>


<div class="container">
	
	<!-- Recent Jobs -->
	<div class="eleven columns">
	<div class="padding-right">
		<h3 class="margin-bottom-25">Recent Jobs</h3>
		<ul class="job-list">
		@foreach($recentJobs as $job)
			<li class="highlighted"><a href="{{$job->url}}" target="_blank" onClick="seen();">
				<img src="{{URL::asset('/images/job-list-logo-01.png')}}" alt="">
				<div class="job-list-content">
					<h4>{{$job->jobtitle}}</h4>
					<div class="job-icons">
						<span style="text-transform: capitalize;"><i class="fa fa-briefcase"></i>{{$job->company}}</span>
						<span><i class="fa fa-map-marker"></i>{{$job->formattedLocation}}</span>
						<?php 
							$date = date_create($job->date);
							$formattedDate = date_format($date,'F d, Y');
						?>
						<span><i class="fa fa-calendar" aria-hidden="true"></i></i>{{$formattedDate}}</span>
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
					@foreach($spotLight as $job)
					<li>
						<div class="job-spotlight">
							<a href="{{$job->url}}"><h4>{{$job->jobtitle}}</a>
							<span><i class="fa fa-briefcase"></i>{{$job->company}}</span>
							<span><i class="fa fa-map-marker"></i>{{$job->city}}</span>
							<p>{{substr($job->snippet,0,50)}}</p>
							<a href="{{$job->url}}" class="button">Apply For This Job</a>
						</div>
					</li>
					@endforeach
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
				      <span>Kyle Wilson-McCormack,&nbspStudent</span></p>
				    </li>

				    <li>
				      <p>I did not know so many students were on the hunt for entry-level jobs.
				      <span>John Smith,&nbspRecruiter</span></p>
				    </li>
				    
				    <li>
				      <p>I only had to use this for a few weeks, before I found the perfect place to work. Thanks ZeroGrad!
				      <span>Tom Smith,&nbspJob Seeker</span></p>
				    </li>

				  </ul>
			</div>
		</div>
	</div>
</div>




<!-- Recent Posts -->
<div class="container">
	<div class="sixteen columns">
		<h3 class="margin-bottom-25">Resources</h3>
	</div>

@foreach($resources as $resource)
	<div class="one-third column">
		<?php 
					$id = $resource->res_id; 
					$title = str_replace(' ','-',$resource->res_title);
				?>
		<!-- Post #1 -->
		<div class="recent-post">
			@if(isset($resource->image_path))
				
				<div class="recent-post-img"><a href="{{route('get-resource',['id'=> $id,'title' => $title])}}"><img src="{{$resource->image_path}}" alt=""></a><div class="hover-icon"></div></div>
				@else
				<div class="recent-post-img"><a href="{{route('get-resource',['id'=> $id,'title' => $title])}}"><img src="{{URL::asset('/images/bg-facts.jpg')}}" alt=""></a><div class="hover-icon"></div></div>
				@endif
			
			
			<a href="{{route('get-resource',['id'=> $id,'title' => $title])}}"><h4>{{$resource->res_title}}</h4></a>
			<div class="meta-tags">
				<?php $date = date_create($resource->created);
										$dateFormatted = date_format($date,'F d, Y'); 
				?>
				<span>{{$dateFormatted}}</span>
				<span><a href="#">0 Comments</a></span>
			</div>
			<p>The world of job seeking can be all consuming. From secretly stalking the open reqs page of your dream company to sending endless applications.</p>
			<p>{{substr($resource->res_content_first,0,100)}}...</p>
			<a class="button" href="{{route('get-resource',['id'=> $id,'title' => $title])}}">Read More</a>
		</div>

	</div>
@endforeach

	

	

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


        @if(Session::has('email_sent'))
			swal('{{Session::get('email_sent')}}'); 
		@endif
    </script>


</body>
</html>