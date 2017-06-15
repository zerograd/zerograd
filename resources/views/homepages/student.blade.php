@extends('layout.homepage-layout')

@section('title')
	Home
@stop

@section('styles')
	<style>
	
	</style>
@stop

@section('style_plugins')
	{{ HTML::style('css/student-home-responsive.css') }}
@stop



@section('content')
	 
		@include('homepages.student-panel')
		<div class="col-lg-9" id="main-area">
			@include('layout.main-layout')
			<div class="container-fluid" style="height:100%;">
				<!-- <div class="col-sm-9 col-xs-12" style="height:90%;">
					<h1 style="color:black;">Timeline</h1>
					<div id="timeline" class="col-sm-12 col-xs-12">
						<div class="col-sm-12 col-xs-12 scroll">

						</div>
					</div>
				</div> -->
				<div class="col-sm-12 col-xs-12">
					<h2 id="recommend-job-header" style="color:black;">Recommended Jobs</h2>
					@if(sizeof($opportunities) > 0)
						@foreach ($opportunities as $oppor)
							<div class="recommended-job">
								<div class="col-sm-12">
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
				<div class="col-sm-12 col-xs-12">
					<h2 id="applied-job-header" style="color:black;">Applied Jobs</h2>
					@if(sizeof($appliedTo) > 0)
						@foreach ($appliedTo as $job)
							<div class="applied-job">
								<div class="col-sm-12">
									<h3>{{$job->title}}</h3>
									<p>At</p>
									<p>{{$job->company_name}}</p>
									<?php
										$date=date_create($job->created);
										$date= date_format($date,"F dS Y");
									?>
									<p>On &nbsp {{$date}}</p>
								</div>
							</div>
						@endforeach
					@else
						<h3>No applied Jobs,<span><a href="{{URL::to('/')}}">Start Applying to Job</span></a></h3>
					@endif
				</div>
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