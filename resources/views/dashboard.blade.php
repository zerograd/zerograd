@extends('layout.newthemelayout')

@section('title')
	<title>Dashboard</title>
@stop

@section('styles')
	<style type="text/css">
		.dashboard-option {
			width:20%;
			height:150px;
			float:left;
			text-align: center;
			border: 1px solid #c6c6c6;
		}
		.dashboard-option h2 {
			line-height: 5;
		}
	</style>
@stop


@section('content')
<!-- Titlebar
================================================== -->
<div id="titlebar" class="single">
	<div class="container">

		<div class="sixteen columns">
			<h2>Dashboard</h2>
			<nav id="breadcrumbs">
				<ul>
					<li>You are here:</li>
					<li><a href="#">Dashboard</a></li>
					<li>Main</li>
				</ul>
			</nav>
		</div>

	</div>
</div>


<!-- Content
================================================== -->
<div class="container">
	<div class="dashboard-option">
		<h2>Browse Jobs</h2>
	</div>
	<div class="dashboard-option">
		<h2>Job Alerts</h2>
	</div>
	<div class="dashboard-option">
		<h2>Resume Builder</h2>
	</div>
	<div class="dashboard-option">
		<h2>Add Resume</h2>
	</div>
	<div class="dashboard-option">
		<h2>Manage Resumes</h2>
	</div>
</div>
@stop