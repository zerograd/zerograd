@extends('layout.newthemelayout')

@section('title')
	<title>Manage Applications</title>
@stop

@section('styles')
	<style type="text/css">
		.loader {
		    border: 16px solid #f3f3f3; /* Light grey */
		    border-top: 16px solid #26ae61; /* Blue */
		    border-radius: 50%;
		    width: 120px;
		    height: 120px;
		    animation: spin 2s linear infinite;
		    margin:0 auto;
		}

		@keyframes spin {
		    0% { transform: rotate(0deg); }
		    100% { transform: rotate(360deg); }
		}
	</style>
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
		<select data-placeholder="Filter by status" class="chosen-select-no-single" id="filter-status" name="status">
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
		<select data-placeholder="Newest first" class="chosen-select-no-single" name="name" id="filter-name">
			<option value="new">Newest first</option>
			<option value="name">Sort by name</option>
			<option value="rating">Sort by rating</option>
		</select>
		<div class="margin-bottom-35"></div>
	</div>


	<!-- Applications -->
	<div id="results" class="sixteen columns">
		@include('sub-manage-applications')
	</div>
</div>

<input type="hidden" name="posting" id="posting" value="{{$posting}}">
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

		function filterApplications(){
			 $('#results').html('<div class="loader" style="display:none;"></div>');
			 $('#loader').show();
			var status = $('#filter-status').val();
			var name = $('#filter-name').val();
			$.post("{{route('filter-applications')}}",{name:name,status:status,_token:"{{csrf_token()}}",id:$('#posting').val()},function(data){
				$('#loader').hide();
				 $('#results').html(data);
			});
		}

		$(document).ready(function(){
			$('#filter-status').on('change',function(){
				filterApplications();
			});

			$('#filter-name').on('change',function(){
				filterApplications();
			});
		});
	</script>
@stop