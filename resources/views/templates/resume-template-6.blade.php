
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

		#projects button{
			float:right;
			margin:10px;
		}

		.margin-tab {
			margin: 5px 0;
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
					<div ng-repeat="project in user.projects track by project.id" class="container-fluid">
						<p editable-textarea="project.info" class="margin-tab" e-cols='40' e-rows="7"><% project.info || 'Enter a project...'%></p>
					</div>
					<div class="col-sm-12">
						<button class="btn btn-success" ng-click="addProject();">+</button>
						<button class="btn btn-danger" ng-click="removeProject();">-</button>
					</div>
				</div>
				<div class="right-section">
					<h2>Skills</h2>
					<ul style="margin:0;list-style: circle;">
						<li><p>Event planning</p></li>
						<li><p>Project management</p></li>
						<li><p>Strong communication skills</p></li>
						<li><p>Fast learner</p></li>
						<li><p>Collaborative</p></li>
						<li><p>Team Player</p></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<script src="{{URL::asset('/js/bootstrap.min.js')}}"></script>

