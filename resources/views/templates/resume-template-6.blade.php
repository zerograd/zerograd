
<head>

<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

	<style type="text/css">
		#content{
			width: 100%;
			height:100%;
		}

		#leftColumn,#rightColumn{
			height:1000px;
		}

		#leftColumn{
			background-color: #D1BF15;

		}
		#rightColumn{
			background-color: #200842;
		}



		.border {
			width:20px;
			position: absolute;
			top:0;
			right:0;
			height:100%;
		}

		.container {
			padding:10px 0;
		}

		.left-plus {
			color:#200842;
			margin:3px 0;
			transform: rotate(45deg);
		}
		.right-plus {
			color:#D1BF15;
			margin:3px 0;
			transform: rotate(45deg);
		}

		.resume-name {
			color:#D1BF15;
			margin:0;
			text-transform: uppercase;
			font-weight: 600;
		}

		.resume-title{
			color:white;
			margin:0;
			text-transform: uppercase;
			font-size: 24px;
		}

		.right-section {
			margin:40px 0;
		}

		.right-section h2 {
			font-size:20px;
			color:#D1BF15;
			font-weight: 600;
			margin:0;
			text-transform: uppercase;
		}

		.right-section p {
			font-size:16px;
			color:white;
			margin:0;
		    word-break: break-all;
		}

		/*Project DIV CSS*/

		.project-div {
			margin: 10px 0;
		}

		#projects button{
			float:right;
			margin:10px;
		}

		.margin-tab {
			margin: 5px 0;
		}

		#skills button {
			float:right;
			margin:10px;
		}

		/*Work DIV CSS*/
		.work-div {
			margin: 10px 0;
		}
		#work button {
			float:right;
			margin:10px;
		}

		.work-title {
			float:left;
		}

		.work-period {
			float:right;
		}

		.work-period span {
			color:white;
		}

		.work-company {
			float:left;
		}

		.work-info {
			font-style: italic;
		}

		/*Education div CSS*/

		.school-div {
			margin: 10px 0;
		}
		#education button {
			float:right;
			margin:10px;
		}

		.school-title {
			float:left;
		}

		.school-period {
			float:right;
		}

		.school-period span {
			color:white;
		}

		.school-degree {
			float:left;
		}

		ul {
			list-style: none
		}

		li::before {
			content: "•"; color: #D1BF15;
  			width: 10px;
  			float:left;
 			 margin-left: -1em
		}
	</style>
</head>
	<div id="content">
		<div id="leftColumn" class="container col-sm-4">
			
		</div>
		<div id="rightColumn" class="container col-sm-8">

			<div class="container-fluid" style="padding:100px 30px 0 30px;">
				<h1 class="resume-name " editable-text="user.name"><% user.name || 'Add A Name'%></h1>
				<h2 class="resume-title" editable-text="user.title"><%user.title || 'A Title'%></h2>
				<div class="right-section">
					<h2>Profile</h2>
					<p editable-textarea="user.summary" e-cols='40' e-rows="7" ><%user.summary || 'Enter a summary...'%></p>
				</div>
				<div class="right-section" id="projects">
					<h2>Projects</h2>
					<div ng-repeat="project in user.projects track by $index" class="container-fluid project-div">
						<p editable-textarea="project.info" class="margin-tab" e-cols='40' e-rows="7"><% project.info || 'Enter a project...'%></p>
					</div>
					<div class="col-sm-12">
						<button class="btn btn-success" ng-click="addProject();">+</button>
						<button class="btn btn-danger" ng-click="removeProject();">-</button>
					</div>
				</div>
				<div class="right-section" id="education">
					<h2>Education</h2>
					<div ng-repeat="school in user.education track by $index" class="container-fluid school-div">
					    <div class="col-sm-12 margin-tab">
					    	<p class="school-title" editable-text="school.school"><% school.school || 'School Here...'%></p>
					    	<p class="school-period">
					    		<span editable-text="school.complete"><% school.complete || 'Completion Date' %></span>
					    	</p>
					    </div>
					    <div class="col-sm-12">
					    	<p class="school-degree" style="font-size: 14px;" editable-text="school.degree"><% school.degree || 'Degree...'%></p>
					    </div>
					</div>
					<div class="col-sm-12">
						<button class="btn btn-success" ng-click="addSchool();">+</button>
						<button class="btn btn-danger" ng-click="removeSchool();">-</button>
					</div>
				</div>
				<div class="right-section" id="work">
					<h2>Work Experience</h2>
					<div ng-repeat="work in user.works track by work.id" class="container-fluid work-div">
					    <div class="col-sm-12 margin-tab">
					    	<p class="work-title" editable-text="work.title"><% work.title || 'Work Title...'%></p>
					    	<p class="work-period">
					    		<span editable-text="work.start"><% (work.start | date:"MM/yyyy")|| 'Start Date'%></span>
					    		<span>&nbsp-&nbsp</span>
					    		<span editable-text="work.completed"><% (work.completed | date:"MM/yyyy") || 'End Date'%></span>
					    	</p>
					    </div>
					    <div class="col-sm-12">
					    	<p class="work-company" style="font-size: 14px;" editable-text="work.company"><% work.company || 'Work Company...'%></p>
					    </div>
					    <div class="col-sm-12 margin-tab">
				    		<p editable-textarea="work.info" class="margin-tab" e-cols='40' e-rows="7" class="work-info"><% work.info || 'Enter work experience...'%></p>
					    </div>
					</div>
					<div class="col-sm-12">
						<button class="btn btn-success" ng-click="addWork();">+</button>
						<button class="btn btn-danger" ng-click="removeWork();">-</button>
					</div>
				</div>
				<div class="right-section" id="skills">
					<h2>Skills</h2>
					<ul style="margin:0;list-style: circle;">
						<li ng-repeat="skill in user.skills track by $index" class="margin-tab">
							<p editable-text="skill"><% skill || 'New Skill...'%></p>
						</li>
					</ul>
					<div class="col-sm-12">
						<button class="btn btn-success" ng-click="addSkill();">+</button>
						<button class="btn btn-danger" ng-click="removeSkill();">-</button>
					</div>
				</div>
			</div>
		</div>
	</div>

