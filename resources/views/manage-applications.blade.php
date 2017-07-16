@extends('layout.newthemelayout')

@section('title')
	<title>Manage Applications</title>
@stop


@section('content')
<!-- Titlebar
================================================== -->
<div id="titlebar" class="single">
	<div class="container">

		<div class="sixteen columns">
			<h2>Manage Applications</h2>
			<nav id="breadcrumbs">
				<ul>
					<li>You are here:</li>
					<li><a href="#">Home</a></li>
					<li>Job Dashboard</li>
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

		<p class="margin-bottom-25" style="float: left;">The job applications for <strong><a href="#">{{$forAllPositions}}</a></strong> are listed below.</p>
		<strong><a href="#" class="download-csv">Download CSV</a></strong>

	</div>


	<div class="eight columns">
		<!-- Select -->
		<select data-placeholder="Filter by status" class="chosen-select-no-single">
			<option value="">Filter by status</option>
			<option value="new">New</option>
			<option value="interviewed">Interviewed</option>
			<option value="offer">Offer extended</option>
			<option value="hired">Hired</option>
			<option value="archived">Archived</option>
		</select>
		<div class="margin-bottom-15"></div>
	</div>

	<div class="eight columns">
		<!-- Select -->
		<select data-placeholder="Newest first" class="chosen-select-no-single">
			<option value="">Newest first</option>
			<option value="name">Sort by name</option>
			<option value="rating">Sort by rating</option>
		</select>
		<div class="margin-bottom-35"></div>
	</div>


	<!-- Applications -->
	<div class="sixteen columns">
	@foreach($applicants as $applicant)
		<!-- Application #1 -->
		<div class="application" id="application-{{$applicant->id}}">
			<div class="app-content">
				
				<!-- Name / Avatar -->
				<div class="info">
					<img src="{{URL::asset('images/resumes-list-avatar-01.png')}}" alt="">
					<span>{{$applicant->student_name}}</span>
					<ul>
						@if($applicant->cover_letter)
						<li><a href="{{route('download-cv',[ 'postingID' => $applicant->posting_id, 'id' => $applicant->user_id])}}" target="_blank"><i class="fa fa-file-text"></i> Download CV</a></li>
						@endif
						<li><a href="mailto:{{$applicant->email}}"><i class="fa fa-envelope"></i> Contact</a></li>
					</ul>
				</div>
				
				<!-- Buttons -->
				<div class="buttons">
					<a href="#one-1" class="button gray app-link"><i class="fa fa-pencil"></i> Edit</a>
					<a href="#two-1" class="button gray app-link"><i class="fa fa-sticky-note"></i> Add Note</a>
					<a href="#three-1" class="button gray app-link"><i class="fa fa-plus-circle"></i> Show Details</a>
				</div>
				<div class="clearfix"></div>

			</div>

			<!--  Hidden Tabs -->
			<div class="app-tabs">

				<a href="#" class="close-tab button gray"><i class="fa fa-close"></i></a>
				
				<!-- First Tab -->
			    <div class="app-tab-content" id="one-1">
		    	<form id="status-form-{{$applicant->id}}" method="POST">
					<div class="select-grid">
						<select data-placeholder="Application Status" class="chosen-select-no-single" name="status">
							@foreach($statues as $status)
								@if(strcasecmp($applicant->status,$status) == 0)
									<option value="{{$status}}" selected>{{$status}}</option>
								@else
									<option value="{{$status}}">{{$status}}</option>
								@endif
							@endforeach
						</select>
					</div>

					<div class="select-grid">
						<input type="number" min="1" max="5" name="rating" placeholder="Rating (out of 5)">
					</div>
				</form>
					<div class="clearfix"></div>
					<a href="javascript:statusRating({{$applicant->id}});" class="button margin-top-15">Save</a>
					<a href="javascript:deleteApplication({{$applicant->id}});" class="button gray margin-top-15 delete-application">Delete this application</a>

			    </div>
			    
			    <!-- Second Tab -->
			    <div class="app-tab-content"  id="two-1">
					<textarea placeholder="Private note regarding this application" name="notes" id="notes-{{$applicant->id}}">{{$applicant->notes}}</textarea>
					<a href="javascript:addNotes({{$applicant->id}});" class="button margin-top-15">Add Note</a>
			    </div>
			    
			    <!-- Third Tab -->
			    <div class="app-tab-content"  id="three-1">
					<i>Full Name:</i>
					<span>{{$applicant->student_name}}</span>

					<i>Email:</i>
					<span><a href="mailto:{{$applicant->email}}">{{$applicant->email}}</a></span>

					<i>Message:</i>
					<span>{{$applicant->message}} </span>
			    </div>

			</div>

			<!-- Footer -->
			<div class="app-footer">

				<!-- Get the star rating -->
				<?php

					$ratings = '';
					switch ($applicant->rating) {
					    case 1:
				        	$ratings = 'one-stars';
					        break;
					    case 2:
					        $ratings = 'two-stars';
					        break;
					    case 3:
					        $ratings = 'three-stars';
					        break;

				        case 4:
					        $ratings = 'four-stars';
					        break;

				        case 5:
					        $ratings = 'five-stars';
					        break;
					    default:
					        $ratings = "no-stars";
					}

				?>

				<div class="rating {{$ratings}}">
					<div class="star-rating"></div>
					<div class="star-bg"></div>
				</div>

				<ul>
					<li id="applicant-status-{{$applicant->id}}"style="text-transform: capitalize;"><i class="fa fa-file-text-o"></i> {{$applicant->status}}</li>

					<?php
						$date = date_create($applicant->created);
						$applied = date_format($date,'F d, Y');
					?>
					<li><i class="fa fa-calendar"></i>{{$applied}}</li>
				</ul>
				<div class="clearfix"></div>

			</div>
		</div>
	@endforeach

		


	</div>
</div>
@stop

@section('script_plugins')
	<script type="text/javascript">
		function addNotes(id){
			var data = '&notes=' + $('#notes-' + id).val();
			data += '&id=' + id + '&_token=' + "{{csrf_token()}}";
			$.post("{{route('update-application')}}",data,function(data){
				alert('Saved');
			});
		}
		function statusRating(id){
			var data = $('#status-form-' + id).serialize();
			data += '&id=' + id + '&_token=' + "{{csrf_token()}}";
			$.post("{{route('update-application')}}",data,function(data){
				alert('Saved');
			});
		}

		function deleteApplication(id){
			var data = '&status=deleted';
			data += '&id=' + id + '&_token=' + "{{csrf_token()}}";
			$.post("{{route('update-application')}}",data,function(data){
				$('#application-' + id).fadeOut();
			});
		}
	</script>
@stop