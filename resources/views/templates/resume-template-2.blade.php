
<head>
<title>{{$student->student_name}}- Curriculum Vitae</title>

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
			<img src="data:image/jpeg;base64,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" />
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
