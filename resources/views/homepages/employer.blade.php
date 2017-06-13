@extends('layout.homepage-layout')

@section('title')
	Home
@stop

@section('styles')
	<style>

		#recent-search-panel{
			height:auto;
			background-color: white;
			border-top:5px solid #133BB6;
			margin:10px 0;
			padding:5px;
		}
		#recent-search-panel h2{
			margin:10px 0;
			color:black;
			font-weight:500;
		}
		#recent-search-panel h4{
			margin:10px 0;
			color:black;
			font-weight:500;
			text-align: center;
		}

		#timeline{
			height:400px;
			background-color: white;
			border-top:5px solid #D7D131;
			margin:10px 0;
		}

		#timeline h2{
			margin:10px 0;
			color:black;
			font-weight:500;
		}
		
		#profile-completion{
			height:auto;
			background-color: white;
			border-top:5px solid #13B662;
			margin:10px 0;
			padding: 5px;

		}

		#searches {
			height:auto;
			background-color: white;
			border-top:5px solid #108EE3;
			margin:10px 0;
			padding: 5px;
			min-height: 200px;
		}

		#searches h2{
			margin:10px 0;
			color:black;
			font-weight:500;
		}

		#opportunities {
			height:auto;
			background-color: white;
			border-top:5px solid #E34010;
			margin:10px 0;
			padding: 5px;
			min-height: 200px;
		}

		#opportunities h2{
			margin:10px 0;
			color:black;
			font-weight:500;
		}
		#opportunities p {
			color:black;
			font-weight: bold;
		}

		#profile-completion h2{
			margin:10px 0;
			color:black;
			font-weight:500;
		}

		#profile-completion > div{
			margin:10px;
		}


		@media (max-width: 768px) {
			h2{
				font-size:24px;
			}
		}

		#searches p {
			color:black;
			font-weight: bold;
		}
		#who-applied img {
			width:50px;
			height:50px;
		}
	</style>
@stop

@section('style_plugins')
	{{ HTML::style('css/employer-home-responsive.css') }}
@stop




@section('content')
	
		@include('layout.employer-main-layout')
		<div class="container-fluid">
			<div class="col-sm-7 col-xs-12">
				<div id="who-applied" class="col-sm-12 col-xs-12">
					<h2>Who Applied?</h2>
					<div class="container-fluid">
						@foreach($whoApplied as $student)
							<div class="row">
								<div class="col-xs-12" style="text-align: center;">
									<a href="{{route('public-profile',$student->student_id)}}" style="text-decoration: none;color:white"><img src="<?php echo asset("storage/avatars/$student->avatar")?>"> 
									<h3>{{$student->student_name}}</h3></a>
									<p>Applied for: <a href="{{route('posting-get',['title'=> $student->title,'id'=> $student->id])}}">{{$student->title}}</a></p> 
									<p>Skills: {{$student->skills}}</p> 
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>
			<div class="col-sm-5 col-xs-12">
				<div id="profile-completion" class="col-sm-12 col-xs-12">
					<h2>List of Postings</h2>
					<ul style="list-style: none;padding:0;margin:0;">
						@foreach($postings as $posting)
							<li style="padding:20px;">
								<p style="color:black;font-weight: bold;">Job Title : {{$posting->title}}</p>
								<p style="color:black;font-weight: bold;">Posted: {{$posting->posted_date}}</p>
							</li>
						@endforeach
					</ul>
					<a href="#"><p style="float:right;color: black;font-weight: bold;">View all postings</p></a>
				</div>
			</div>
		</div>
@stop

@section('script_plugins')

	<script>
	var data = {
    datasets: [
        {
            data: [70,30],
            backgroundColor: [
                "#77C85E",
                '#FFFFFF'
            ],
            hoverBackgroundColor: [
                "#77C85E",
                '#FFFFFF'
            ]
        }]
	};

	var ctx = $('#doughnutChart').get(0).getContext('2d');

	var myDoughnutChart = new Chart(ctx, {
	    type: 'doughnut',
	    data: data,
	    options: {
	    	cutoutPercentage : 50,
	    	responsive:true,
	    	maintainAspectRatio: true,
	    	tooltips: {
            enabled: false
         }
	    }
	});

	Chart.pluginService.register({
  beforeDraw: function(chart) {
    var width = chart.chart.width,
        height = chart.chart.height,
        ctx = chart.chart.ctx;

    ctx.restore();
    var fontSize = (height / 114).toFixed(2);
    ctx.font = fontSize + "em sans-serif";
    ctx.textBaseline = "middle";

    var text = "70%",
        textX = Math.round((width - ctx.measureText(text).width) / 2),
        textY = height / 2;

    ctx.fillText(text, textX, textY);
    ctx.save();
  }
});
	
	</script>
@stop