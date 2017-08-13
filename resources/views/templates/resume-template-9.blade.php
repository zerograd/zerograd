
<head>
	<style type="text/css">
		html,body{
			width:100%;
			height:100%;
			padding: 0;
			margin: 0;
		}

		#header{
			height:40%;
			background: url('{{URL::asset('/images/banner-home-01.jpg')}}');
			background-size: 100% 100%;
			text-align: center;
			padding: 20px 50px;
		}

		#header h3 {
			color:white;
			font-size: 24px;
			text-transform: uppercase;

		}

		.name-div{
			border: 5px solid #E4C642;
			margin: 0 auto;
			padding: 10px;
			color:#E4C642;
			width:500px;
		}

		.name-div h2 {
			font-size: 50px;
			font-weight: 600;
			text-transform: uppercase;
		}

		#mainArea{
			position: relative;
			height:100%;
			padding-bottom: 20px;
		}

		#leftColumn,#rightColumn{
			/*height: auto;*/
			height:100%;
		}

		#leftColumn {
			background-color: #e6e6e6;
		}

		#rightColum {
			padding: 30px 0;
		}

		.container-fluid {
			padding: 0;
		}

		.image-container {
			text-align: center;
			height:150px;
			padding: 20px;
		}

		.image-container img {
			margin:0 auto;
			height:100%;
			width:150px;
			border-radius: 50%;
		}


		.left-section{
			min-height: 150px;
			padding: 0 20px;
		}

		.left-section p {
			word-wrap: break-word;
			color:black;
			font-weight:600;
			font-size: 16px;
		}

		.left-section span {
			display: block;
			font-weight:500;
			font-size: 16px;
		}

		.left-section i {
			color:#E4C642;
			margin-right: 20px;
			font-size: 16px;
		}

		.left-title {
			text-transform: uppercase;
			color:black;
			border-bottom: 3px solid black;
			font-size: 26px;
			font-weight: 600;
		}

		.right-section {
			min-height: 150px;
			padding: 39px 20px;
		}

		.right-section li {
			margin: 5px 0;
		}
		.right-section li p{
			color:black;
			font-size: 20px;
			font-weight: 500;
		}

		.right-title {
			text-transform: uppercase;
			color:#E4C642;
			border-bottom: 3px solid #e6e6e6;
			font-size: 26px;
			font-weight: 600;
		}

		#footer {
			position: absolute;
			bottom:0;
			width:100%;
			height:20px;
			background-color:#E4C642;
		}

	</style>
</head>

		
		<div id="header" class="container-fluid">
			<div class="name-div">
				<h2>Kyle Wilson-McCormack</h2>
			</div>
			<h3>Web Developer</h3>
		</div>
		<div id="mainArea" class="container-fluid">
			<div id="leftColumn" class="col-sm-4">
				<div class="container-fluid image-container">
					<img class="img-responsive" src="{{URL::asset('/images/flower.jpg')}}">
				</div>
				<div class="left-section">
					<h4 class="left-title">Profile</h4>
					<p>Hi I am a great web developer.</p>
				</div>
				<div class="left-section">
					<h4 class="left-title">Contact</h4>
					<p>Toronto,Ontario</p>
					<span><i class="fa fa-phone-square" aria-hidden="true"></i>4145554567</span>
					<span><i class="fa fa-globe" aria-hidden="true"></i>kylewilsonmccormack.com</span>
					<span><i class="fa fa-envelope" aria-hidden="true"></i>kyle.wilsonmccormack@gmail.com</span>
				</div>
			</div>

			<div id="rightColumn" class="col-sm-8">
				<div class="right-section">
					<h4 class="right-title">Area of Expertise and Skills</h4>
					<ul>
						<li><p>Web Developement Tools</p></li>
					</ul>
				</div>
				<div class="right-section">
					<h4 class="right-title">Experience</h4>
				</div>
				<div class="right-section">
					<h4 class="right-title">Projects</h4>
					<ul>
						<li><p>Web Developement Tools</p></li>
					</ul>
				</div>
				<div class="right-section">
					<h4 class="right-title">Education</h4>
				</div>
			</div>

			<div id="footer">
				
			</div>
		</div>



