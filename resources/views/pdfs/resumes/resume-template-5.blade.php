<!DOCTYPE html>
<html>
<head>
	<title>{{$resume->student_name}}</title>
<head>

<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

       
        
<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

	<style type="text/css">


		#content {
			height:100%;
		}
		#header{
			background-color: #06234C;
			padding: 30px;
		}

		#header h1, #header h2 {
			margin:5px 0;
			color:white;
			text-align: center;
			text-transform: uppercase;
		}

		#leftColumn,#rightColumn{
			height:auto;
		}

		#leftColumn{
			border-right: 4px solid #e6e6e6; 
			padding: 30px 10px;
			width:40%;
		}
		#rightColumn{
			padding: 30px 10px;
			width:50%;
		}

		.section {
			padding:10px;
			min-height: 200px;
			width:100%;
		}

		.section-title{
			font-size: 24px;
			margin:0;
			margin-bottom: 15px;
			color:#000000;
			text-transform: uppercase;
			font-weight: bold;
		}
		.section-content{
			font-size: 16px;
			margin:0;
			color:#000000;
			width:100%;
			font-weight: bold;
		}

		.section-content p {
			color:black;
		}

		.text-right{
			
			text-align: right;
		}

		.text-left{
			
			text-align: left;
		}

		#skills,#education{
			margin:0;
			padding:0;
			width:100%;
			list-style: none;
			
		}

		#skills li,#education li{
			text-align: right;
		}

		.skill-text {
			color:black;
			font-weight: bold;
			font-size: 16px;
		}

		#education li {
			margin-bottom: 15px;
		}

		#education li > p {
			margin:0;
		}

		#qualifications{
			margin:0;
			padding: 0 20px;
			width:100%;
			
			list-style: circle;
		}

		.experience{
			margin:0;
			padding: 0 20px;
			width:100%;
			
			list-style: circle;
			margin-bottom: 20px;
		}

		.experience p {
			margin:0;
		}

		.experience-title{
			margin:10px 0;
			
			width:100%;
			color:black;
			font-size: 16px;
			font-weight: 600;
		}

		.experience-title span {
			color:black;
		}

		.list-btn {
			padding:2px 5px;
			
			margin:5px;
		}

		#footer {
			background-color: #06234C;
			color:white;
			padding:15px;
			text-transform: uppercase;
			min-height: 100px;
		}

		/*MEDIA QUERIES*/

		@media (min-width: 320px) {

		#leftColumn{
			border-right: 4px solid #e6e6e6; 
			padding: 10px 10px;
			page-break-after: none;
		}
		#rightColumn{
			padding: 10px 10px;
			page-break-after: always;
		}

		.section {
			padding:10px;
			min-height:120px;	
			width:100%;	
		}

		.section-title{
			font-size: 18px;
			margin:0;
			margin-bottom: 15px;
			color:#000000;
			text-transform: uppercase;
		}
		.section-content{
			font-size: 12px;
			margin:0;
			color:#000000;
			width:100%;
		}

		  	#header{
				background-color: #06234C;
				padding: 30px;
			}

			#header h1, #header h2 {
				margin:5px 0;
				color:white;
				font-size:16px;
				text-align: center;
				text-transform: uppercase;
			}

			#education span {
				color:black;
			}

			#footer span {
				color:white;
			}
		}
	</style>
</head>

<body>
	<div id="content">
		<div id="header">
			<h1 class="resume-name " editable-text="user.name">{{$resume->student_name}}</h1>
			<h2 class="resume-title" editable-text="user.title">{{$resume->title}}</h2>
		</div>
		<div id="leftColumn" class="">
			<div class="section">
				<h2 class="section-title text-right">Profile</h2>
				<p class="section-content text-right" id="summary" editable-textarea="user.summary" e-cols='40' e-rows="7" >{{$resume->summary}}
				</p>
			</div>
			<div class="section">
				<h2 class="section-title text-right">SKILLS</h2>					
				<ul id="skills">
				    @foreach(explode(',',$resume->skills) as $skill)
					<li class=""  class="margin-tab section-content">	  	
						<p class="skill-text">{{$skill}}</p>
					</li>
					@endforeach
				</ul>
			</div>
			<div class="section">
				<h2 class="section-title text-right">EDUCATION</h2>
				<ul id="education">
					@foreach($education as $school)
					<li class="section-content">
						<p editable-text="school.school">{{$school->school}}</p>
						<p>
							<span editable-text="school.degree">{{$school->program}}</span>, 
							<span editable-text="school.complete">{{$school->completed}}</span>
						</p>
					</li>
					@endforeach
				</ul>
			</div>
		</div>
		<div id="rightColumn" class="container col-sm-7">
			<div class="section">
				<h2 class="section-title text-left">Projects</h2>
				@foreach($projects as $project)
				<div class="col-sm-12" >
					<h3 class="experience-title">
						<span editable-text="project.name">{{$project->name}}</span>, 
						<span editable-text="project.role">{{$project->role}}</span> | 
						<span editable-text="project.start">{{$project->start}}</span>-
						<span editable-text="project.completed">{{$project->completed}}</span>
					</h3>
					<ul class="experience">
						@foreach(explode(',',$project->list) as $listitem)
						<li class="section-content">
							<p editable-text="project.list[$index]">{{$listitem}}</p>
						</li>
						@endforeach
					</ul>
				</div>
				@endforeach
			</div>
			<div class="section">
				<h2 class="section-title text-left">Work Experience</h2>
				@foreach($works as $work)
				<div class="col-sm-12">
					<h3 class="experience-title">
						<span editable-text="work.company">{{$work->company_name}}</span>, 
						<span editable-text="work.title">{{$work->job_title}}</span> | 
						<span editable-text="work.start">{{$work->start}}</span>-
						<span editable-text="work.completed">{{$work->completed}}</span>
					</h3>
					<ul class="experience">
						@foreach(explode(',',$work->list) as $listitem)
						<li class="section-content">
							<p editable-text="project.list[$index]">{{$listitem}}</p>
						</li>
						@endforeach
					</ul>
				</div>
				@endforeach
			</div>
		</div> 

		<div id="footer" class="col-sm-12">
			<p class="text-center">
				<span editable-text="user.phone">{{$resume->telephone_number}}</span> |
				<span editable-text="user.email">{{$resume->email}}</span> | 
				<span editable-text="user.city">{{$resume->city}}</span>
			</p>
		</div>
	</div>
	<script src="{{URL::asset('/js/bootstrap.min.js')}}"></script>
</html>

