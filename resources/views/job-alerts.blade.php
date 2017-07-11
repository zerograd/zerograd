@extends('layout.newthemelayout')

@section('title')
	<title>Job Alerts</title>
@stop

@section('styles')
	<style type="text/css">
		.table-inputs{
			width:100%;
			border:none;
		}
	</style>
@stop


@section('content')
<!-- Titlebar
================================================== -->
<div id="titlebar" class="single">
	<div class="container">

		<div class="sixteen columns">
			<h2>Job Alerts</h2>
			<nav id="breadcrumbs">
				<ul>
					<li>You are here:</li>
					<li><a href="#">Home</a></li>
					<li>Job Alerts</li>
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

		<p class="margin-bottom-25">Your job alerts are shown below.</p>

		<table class="manage-table resumes responsive-table">

			<tr>
				<th><i class="fa fa-file-text"></i> Alert Name</th>
				<th><i class="fa fa-calendar"></i> Date Created</th>
				<th><i class="fa fa-tags"></i> Keywords</th>
				<th><i class="fa fa-map-marker"></i> Location</th>
				<th><i class="fa fa-clock-o"></i> Frequency</th>
				<th><i class="fa fa-check-square-o"></i> Status</th>
				<th></th>
			</tr>

			<!-- Item #1 -->
			@if($alertSize > 0)
				@foreach($alerts as $alert)
				<tr>
					<?php $date = date_create($alert->date_created);
						$dateFormatted = date_format($date,'Y-m-d'); 
					?>
					<td class="alert-name"><input type="" name="name" value="{{$alert->name}}" class="table-inputs table-inputs-{{$alert->id}}" readonly></td>
					<td><input type="" name="date_created" value="{{$dateFormatted}}" class="table-inputs table-inputs-{{$alert->id}}" readonly></td>
					<td class="keywords"><input type="" name="keywords" value="{{$alert->keywords}}" class="table-inputs" readonly></td>
					<td><input type="" name="location" value="{{$alert->location}}" class="table-inputs table-inputs-{{$alert->id}}" readonly></td>
					<td><select data-placeholder="Email Frequency" name="frequency" class="chosen-select-no-single table-inputs-{{$alert->id}}">
						@foreach($frequency as $option)
							@if($alert->frequency == $option)
							<option value="{{$option}}" selected>{{$option}}</option>
							@else
							<option value="{{$option}}">{{$option}}</option>
							@endif
						@endforeach
					</select></td>
					<td><select data-placeholder="Job Type" name="status" class="chosen-select-no-single table-inputs-{{$alert->id}}" multiple>
						@foreach($status as $option)
							@if($alert->status == $option)
							<option value="{{$option}}" selected>{{$option}}</option>
							@else
							<option value="{{$option}}">{{$option}}</option>
							@endif
						@endforeach
					</select></td>
					<td class="action">
						<a href="#" onClick="editAlert(this,'{{$alert->id}}','table-inputs-{{$alert->id}}');"><i class="fa fa-pencil"></i> Edit</a>
						<a href="#"><i class="fa  fa-eye-slash"></i> Disable</a>
						<a href="javascript:deleteAlert({{$alert->id}});" class="delete"><i class="fa fa-remove"></i> Delete</a>
					</td>
				</tr>
				@endforeach
			@else
				<tr>
					<td>No Alerts set.</td>
				</tr>
			@endif

		</table>

		<br>

		<a href="#small-dialog" class="popup-with-zoom-anim button">Add Alert</a>

		<div id="small-dialog" class="zoom-anim-dialog mfp-hide apply-popup">
			<div class="small-dialog-headline">
				<h2>Add Alert</h2>
			</div>

			<div class="small-dialog-content">
				<form action="{{route('job-alerts-create')}}" method="post" >
					{{csrf_field()}}
					<input type="text" name="name" placeholder="Alert Name" value=""/>
					<input type="text" name="keywords" placeholder="Keyword" value=""/>
					<input type="text" name="location" placeholder="Location" value=""/>

					<!-- Select -->
					<select data-placeholder="Email Frequency" name="frequency" class="chosen-select-no-single">
						<option value="">Email Frequency</option>
						<option value="Daily">Daily</option>
						<option value="Weekly">Weekly</option>
						<option value="Fortnightly">Fortnightly</option>
					</select>

					<div class="clearfix"></div>
					<div class="margin-top-15"></div>

					<!-- Select -->
					<select data-placeholder="Job Type" name="status" class="chosen-select" multiple>
						<option value="Full-Time">Full-Time</option>
						<option value="Part-Time">Part-Time</option>
						<option value="Internship">Internship</option>
						<option value="Freelance">Freelance</option>
						<option value="Temporary">Temporary</option>
					</select>

					<div class="margin-top-20"></div>
					<div class="divider"></div>

					<button type="submit" class="send">Save Alert</button>
				</form>
			</div>
		</div>
	</div>

</div>


@stop

@section('script_plugins')
	<script type="text/javascript">

		function editAlert(element,id,inputClass){
			var edit = $(element);
			edit[0].innerHTML = '<i class="fa fa-check" aria-hidden="true"></i>'+'Save';
			edit.attr('onClick','saveAlert(this,' + id +',"'+ inputClass + '")');
			var inputs = $('.' + inputClass);
			inputs.each(function(){
				var input = $(this);
				input.removeAttr('readonly');
				input.removeAttr('disabled');
			});
		}

		function saveAlert(element,id,inputClass){
			var inputs = $('.' + inputClass);
			var serialized = '';
			$(element)[0].innerHTML = '<i class="fa fa-pencil" aria-hidden="true"></i>'+'Edit';
			$(element).attr('onClick','editAlert(this,' + id +',"'+ inputClass + '")');
			inputs.each(function(){
				var input = $(this);
				var name = input[0].name;
				console.log(name);
				var value = input.val();
				serialized += name +'=' + value + '&';
				input.attr('readonly','readonly');
			});
			serialized += '&_token=' + '{{csrf_token()}}' + '&id=' + id;
			$.post('{{route('job-alerts-update')}}',serialized,function(data){

			});
		}
		function deleteAlert(id){
			$.post('{{route('delete-alert')}}',{id:id,_token:"{{csrf_token()}}"},function(data){
				window.location = data;
			});
		}
	    
	</script>
@stop