
@extends('layout.newthemelayout')

@section('title')
 <title>Resume Page</title>
@stop



@section('content')

<!-- Titlebar
================================================== -->
<div id="titlebar" class="resume">
	<div class="container">
		<div class="ten columns">
			<div class="resume-titlebar">
				<img src="{{URL::asset('theme/images/resumes-list-avatar-01.png')}}" alt="">
				<div class="resumes-list-content">
					<h4>{{$student->student_name}} <span>UX/UI Graphic Designer</span></h4>
					<span class="icons"><i class="fa fa-map-marker"></i> Mountain View, CA</span>
					<span class="icons"><i class="fa fa-money"></i> $100 / hour</span>
					<span class="icons"><a href="#"><i class="fa fa-link"></i> Website</a></span>
					<span class="icons"><a href="mailto:{{$student->email}}"><i class="fa fa-envelope"></i>{{$student->email}}</a></span>
					<div class="skills">
						@foreach($skills as $skill)
							<span>{{$skill}}</span>
						@endforeach
					</div>
					<div class="clearfix"></div>

				</div>
			</div>
		</div>

		<div class="six columns">
			<div class="two-buttons">

				<a href="#small-dialog" class="popup-with-zoom-anim button"><i class="fa fa-envelope"></i> Send Message</a>

				<div id="small-dialog" class="zoom-anim-dialog mfp-hide apply-popup">
					<div class="small-dialog-headline">
						<h2>Send Message to John Doe</h2>
					</div>

					<div class="small-dialog-content">
						<form action="#" method="get" >
							<input type="text" placeholder="Full Name" value=""/>
							<input type="text" placeholder="Email Address" value=""/>
							<textarea placeholder="Message"></textarea>

							<button class="send">Send Application</button>
						</form>
					</div>
					
				</div>
				<a href="#" class="button dark"><i class="fa fa-star"></i> Bookmark This Resume</a>


			</div>
		</div>

	</div>
</div>

<!-- Content
================================================== -->
<div class="container">
	<!-- Recent Jobs -->
	<div class="eight columns">
	<div class="padding-right">

		<h3 class="margin-bottom-15">About Me</h3>

		<p class="margin-reset">
			{{$profileSummary->summary}}
		</p>

		<br>

		

	</div>
	</div>


	<!-- Widgets -->
	<div class="eight columns">

		<h3 class="margin-bottom-20">Education</h3>

		<!-- Resume Table -->
		<dl class="resume-table">

			@foreach($educations as $education)
			<dt>
				<small class="date">{{$education->start}} - {{$education->completed}}</small>
				<strong>{{$education->school}}</strong>
			</dt>
			<dd>
				<p>{{$education->program}}</p>
			</dd>
			@endforeach
		
			

		</dl>

	</div>

</div>
@stop


