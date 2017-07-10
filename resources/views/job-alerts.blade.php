@extends('layout.newthemelayout')

@section('title')
	<title>Job Alerts</title>
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
			<tr>
				<td class="alert-name">Looking for job</td>
				<td>September 30, 2015</td>
				<td class="keywords">Web Developer, PHP, HTML</td>
				<td>London</td>
				<td>Daily</td>
				<td>Enabled</td>
				<td class="action">
					<a href="#"><i class="fa fa-check-circle-o"></i> Show Results</a>
					<a href="#"><i class="fa fa-envelope"></i> Email</a>
					<a href="#"><i class="fa fa-pencil"></i> Edit</a>
					<a href="#"><i class="fa  fa-eye-slash"></i> Disable</a>
					<a href="#" class="delete"><i class="fa fa-remove"></i> Delete</a>
				</td>
			</tr>

		</table>

		<br>

		<a href="#small-dialog" class="popup-with-zoom-anim button">Add Alert</a>

		<div id="small-dialog" class="zoom-anim-dialog mfp-hide apply-popup">
			<div class="small-dialog-headline">
				<h2>Add Alert</h2>
			</div>

			<div class="small-dialog-content">
				<form action="#" method="get" >
					<input type="text" placeholder="Alert Name" value=""/>
					<input type="text" placeholder="Keyword" value=""/>
					<input type="text" placeholder="Location" value=""/>

					<!-- Select -->
					<select data-placeholder="Email Frequency" class="chosen-select-no-single">
						<option value="">Email Frequency</option>
						<option value="1">Daily</option>
						<option value="2">Weekly</option>
						<option value="3">Fortnightly</option>
					</select>

					<div class="clearfix"></div>
					<div class="margin-top-15"></div>

					<!-- Select -->
					<select data-placeholder="Job Type" class="chosen-select" multiple>
						<option value="1">Full-Time</option>
						<option value="2">Part-Time</option>
						<option value="3">Internship</option>
						<option value="4">Freelance</option>
						<option value="5">Temporary</option>
					</select>

					<div class="margin-top-20"></div>
					<div class="divider"></div>

					<button class="send">Save Alert</button>
				</form>
			</div>
		</div>
	</div>

</div>


@stop