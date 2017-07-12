@extends('layout.newthemelayout')

@section('title')
	<title>Add Resume</title>
@stop

@section('content')
<!-- Titlebar
================================================== -->
<div id="titlebar" class="single submit-page">
	<div class="container">

		<div class="sixteen columns">
			<h2><i class="fa fa-plus-circle"></i> Add Resume</h2>
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
				<p><span>Try our new <a href="{{route('resume-builder',Session::get('user_id'))}}" style="font-size:20px">Resume Builder</a>,or fill out your information below.</p>
			</div>


			<!-- Linked In -->
			<div class="form">
				<h5>LinkedIn</h5>
				<a href="#" class="button linkedin-btn">Import from LinkedIn</a>
			</div>

			<!-- Email -->
		<form id="resume-form" method="POST">
			<div class="form">
				<h5>Your Name</h5>
				<input class="search-field" type="text"  placeholder="Your full name" value="{{Session::get('student_name')}}"/>
			</div>

			<!-- Email -->
			<div class="form">
				<h5>Your Email</h5>
				<input class="search-field" type="text" placeholder="mail@example.com" value="{{Session::get('email')}}"/>
			</div>

			<!-- Title -->
			<div class="form">
				<h5>Professional Title</h5>
				<input class="search-field" type="text" name="title" placeholder="e.g. Web Developer" value=""/>
			</div>

			<!-- Location -->
			<div class="form">
				<h5>Location</h5>
				<input class="search-field" type="text" name="city" placeholder="e.g. London, UK" value=""/>
			</div>

			<!-- Logo -->
			<div class="form">
				<h5>Attachments <span>(DOCX/PDF)</span></h5>
				<label class="upload-btn">
				    <input type="file" multiple />
				    <i class="fa fa-upload"></i> Browse
				</label>
				<span class="fake-input">No file selected</span>
			</div>

			

			<!-- Description -->
			<div class="form">
				<h5>Resume Content</h5>
				<div id="editor" style="height:300px;">
				</div>
			</div>


			<!-- Add URLs -->
			<!-- <div class="form with-line">
				<h5>URL(s) <span>(optional)</span></h5>
				<div class="form-inside">
					
					
					<div class="form boxed box-to-clone url-box">
						<a href="#" class="close-form remove-box button"><i class="fa fa-close"></i></a>
						<input class="search-field" type="text" placeholder="Name" value=""/>
						<input class="search-field" type="text" placeholder="http://" value=""/>
					</div>

					<a href="#" class="button gray add-url add-box"><i class="fa fa-plus-circle"></i> Add URL</a>
					<p class="note">Optionally provide links to any of your websites or social network profiles.</p>
				</div>
			</div> -->


			<!-- Education -->
			<div class="form with-line">
				<h5>Education <span>(optional)</span></h5>
				<div class="form-inside">

					<!-- Add Education -->
					<div class="form boxed box-to-clone education-box">
						<a href="#" class="close-form remove-box button"><i class="fa fa-close"></i></a>
						<input class="search-field" type="text" name="school_name" placeholder="School Name" value=""/>
						<input class="search-field" type="text" name="program" placeholder="Program" value=""/>
						<input class="search-field" type="text" name="completion" placeholder="Start / end date" value=""/>
					</div>

					<a href="#" class="button gray add-education add-box"><i class="fa fa-plus-circle"></i> Add Education</a>
				</div>
			</div>


			<!-- Experience  -->
			<div class="form with-line">
				<h5>Experience <span>(optional)</span></h5>
				<div class="form-inside">

					<!-- Add Experience -->
					<div class="form boxed box-to-clone experience-box">
						<a href="#" class="close-form remove-box button"><i class="fa fa-close"></i></a>
						<input class="search-field" type="text" name="employer" placeholder="Employer" value=""/>
						<input class="search-field" type="text" name="job_title" placeholder="Job Title" value=""/>
						<input class="search-field" type="text" name="completion" placeholder="Start / end date" value=""/>
					</div>

					<a href="#" class="button gray add-experience add-box"><i class="fa fa-plus-circle"></i> Add Experience</a>
				</div>
			</div>

		</form>
			<div class="divider margin-top-0 padding-reset"></div>
			<a href="#" onClick="previewResume();" class="button big margin-top-5" target="_blank">Create Resume <i class="fa fa-arrow-circle-right"></i></a>

		</div>
	</div>

</div>




@stop

@section('script_plugins')
	<script type="text/javascript">
		var quill = new Quill('#editor', {
	    theme: 'snow'
	  });


		function previewResume(){
			var summary = quill.container.innerText;
			var data = $('#resume-form').serialize();

			//Get all education boxes that were created
			var educations = $('.education-box');
			var educationJSON = [];
			educations.each(function(){
				var school = $(this).find("input[name='school_name']").val();
				var program = $(this).find("input[name='program']").val();
				var completion = $(this).find("input[name='completion']").val();
				var education = {
					school:school,
					program:program,
					completion:completion
				};
				educationJSON.push(education);
			});

			//Get all experience boxes that were created
			var experiences = $('.experience-box:visible');
			var experienceJSON = [];
			experiences.each(function(){
				var employer = $(this).find("input[name='employer']").val();
				var job_title = $(this).find("input[name='job_title']").val();
				var completion = $(this).find("input[name='completion']").val();
				var experience = {
					employer:employer,
					job_title:job_title,
					completion:completion
				};
				experienceJSON.push(experience);
			});
			
			data += '&summary=' + summary;
			data += '&_token=' + "{{csrf_token()}}";
			$.post('{{route('create-resume')}}',{data:data,education:educationJSON,experience:experienceJSON,_token:"{{csrf_token()}}"},function(data){

			});
		}
	</script>
@stop	