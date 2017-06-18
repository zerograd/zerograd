@extends('layout.homepage-layout')

@section('title')
	Edit Profile
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

		label,input,textarea {
			color:black;
			font-weight: bold;
		}

		select,option {
			color:black;
			font-weight: bold;
		}
	</style>
@stop

@section('style_plugins')
	{{ HTML::style('css/employer-home-responsive.css') }}
@stop


@section('content')
	
		@include('homepages.employer-panel')
		<div class="col-lg-9 col-xs-12" id="main-area">
			@include('layout.employer-main-layout')
			<div class="container-fluid">
				<div class="col-sm-8 col-sm-offset-2 col-xs-12">
					<div id="profile" class="col-sm-12 col-xs-12">
					<form id="create-post" action="{{route('update-company-profile')}}" method="POST">
					{{csrf_field()}}
							<h2>Edit Profile</h2>
						@if(isset($profileInfo))
							<div class="form-group">
								<label>Company Name</label>
								<input type="text" name="company_name" id="company_name" class="form-control" value="{{$profileInfo->company_name}}" />
								<label>Company Overview</label>
								<textarea name="company_overview" id="company_overview" col="50" class="form-control">{{$profileInfo->company_overview}}</textarea>
								<label>Company Location</label>
								<input type="text" name="company_location" id="company_location" class="form-control" value="{{$profileInfo->company_location}}" />
							</div>
						@endif
						<div class="col-sm-12" style="padding:10px;">
							<button class="btn btn-info" style="float:right;" type="submit">Update Profile</button>
						</div>
						
					</form>
					</div>
				</div>
			</div>

		</div>
		<input id="employer-id" type="text" value="{{$id}}" hidden>
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