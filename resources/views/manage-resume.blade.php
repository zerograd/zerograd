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
				<td>{{$resume->title}}</td>
				<td>{{$resume->city}}</td>
				<?php $date = date_create($resume->date_created);
						$dateFormatted = date_format($date,'Y-m-d'); 
					?>
				<td>{{$dateFormatted}}</td>
				<td>{{$resume->builder}}</td>
				<td class="action">
					<a href="#"><i class="fa fa-pencil"></i> Edit</a>
					<a href="#"><i class="fa  fa-eye-slash"></i> Hide</a>
					<a href="javascript:deleteResume({{$resume->resume_id}})" class="delete"><i class="fa fa-remove"></i> Delete</a>
				</td>
			</tr>
			@endforeach


		</table>

		<br>

		<a href="{{route('add-resume')}}" class="button">Add Resume</a>

	</div>

</div>
@stop

@section('script_plugins')
	<script type="text/javascript">
		function deleteResume(id){
			$.post('{{route('delete-resume')}}',{id:id,_token:"{{csrf_token()}}"},function(data){
				window.location = data;
			});
		}
	</script>
@stop