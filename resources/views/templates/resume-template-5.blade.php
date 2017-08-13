
<head>
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
		}
		#rightColumn{
			padding: 30px 10px;
		}

		.section {
			padding:10px;
			min-height: 200px;
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
			float:right;
			text-align: right;
		}

		.text-left{
			float:left;
			text-align: left;
		}

		#skills,#education{
			margin:0;
			padding:0;
			width:100%;
			list-style: none;
			float:right;
		}

		#skills li,#education li{
			text-align: right;
		}

		.skill-text {
			color:black;
			font-weight: bold;
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
			float:left;
			list-style: circle;
		}

		.experience{
			margin:0;
			padding: 0 20px;
			width:100%;
			float:left;
			list-style: circle;
			margin-bottom: 20px;
		}

		.experience p {
			margin:0;
		}

		.experience-title{
			margin:10px 0;
			float:left;
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
			float:right;
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
		}
		#rightColumn{
			padding: 10px 10px;
		}

		.section {
			padding:10px;
			min-height:120px;		
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
	<div id="content" class="container-fluid">
		<div id="header">
			<h1 class="resume-name " editable-text="user.name"><% user.name || 'Add A Name'%></h1>
			<h2 class="resume-title" editable-text="user.title"><%user.title || 'A Title'%></h2>
		</div>
		<div id="leftColumn" class="container col-sm-5">
			<div class="section">
				<h2 class="section-title text-right">Profile</h2>
				<p class="section-content text-right" id="summary" editable-textarea="user.summary" e-cols='40' e-rows="7" ><%user.summary || 'Enter a summary...'%>
				</p>
			</div>
			<div class="section">
				<h2 class="section-title text-right">SKILLS</h2>					
				<ul id="skills">
					<li class="" ng-repeat="skill in user.skills track by $index" class="margin-tab section-content">	  	<p editable-text="skill" class="skill-text"><% skill || 'New Skill...'%></p>
					</li>
				</ul>
				<div class="col-sm-12">
						<button class="btn btn-success" ng-click="addSkill();">+</button>
						<button class="btn btn-danger" ng-click="removeSkill();">-</button>
				</div>
			</div>
			<div class="section">
				<h2 class="section-title text-right">EDUCATION</h2>
				<ul id="education">
					<li class="section-content" ng-repeat="school in user.education track by $index">
						<p editable-text="school.school"><% school.school || 'School Here'%></p>
						<p>
							<span editable-text="school.degree"><% school.degree || 'Degree Here..'%></span>, 
							<span editable-text="school.complete"><% school.complete || 'completion year..'%></span>
						</p>
					</li>
				</ul>
				<div class="col-sm-12">
						<button class="btn btn-success" ng-click="addSchool();">+</button>
						<button class="btn btn-danger" ng-click="removeSchool();">-</button>
				</div>
			</div>
		</div>
		 <div id="rightColumn" class="container col-sm-7">
			<div class="section">
				<h2 class="section-title text-left">Projects</h2>
				<div class="col-sm-12" ng-repeat="project in user.projects track by $index">
					<h3 class="experience-title">
						<span editable-text="project.name"><% project.name || 'Project Name'%></span>, 
						<span editable-text="project.role"><% project.role || 'Role'%></span> | 
						<span editable-text="project.start"><% project.start || 'Start Date'%></span>-
						<span editable-text="project.completed"><% project.completed || 'Completed'%></span>
					</h3>
					<ul class="experience">
						<li class="section-content" ng-repeat="listitem in project.list track by $index">
							<p editable-text="project.list[$index]"><% project.list[$index] || 'Add project note...'%></p>
						</li>
					</ul>
					<div class="col-sm-12">
						<button class="list-btn btn btn-success" ng-click="addListItem('project',$index);">+</button>
						<button class="list-btn btn btn-danger" ng-click="removeListItem('project',$index);">-</button>
					</div>
				</div>
				<div class="col-sm-12">
						<button class="btn btn-success" ng-click="addWork();">+</button>
						<button class="btn btn-danger" ng-click="removeWork();">-</button>
				</div>
			</div>
			<div class="section">
				<h2 class="section-title text-left">Work Experience</h2>
				<div class="col-sm-12" ng-repeat="work in user.works track by $index">
					<h3 class="experience-title">
						<span editable-text="work.company"><% work.company || 'Company Here'%></span>, 
						<span editable-text="work.title"><% work.title || 'Position Here'%></span> | 
						<span editable-text="work.start"><% work.start || 'Start Date'%></span>-
						<span editable-text="work.completed"><% work.completed || 'Completed'%></span>
					</h3>
					<ul class="experience">
						<li class="section-content" ng-repeat="listitem in work.list track by $index">
							<p editable-text="work.list[$index]"><% work.list[$index] || 'Add work note...'%></p>
						</li>
					</ul>
					<div class="col-sm-12">
						<button class="list-btn btn btn-success" ng-click="addListItem('work',$index);">+</button>
						<button class="list-btn btn btn-danger" ng-click="removeListItem('work',$index);">-</button>
					</div>
				</div>
				<div class="col-sm-12">
						<button class="btn btn-success" ng-click="addWork();">+</button>
						<button class="btn btn-danger" ng-click="removeWork();">-</button>
				</div>
			</div>
		</div> 

		<div id="footer" class="col-sm-12">
			<p class="text-center">
				<span editable-text="user.phone"><% user.phone || 'Phone number here...'%></span>&nbsp|&nbsp
				<span editable-text="user.email"><% user.email || 'Email here...'%></span>&nbsp|&nbsp
				<span editable-text="user.city"><% user.city || 'Your City here...'%></span>
			</p>
		</div>
	</div>
	<script src="{{URL::asset('/js/bootstrap.min.js')}}"></script>
