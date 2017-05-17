
<head>
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<style type="text/css">
	.font-style {
		font-family: 'Raleway', sans-serif;
	}
</style>
	<title>{{$student->student_name}}</title>
</head>

<div style="width:100%;">
	<!-- Name & Email  -->
	<div style="display: block; width:100%;">
		<h1 class="font-style" style="text-align: center;margin:0;">{{$student->student_name}}</h1>
		<h3 class="font-style" style="text-align: center;margin:5px 0;">Email: {{$student->email}}</h3>
	</div>
	<!-- Contact and Personal info -->
	<div style="display: block;width: 100%;text-align: center;">
		<h4 class="font-style" style="display:block;margin:0;text-align: center;">{{$resume->address}},{{$resume->city}},{{$resume->state}},{{$resume->zipcode}}</h4>
	</div>
	<div style="display: block;width: 100%;text-align: center;">
		<h4 class="font-style" style="display:block;margin:0;">{{$resume->telephone_number}}</h4>
	</div>

	<!-- Objective -->
	<div style="display: block;width: 100%;text-align: center;">
		<h3 class="font-style" style="text-decoration: underline;">Objective</h3>
		<p>{{$resume->objective}}</p>
	</div>

	<!-- Skills -->
	<div style="display: block;width: 100%;text-align: center;">
		<h3 class="font-style" style="text-decoration: underline;">Skills</h3>
		<p>{{$resume->skills}}</p>
	</div>

	<!-- Education -->
	<div style="display: block;width: 100%;text-align: center;">
		<h3 class="font-style" style="text-decoration: underline;">Education</h3>
		@foreach($education as $educate)
			<p style="margin: 0;"><strong>{{$educate->program}}</strong> at {{$educate->school}}</p>
			<p style="margin: 0;">({{$educate->start}}-{{$educate->completed}})</p>
		@endforeach
	</div>
	<div style="display: block;width: 100%;text-align: center;">
		<h3 class="font-style" style="text-decoration: underline;">Work Experience</h3>
		@foreach($works as $work)
			<p style="margin: 0;"><strong>{{$work->job_title}}</strong> at {{$work->company_name}}</p>
			<p style="margin: 0;">({{$work->start}}-{{$work->completed}})</p>
		@endforeach
	</div>
	<div style="display: block;width: 100%;text-align: center;">
		<h3 class="font-style" style="text-decoration: underline;">Volunteer</h3>
		@foreach($volunteers as $volunteer)
			<p style="margin: 0;"><strong>{{$volunteer->job_title}}</strong> at {{$volunteer->volunteer_name}}</p>
			<p style="margin: 0;">({{$volunteer->start}}-{{$volunteer->completed}})</p>
		@endforeach
	</div>
	<div style="display: block;width: 100%;text-align: center;">
		<h3 class="font-style" style="text-decoration: underline;">Skills</h3>
		@foreach($skills as $skill)
			<p style="margin: 0;"><strong>{{$skill->skills}}</strong></p>
		@endforeach
	</div>
	<div style="display: block;width: 100%;text-align: center;">
		<h3 class="font-style" style="text-decoration: underline;">Projects</h3>
		@foreach($projects as $project)
			<p style="margin: 0;"><strong>{{$project->project_name}}</strong></p>
			<p style="margin: 0;">{{$project->project_overview}}</p>
		@endforeach
	</div>
</div>