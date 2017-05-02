@extends('layout.homepage-layout')

@section('title')
	Profile
@stop

@section('styles')
	<style>
		#profile{
			height:400px;
			background-color: white;
			margin:0 50px;

		}
		.panel-name{
			display:inline-block;
			background-color: white;
			border-top:5px solid #13B662;
			margin:0 50px;
			margin-top: 10px;
			padding:5px 25px;
		}
		.panel-name h2{
			margin:10px 0;
			color:black;
			font-weight:500;
		}

		.active {
			display:block;
		}
		 h2 {
		 	color:black;
		 }
	</style>
@stop

@section('style_plugins')
	<script type="text/javascript">
		function changeActive(id){
			var currentActive = $('.active');
			currentActive.removeClass('active');
			currentActive.hide();
			$('#' + id).addClass('active');
			$('#' + id).show();
		}
	</script>
@stop

@section('content')
	@include('layout.main-layout')
		<div id="content">
			<div class="col-sm-12">	
				<div class="panel-name">
					<h2>Profile</h2>
				</div>	
				<div id="profile" class="col-sm-11">
					<div class="row" style="padding:5px;text-align: center;" id="profile-buttons">
						<button class="btn btn-primary" onClick="changeActive('summary');">Summary</button>
						<button class="btn btn-success" onClick="changeActive('education');">Education</button>
						<button class="btn btn-info" onClick="changeActive('resume');">Resume</button>
						<button class="btn btn-warning" onClick="changeActive('skills');">Skills</button>
						<button class="btn btn-danger" onClick="changeActive('projects');">Projects</button>
					</div>
					<div class="row">
						<div id="summary" class="active" style="width:95%;margin:0 2.5%;height:100%;border:1px solid #354886;border-radius: 5px;padding:10px;">
							<h2>Summary</h2>
						</div>
						<div id="education" class="" style="display:none;width:95%;margin:0 2.5%;height:100%;border:1px solid #354886;border-radius: 5px;padding:10px;">
							<h2>Education</h2>
						</div>
						<div id="resume" class="" style="display:none;width:95%;margin:0 2.5%;height:100%;border:1px solid #354886;border-radius: 5px;padding:10px;">
							<h2>Resume</h2>
						</div>
						<div id="skills" class="" style="display:none;width:95%;margin:0 2.5%;height:100%;border:1px solid #354886;border-radius: 5px;padding:10px;">
							<h2>Skills</h2>
						</div>
						<div id="projects" class="" style="display:none;width:95%;margin:0 2.5%;height:100%;border:1px solid #354886;border-radius: 5px;padding:10px;">
							<h2>Projects</h2>
						</div>
					</div>
				</div>
			</div>
		</div>
@stop