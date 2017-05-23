
<head>
<title>Joe Bloggs - Curriculum Vitae</title>

<meta name="viewport" content="width=device-width"/>
<meta name="description" content="The Curriculum Vitae of Joe Bloggs."/>
<meta charset="UTF-8"> 

<link type="text/css" rel="stylesheet" href="{{URL::asset('/css/resume-template-2.css')}}">
<link href='http://fonts.googleapis.com/css?family=Rokkitt:400,700|Lato:400,300' rel='stylesheet' type='text/css'>

<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<div id="cv" class="instaFade">
	<div class="mainDetails">
		<div id="headshot" class="quickFade">
			<img src="{{URL::asset('/images/headshot.jpg')}}" alt="Alan Smith" />
		</div>
		
		<div id="name">
			<h1 class="quickFade delayTwo">{{$student->student_name}}</h1>
		</div>
		
		<div id="contactDetails" class="quickFade delayFour">
			<ul>
				<li>e: <a href="mailto:joe@bloggs.com" target="_blank">{{$student->email}}</a></li>
				<!-- <li>w: <a href="http://www.bloggs.com">www.bloggs.com</a></li> -->
				<li>m: {{$resume->telephone_number}}</li>
			</ul>
		</div>
		<div class="clear"></div>
	</div>
	
	<div id="mainArea" class="quickFade delayFive">
		<section>
			<article>
				<div class="sectionTitle">
					<h1>Summary/Objective</h1>
				</div>
				
				<div class="sectionContent">
					<p>{{$summary->summary}}</p>
				</div>
			</article>
			<div class="clear"></div>
		</section>
		
		
		<section>
			<div class="sectionTitle">
				<h1>Work Experience</h1>
			</div>
			
			<div class="sectionContent">

				@foreach($works as $work)
					<article>
						<h2>{{$work->job_title}} at {{$work->company_name}}</h2>
						<p class="subDetails">April ({{$work->start}} - {{$work->completed}})</p>
						<p>{{$work->duties}}</p>
					</article>
				@endforeach
			</div>
			<div class="clear"></div>
		</section>
		
		
		<section>
			<div class="sectionTitle">
				<h1>Key Skills</h1>
			</div>
			
			<div class="sectionContent">
				<ul class="keySkills">
					@foreach($skills as $skill)
						<li>{{$skill->skills}}</li>
					@endforeach
				</ul>
			</div>
			<div class="clear"></div>
		</section>
		
		
		<section>
			<div class="sectionTitle">
				<h1>Education</h1>
			</div>
			
			<div class="sectionContent">
			@foreach($education as $educate)
				<article>
					<h2>{{$educate->school}}</h2>
					<p class="subDetails">{{$educate->program}}</p>
					<p>>({{$educate->start}}-{{$educate->completed}})</p>
				</article>
			@endforeach
			</div>
			<div class="clear"></div>
		</section>
		
	</div>
</div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-3753241-1");
pageTracker._initData();
pageTracker._trackPageview();
</script>
