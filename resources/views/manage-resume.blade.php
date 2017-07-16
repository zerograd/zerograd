@extends('layout.newthemelayout')

@section('title')
	<title>Manage Resumes</title>
@stop


@section('content')
<!-- Titlebar
================================================== -->
<div id="titlebar" class="single">
	<div class="container">

		<div class="sixteen columns">
			<h2>Manage Resumes</h2>
			<nav id="breadcrumbs">
				<ul>
					<li>You are here:</li>
					<li><a href="#">Home</a></li>
					<li>Candidate Dashboard</li>
				</ul>
			</nav>
		</div>

	</div>
</div>


<!-- Content
================================================== -->
<div class="container">
	
	<!-- Table -->
	<div class="sixteen columns">

		<p class="margin-bottom-25">Your resume can be viewed, edited or removed below.</p>


		@if(Session::has('message'))
			<div class="notification notice closeable margin-bottom-40">
				<p>{{Session::get('message')}}</p>
			</div>
			@endif

			@if(Session::has('failed'))
			<div class="notification notice closeable margin-bottom-40" style="background-color: #c90c0c;color:#471414">
				<p>{{Session::get('failed')}}</p>
			</div>
			@endif

		<table class="manage-table resumes responsive-table">

			<tr>
				<th><i class="fa fa-user"></i> Name</th>
				<th><i class="fa fa-file-text"></i> Title</th>
				<th><i class="fa fa-map-marker"></i> Location</th>
				<th><i class="fa fa-calendar"></i> Date Posted</th>
				<th><i class="fa fa-file-text"></i>Uploaded/Builder</th>
				<th></th>
			</tr>

			<!-- Item #1 -->
			@foreach($resumes as $resume)
			<tr>
				<td class="title"><a href="#">{{$resume->student_name}}</a></td>
				@if($resume->title)
				<td>{{$resume->title}}</td>
				@else
				<td>N/A</td>
				@endif
				@if($resume->city)
				<td>{{$resume->city}}</td>
				@else
				<td>N/A</td>
				@endif
				<?php $date = date_create($resume->date_created);
						$dateFormatted = date_format($date,'Y-m-d'); 
					?>
				<td>{{$dateFormatted}}</td>
				@if($resume->builder)
					<td>{{$resume->builder}}</td>
				@elseif($resume->resume_uploaded == 'yes')
					<td>uploaded</td>
				@else
					<td>no</td>
				@endif
				
				<td class="action">
					@if($resume->resume_uploaded == 'yes')
						<a data-remodal-target="modal-{{$resume->resume_id}}"" href="#"><i class="fa fa-pencil"></i> Edit</a>
					@elseif($resume->resume_uploaded == 'no')
						<a data-remodal-target="edit-modal-{{$resume->resume_id}}" href="#"><i class="fa fa-pencil"></i> Edit</a>
					@endif
					<a href="#"><i class="fa  fa-eye-slash"></i> Hide</a>
					<a href="javascript:deleteResume({{$resume->resume_id}})" class="delete"><i class="fa fa-remove"></i> Delete</a>
				</td>
			</tr>
				@if($resume->resume_uploaded == 'yes')
					

					<div class="remodal" data-remodal-id="modal-{{$resume->resume_id}}" data-remodal-options="hashTracking: false">
					  <button data-remodal-action="close" class="remodal-close"></button>
					    <div class="form">
					    <h2>Upload new Resume</h2>
											<label class="upload-btn">
												<form id="submit-file-{{$resume->resume_id}}" action="{{route('update-resume')}}" method="POST" 	enctype="multipart/form-data">
												{{csrf_field()}}

												<input type="hidden" value="{{$resume->resume_id}}" name="id">
											    <input type="file" multiple name="user_file" />
											    <i class="fa fa-upload"></i> Browse
										    	</form>
											</label>
											<span class="fake-input" id="file-name">No file selected</span>
											<button onClick="javascript:document.getElementById('submit-file-{{$resume->resume_id}}').submit();" style="color:white;">Submit</button>
							</div>
					</div>
				
				@endif

				@if($resume->resume_uploaded == 'no')
					@include('edit-resume-modal')
				@endif
			@endforeach


		</table>

		<br>

		<a href="{{route('add-resume')}}" class="button">Add Resume</a>

	</div>

</div>

  	
@stop

@section('script_plugins')
	<script type="text/javascript">

		var quill = new Quill('#editor', {
	    theme: 'snow'
	  });

		$(document).ready(function(){
		$("input[type='file']").change(function(e) {
			var fileName = e.target.files[0].name;
        	$('#file-name').text(fileName);
    	});
	});

		function editResume(id){
			$('.uploaded').css('display','none');
			$('#file-name').text('');
			$('#resume_uploaded_' + id).css('display','table-row');
			$('#resume_uploaded_' + id).find('div').css('display','block');
		}


		
		function deleteResume(id){
			$.post('{{route('delete-resume')}}',{id:id,_token:"{{csrf_token()}}"},function(data){
				window.location = data;
			});
		}

		function previewResume(id){
			var summary = quill.container.innerText;
			var data = $('#' + id).serialize();

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
			$.post('{{route('update-resume-input')}}',{data:data,education:educationJSON,experience:experienceJSON,_token:"{{csrf_token()}}"},function(data){
					window.location = data;
			});
		}

		@if(Session::has('message'))
			swal('{{Session::get('message')}}'); 
		@endif
	</script>
@stop