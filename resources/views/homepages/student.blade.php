@extends('layout.homepage-layout')

@section('title')
	Home
@stop

@section('styles')
	<style>

		#recent-search-panel{
			height:150px;
			background-color: white;
			border-top:5px solid #133BB6;
			margin:10px 50px;
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
		
		#profile-completion{
			height:350px;
			background-color: white;
			border-top:5px solid #13B662;
			margin:10px 50px;

		}
		#profile-completion h2{
			margin:10px 0;
			color:black;
			font-weight:500;
		}

		#profile-completion > div{
			margin:10px;
		}
		html,body {
			height:150%;
		}



	</style>
@stop



@section('content')
	
		@include('layout.main-layout')
		<div id="content">
			<div id="recent-search-panel" class="col-sm-6">
				<h2>Recent Searches</h2>
				<h4>1. Engineering in Toronto</h4>
				<h4>2. Engineering in Detroit</h4>
				<h4>3. Engineering in California</h4>
			</div>

			<div id="profile-completion" class="col-sm-3">
				<h2>Profile Completion</h2>
				<canvas id="doughnutChart"></canvas>
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
	    	cutoutPercentage : 80,
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