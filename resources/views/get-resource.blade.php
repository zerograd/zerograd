@extends('layout.newthemelayout')

@section('title')
	<title>Resource: {{$resource->res_title}}</title>
@stop


@section('content')
<!-- Titlebar
================================================== -->
<div id="titlebar" class="single">
	<div class="container">

		<div class="sixteen columns">
			<h2>{{$resource->res_title}}</h2>
			<span>{{$resource->sub_title}}</span>
		</div>

	</div>
</div>


<!-- Content
================================================== -->
<div class="container">

	<!-- Blog Posts -->
	<div class="ten columns">
		<div class="padding-right">

			<!-- Post -->
			<div class="post-container">
				@if(isset($resource->res_image))
				<div class="post-img"><a href="#"><img src="{{$image_path}}" alt=""></a></div>
				@else
				<div class="post-img"><a href="#"><img src="{{URL::asset('/images/bg-facts.jpg')}}" alt=""></a></div>
				@endif
				<div class="post-content">
					<a href="#"><h3>{{$resource->res_title}}</h3></a>
					<div class="meta-tags">
						<?php $date = date_create($resource->created);
						$dateFormatted = date_format($date,'F d, Y'); 
						?>
						<span>{{$dateFormatted}}</span>
						<span>{{$resource->res_author}}</span>
						<span><a href="#">{{$resource->commentsCount}}&nbspComments</a></span>
					</div>
					<div class="clearfix"></div>
					<div class="margin-bottom-25"></div>

					<p>{{$resource->res_content_first}}</p>

					@if($resource->quote)
					<div class="post-quote">
						<span class="icon"></span>
						<blockquote>
							{{$resource->quote}}
						</blockquote>
					</div>
					@endif

					<p>{{$resource->res_content_second}}</p>

				</div>
			</div>

			<!-- Comments -->
			<section class="comments">
			<h4>Comments <span class="comments-amount">({{$resource->commentsCount}})</span></h4>

				<ul>
					<li>
						<div class="avatar"><img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=70" alt="" /></div>
						<div class="comment-content"><div class="arrow-comment"></div>
							<div class="comment-by">Kathy Brown<span class="date">12th, June 2015</span>
								<a href="#" class="reply"><i class="fa fa-reply"></i> Reply</a>
							</div>
							<p>Morbi velit eros, sagittis in facilisis non, rhoncus et erat. Nam posuere tristique sem, eu ultricies tortor imperdiet vitae. Curabitur lacinia neque non metus</p>
						</div>
					</li>

					<li>
						<div class="avatar"><img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=70" alt="" /> </div>
						<div class="comment-content"><div class="arrow-comment"></div>
							<div class="comment-by">John Doe<span class="date">15th, May 2015</span>
								<a href="#" class="reply"><i class="fa fa-reply"></i> Reply</a>
							</div>
							<p>Commodo est luctus eget. Proin in nunc laoreet justo volutpat blandit enim. Sem felis, ullamcorper vel aliquam non, varius eget justo. Duis quis nunc tellus sollicitudin mauris.</p>
						</div>

					</li>
				 </ul>
			</section>


			<div class="clearfix"></div>
			<div class="margin-top-35"></div>


			<!-- Add Comment -->
			<h4 class="comment">Add Comment</h4>
			<div class="margin-top-20"></div>
			
			<!-- Add Comment Form -->
			<form id="add-comment" class="add-comment">
				<fieldset>

					<div>
						<label>Name:</label>
						<input type="text" value=""/>
					</div>
						
					<div>
						<label>Email: <span>*</span></label>
						<input type="text" value=""/>
					</div>

					<div>
						<label>Comment: <span>*</span></label>
						<textarea cols="40" rows="3"></textarea>
					</div>

				</fieldset>

				<a href="#" class="button color">Add Comment</a>
				<div class="clearfix"></div>
				<div class="margin-bottom-20"></div>

			</form>

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
									<a href="{{route('get-resource',[$popularResource->res_id,$popularResource->res_title])}}"><img src="{{$popularResource->image_path}}" alt="" /></a>
									@else
									<a href="{{route('get-resource',[$popularResource->res_id,$popularResource->res_title])}}"><img src="{{URL::asset('/images/bg-facts.jpg')}}" alt="" /></a>
									@endif
									
								</div>
								
								<div class="widget-text">
									<h5><a href="{{route('get-resource',[$popularResource->res_id,$popularResource->res_title])}}">{{ str_replace('-',' ',$popularResource->res_title)}}</a></h5>
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
									<a href="{{route('get-resource',[$recentResource->res_id,$recentResource->res_title])}}"><img src="{{$recentResource->image_path}}" alt="" /></a>
									@else
									<a href="{{route('get-resource',[$recentResource->res_id,$recentResource->res_title])}}"><img src="{{URL::asset('/images/bg-facts.jpg')}}" alt="" /></a>
									@endif
								</div>
								
								<div class="widget-text">
									<h5><a href="{{route('get-resource',[$recentResource->res_id,$recentResource->res_title])}}">{{str_replace('-',' ',$recentResource->res_title)}}</a></h5>
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