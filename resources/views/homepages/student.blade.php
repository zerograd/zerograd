@extends('layout.homepage-layout')

@section('title')
	Home
@stop

@section('styles')
	<style>

	</style>
@stop



@section('content')
	 
		@include('layout.main-layout')
		<div class="container-fluid">
			<div class="col-sm-6" style="height:90%;">
				<h1 style="color:black;">Timeline</h1>
			</div>
			<div class="col-sm-5" style="height:90%;">
				<h2 style="color:black;">Recommended Jobs</h2>
				@if(sizeof($opportunities) > 0)
					@foreach ($opportunities as $oppor)
						<div class="recommended-job" style="height: 300px;background-color:grey;">
							<div class="col-sm-12" style="height:100%;background: rgba(0,0,0,0.6);padding: 40px;">
								<h3>{{$oppor->title}}</h3>
								<p>{{$oppor->keywords}}</p>
								<p>{{$oppor->posted_date}}</p>
							</div>
						</div>
					@endforeach
				@else
					<h3>No new Jobs</h3>
				@endif
			</div>
		</div>
@stop

@section('script_plugins')

	<script>
// 	var data = {
//     datasets: [
//         {
//             data: [70,30],
//             backgroundColor: [
//                 "#77C85E",
//                 '#FFFFFF'
//             ],
//             hoverBackgroundColor: [
//                 "#77C85E",
//                 '#FFFFFF'
//             ]
//         }]
// 	};

// 	var ctx = $('#doughnutChart').get(0).getContext('2d');

// 	var myDoughnutChart = new Chart(ctx, {
// 	    type: 'doughnut',
// 	    data: data,
// 	    options: {
// 	    	cutoutPercentage : 50,
// 	    	responsive:true,
// 	    	maintainAspectRatio: true,
// 	    	tooltips: {
//             enabled: false
//          }
// 	    }
// 	});

// 	Chart.pluginService.register({
//   beforeDraw: function(chart) {
//     var width = chart.chart.width,
//         height = chart.chart.height,
//         ctx = chart.chart.ctx;

//     ctx.restore();
//     var fontSize = (height / 114).toFixed(2);
//     ctx.font = fontSize + "em sans-serif";
//     ctx.textBaseline = "middle";

//     var text = "70%",
//         textX = Math.round((width - ctx.measureText(text).width) / 2),
//         textY = height / 2;

//     ctx.fillText(text, textX, textY);
//     ctx.save();
//   }
// });
	
	</script>
@stop