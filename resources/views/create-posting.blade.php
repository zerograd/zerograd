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
			height:auto;
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



@section('content')
	
		@include('layout.employer-main-layout')
		<div class="container-fluid">
			<div class="col-sm-8 col-sm-offset-2 col-xs-6">
				<div id="timeline" class="col-sm-12 col-xs-12">
				<form id="create-post" action="{{route('create-posting')}}" method="POST">
				{{csrf_field()}}
					<h2>Create a Posting</h2>
					<div class="form-group">
						<label>Job Title</label>
						<input type="text" name="title" id="title" class="form-control"/>
						<label>Description</label>
						<textarea name="description" id="description" col="50" class="form-control"></textarea>
						<label>Location</label>
						<input type="text" name="location" id="location" class="form-control"/>
						
						<label>Status</label>
						<select name="status" class="form-control">
							<option value="Full-time">Full-Time</option>
							<option value="Part-time">Part-Time</option>
							<option value="Contract">Full-Time</option>
							<option value="Not Specified">Not Specified</option>
						</select>
						<label>Required Experience</label>
						<select name="required_experience" class="form-control">
							<option value="1">1 year</option>
							<option value="2">2 years</option>
							<option value="3">3 years</option>
						</select>
						<label>Salary</label>
						<input type="text" name="salary" id="salary" class="form-control"/>
						<label>Show Salary</label>
						<label class="custom-control custom-radio">
						  <input id="radio1" name="showSalary" type="radio" class="custom-control-input" value="yes">
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">Yes</span>
						</label>
						<label class="custom-control custom-radio">
						  <input id="radio2" name="showSalary" type="radio" class="custom-control-input" value="no">
						  <span class="custom-control-indicator"></span>
						  <span class="custom-control-description">No</span>
						</label>
					</div>
					<div class="col-sm-12" style="padding:10px;">
						<button class="btn btn-info" style="float:right;" type="submit">Create Posting</button>
					</div>

					@if(Session::has('employer_id'))
					<input type="text" name="company_id" value="{{Session::get('employer_id')}}" hidden>
					@endif
				</form>
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