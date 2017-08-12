
<head>



	<style type="text/css">
		html,body{
			width:100%;
			height:100%;
			padding: 0;
			margin: 0;
		}
		#content{
			width: 100%;
			height:100%;
			padding: 20px;
		}

		/*CSS Styling*/

		#view {
			border-top:20px solid #16a085;
			border-bottom:20px solid #16a085;
			height:auto;
		}
		.title-div{
			padding:30px;
		}

		.title-div-image {
			text-align: center;
		}
		.title-div-image img {
			width:150px;
			height:150px;
			margin: 0 auto;
			border-radius: 50%;
		}

		.name-info h2, .name-info h3, .name-info h4{
			color:black;
			text-transform: uppercase;
			font-size: 48px;
			margin:0;
			font-family: 'Raleway', sans-serif;
			font-weight: 600;
		}

		.name-info h3{
			color:#16a085;
		}

		.name-info h4{
			font-size: 32px;
		}

		.contact-info p {
			color:black;
			float:right;
			width:100%;
			margin:5px 0;
			font-weight: 600;
			font-family: 'Raleway', sans-serif;
		}

		/*Section CSS*/

		.section {
			min-height: 200px;
			width:100%;
			padding-left: 180px;
			padding-top:30px;
			padding-bottom: 30px;
		}

		.section-title {
			color:black;
			text-transform: uppercase;
			float:right;
			font-weight:500;
			margin: 0;
		}

		.section-span {
			display: inline-block;
			background-color:#16a085;
			width:100%;
			margin: 10px 0 0 0;
			height: 5px;
		}

		.section-content-title h3 {
			color:black;
			font-family: 'Raleway', sans-serif;
			font-weight:bold;
			font-size: 24px;
		}

		.section-content-title ul {
			margin:0;
		}

		.section-content-title li {
			color:black;
			font-family: 'Raleway', sans-serif;
			font-size: 16px;
			font-weight: bold;
		}

		.titles {
			width:113px;
			float:right;
		}

		.position-title h3, .project-title h3{
			display:block;
			float:right;
			color:#16a085;
			font-weight: bold;
			font-size: 20px;
			text-transform: uppercase;
			word-wrap: break-word;
		}

		.summary {
			word-wrap: break-word;
		}
	</style>
</head>

	<div id="content">
		<div id="view" class="container-fluid">
			<div class="title-div container-fluid">
				<div class="title-div-image col-sm-2">
					<img class="img-responsive" src="{{URL::asset('/images/avatar-placeholder.png')}}">
				</div>
				<div class="title-div-info col-sm-10">
					<div class="name-info col-sm-6">
						<h2 editable-text="user.first_name"><% user.first_name || 'First Name..'%></h2>
						<h3 editable-text="user.last_name"><% user.last_name || 'Last Name..'%></h3>
						<h4 editable-text="user.title"><% user.title || 'Title..'%></h4>
					</div>
					<div class="contact-info col-sm-6">
						<p editable-text="user.phone"><% user.phone || 'City..'%></p>
						<p editable-text="user.email"><% user.email || 'Email..'%></p>
						<p editable-text="user.city"><% user.city || 'City..'%></p>
					</div>
				</div>
			</div>

			<!-- Profile -->
			<div class="section">
				<div class="col-sm-2">
					<h2 class="section-title">Profile</h2>
				</div>
				<div class="col-sm-10">
					<span class="section-span"></span>
				</div>
				<div class="col-sm-12">
					<div class="col-sm-2">
					
					</div>
					<div class="col-sm-7 container-fluid">
						<p class="summary" editable-textarea="user.summary"><%user.summary || 'Summary..'%></p>
					</div>
				</div>
			</div>
			<!-- Experience -->
			<div class="section">
				<div class="col-sm-2">
					<h2 class="section-title">Experience</h2>
				</div>
				<div class="col-sm-10">
					<span class="section-span"></span>
				</div>
				<div class="col-sm-12">
					<div class="col-sm-2 position-title">
						<div class="titles">
							<h3>Operations Associate</h3>
						</div>
					</div>
					<div class="col-sm-7 section-content-title">
						<h3>Heritage Education Funds</h3>
						<ul>
							<li>Test</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- Skills -->
			<div class="section">
				<div class="col-sm-2">
					<h2 class="section-title">Skills</h2>
				</div>
				<div class="col-sm-10">
					<span class="section-span"></span>
				</div>
				<div class="col-sm-12">
					<div class="col-sm-2">
					
					</div>
					<div class="col-sm-7 section-content-title">
						<br>
						<ul>
							<li>Test</li>
						</ul>
					</div>
				</div>
			</div>

			<!-- Education -->
			<div class="section">
				<div class="col-sm-2">
					<h2 class="section-title">Education</h2>
				</div>
				<div class="col-sm-10">
					<span class="section-span"></span>
				</div>
				<div class="col-sm-12">
					<div class="col-sm-2 project-title">
						<div class="titles">
							
						</div>
					</div>
					<div class="col-sm-7  section-content-title">
						<h3>Heritage Education Funds</h3>
						<ul>
							<li>Test</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>


