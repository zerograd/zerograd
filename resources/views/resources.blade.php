@extends('layout.newthemelayout')

@section('title')
	<title>Resources</title>
@stop

@section('content')
<!-- Titlebar
================================================== -->
<div id="titlebar" class="single">
	<div class="container">

		<div class="sixteen columns">
			<h2>Resources</h2>
			<span>Keep up to date with the latest resources</span>
		</div>

	</div>
</div>


<!-- Content
================================================== -->
<div class="container">

	<!-- Blog Posts -->
	<div class="ten columns">
		<div class="padding-right">

		@foreach($resources as $resource )
			<!-- Post -->
			<div class="post-container">
				@if(isset($resource->image_path))
				<div class="post-img"><a href="{{route('get-resource',$resource->res_id)}}"><img src="{{$resource->image_path}}" alt=""></a><div class="hover-icon"></div></div>
				@else
				<div class="post-img"><a href="{{route('get-resource',$resource->res_id)}}"><img src="{{URL::asset('/images/bg-facts.jpg')}}" alt=""></a><div class="hover-icon"></div></div>
				@endif
				
				<div class="post-content">
					<a href="{{route('get-resource',$resource->res_id)}}"><h3>{{$resource->res_title}}</h3></a>
					<div class="meta-tags">
						<?php $date = date_create($resource->created);
										$dateFormatted = date_format($date,'F d, Y'); 
						?>
						<span>{{$dateFormatted}}</span>
						<span><a href="#">0 Comments</a></span>
					</div>
					<p>{{substr($resource->res_content_first,0,100)}}...</p>
					<a class="button" href="{{route('get-resource',$resource->res_id)}}">Read More</a>
				</div>
			</div>
		@endforeach


			<!-- Pagination -->
			<div class="pagination-container">
				<nav class="pagination">
					<ul>
						<li><a href="#" class="current-page">1</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
					</ul>
				</nav>

				<nav class="pagination-next-prev">
					<ul>
						<li><a href="#" class="prev">Previous</a></li>
						<li><a href="#" class="next">Next</a></li>
					</ul>
				</nav>
			</div>

		</div>
	</div>
	<!-- Blog Posts / End -->


	<!-- Widgets -->
	<div class="five columns blog">

		<!-- Search -->
		<div class="widget">
			<h4>Search</h4>
			<div class="widget-box search">
				<div class="input"><input class="search-field" type="text" placeholder="To search type and hit enter" value=""/></div>
			</div>
		</div>

		<div class="widget">
			<h4>Got any questions?</h4>
			<div class="widget-box">
				<p>If you are having any questions, please feel free to ask.</p>
				<a href="contact.html" class="button widget-btn"><i class="fa fa-envelope"></i> Drop Us a Line</a>
			</div>
		</div>

		<!-- Tabs -->
		<div class="widget">

			<ul class="tabs-nav blog">
				<li class="active"><a href="#tab1">Popular</a></li>
				<li><a href="#tab3">Recent</a></li>
			</ul>

			<!-- Tabs Content -->
			<div class="tabs-container">

				<div class="tab-content" id="tab1">
					
					<!-- Popular Posts -->
					<ul class="widget-tabs">
						@foreach($popularResources as $popularResource)	
							<li>
								<div class="widget-thumb">
									@if(isset($popularResource->image_path))
									<a href="{{route('get-resource',$popularResource->res_id)}}"><img src="{{$popularResource->image_path}}" alt="" /></a>
									@else
									<a href="{{route('get-resource',$popularResource->res_id)}}"><img src="{{URL::asset('/images/bg-facts.jpg')}}" alt="" /></a>
									@endif
									
								</div>
								
								<div class="widget-text">
									<h5><a href="{{route('get-resource',$popularResource->res_id)}}">{{$popularResource->res_title}}</a></h5>
									<?php $date = date_create($popularResource->created);
										$dateFormatted = date_format($date,'F d, Y'); 
									?>
									<span>{{$dateFormatted}}</span>
								</div>
								<div class="clearfix"></div>
							</li>
						@endforeach
					</ul>
		
				</div>

				<div class="tab-content" id="tab3">
				
					<!-- Recent Posts -->
					<ul class="widget-tabs">
						@foreach($recentResources as $recentResource)	
							<li>
								<div class="widget-thumb">
									@if(isset($recentResource->image_path))
									<a href="{{route('get-resource',$recentResource->res_id)}}"><img src="{{$recentResource->image_path}}" alt="" /></a>
									@else
									<a href="{{route('get-resource',$recentResource->res_id)}}"><img src="{{URL::asset('/images/bg-facts.jpg')}}" alt="" /></a>
									@endif
								</div>
								
								<div class="widget-text">
									<h5><a href="{{route('get-resource',$recentResource->res_id)}}">{{$recentResource->res_title}}</a></h5>
									<?php $date = date_create($recentResource->created);
										$dateFormatted = date_format($date,'F d, Y'); 
									?>
									<span>{{$dateFormatted}}</span>
								</div>
								<div class="clearfix"></div>
							</li>
						@endforeach
					</ul>
				</div>
				
			</div>
		</div>


		<div class="widget">
			<h4>Social</h4>
				<ul class="social-icons">
					<li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
					<li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>
					<li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
					<li><a class="linkedin" href="#"><i class="icon-linkedin"></i></a></li>
				</ul>

		</div>
		
		<div class="clearfix"></div>
		<div class="margin-bottom-40"></div>

	</div>
	<!-- Widgets / End -->


</div>

@stop