@extends('layout.newthemelayout')

@section('title')
	<title>Add Jobs</title>
@stop


@section('content')
<!-- Titlebar
================================================== -->
<div id="titlebar" class="single submit-page">
	<div class="container">

		<div class="sixteen columns">
			<h2><i class="fa fa-plus-circle"></i> Add Job</h2>
		</div>

	</div>
</div>


<!-- Content
================================================== -->
<div class="container">
	
	<!-- Submit Page -->
	<div class="sixteen columns">
		<div class="submit-page">

			<!-- Notice -->
			<div class="notification notice closeable margin-bottom-40">
				<p><span>Please use one of the following: Import via RSS or complete the form below.</p>
			</div>


			<!-- Email -->
			<div class="form">
				<h5>Your Email</h5>
				<input class="search-field" type="text" placeholder="mail@example.com" value="{{Session::get('company_email')}}"/>
			</div>


			<form id="add-job-form" action="{{route('create-posting')}}" method="POST">
				{{csrf_field()}}
			<!-- Title -->
			<div class="form">
				<h5>Job Title</h5>
				<input class="search-field" type="text" name="title" placeholder="" value=""/>
			</div>

			<!-- Location -->
			<div class="form">
				<h5>Location <span>(optional)</span></h5>
				<input class="search-field" type="text" placeholder="e.g. London" name="location" value=""/>
				<p class="note">Leave this blank if the location is not important</p>
			</div>

			<!-- Job Type -->
			<div class="form">
				<h5>Job Type</h5>
				<select data-placeholder="Full-Time" class="chosen-select-no-single" name="status">
					<option value="Full-Time">Full-Time</option>
					<option value="Part-Time">Part-Time</option>
					<option value="Internship">Internship</option>
					<option value="Freelance">Freelance</option>
				</select>
			</div>


			<!-- Choose Category -->
			<div class="form">
				<div class="select">
					<h5>Category</h5>
					<select data-placeholder="Choose Categories" class="chosen-select" multiple name="cat_id">
						@foreach($categories as $category)
							<option value="{{$category->cat_id}}">{{$category->cat_name}}</option>
						@endforeach
					</select>
				</div>
			</div>

			<!-- Tags -->
			<div class="form">
				<h5>Job Tags <span>(optional)</span></h5>
				<input class="search-field" type="text" placeholder="e.g. PHP, Social Media, Management" name="keywords" value=""/>
				<p class="note">Comma separate tags, such as required skills or technologies, for this job.</p>
			</div>


			<!-- Description -->
			<div class="form">
				<h5>Description</h5>
				<textarea class="WYSIWYG"  cols="40" rows="3" id="summary" name="description" spellcheck="true"></textarea>
			</div>

			<!-- Application email/url -->
			<div class="form">
				<h5>Application email / URL</h5>
				<input type="text" placeholder="Enter an email address or website URL" name="external_link">
			</div>

			<!-- TClosing Date -->
			<div class="form">
				<h5>Closing Date <span>(optional)</span></h5>
				<input data-role="date" type="text" placeholder="yyyy-mm-dd" name="closing_date">
				<p class="note">Deadline for new applicants.</p>
			</div>

			</form>
			
			


			<div class="divider margin-top-0"></div>
			<a href="javascript:document.getElementById('add-job-form').submit();" class="button big margin-top-5">Preview <i class="fa fa-arrow-circle-right"></i></a>


		</div>
	</div>

</div>

@stop