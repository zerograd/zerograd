@extends('layout.header-layout')

@section('title')
	Resume Builder
@stop

@section('styles')
	<style type="text/css">
		body{
			background-color: #3C9865;
			color:black;
		}
		.scroll::-webkit-scrollbar {
    		width: 12px;
		}

		.scroll::-webkit-scrollbar-track {
		    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
		    border-radius: 10px;
		}

		.scroll::-webkit-scrollbar-thumb {
		    border-radius: 10px;
		    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5); 
		}

		.scroll::-webkit-scrollbar-corner {
			background:none;
		}

		#template-section{
			background:rgba(0,0,0,0.5);
			height:100%;
		}

		#resume-section{
			padding: 20px;
			height:100%;
		}

		#inner-resume-section-1{
			background-color: #fff;
			height:100%;
			max-height: 700px;
			overflow-y: scroll;
			box-shadow: 5px 5px 5px #000;
			padding: 0;
		}

		#logo-header{
			text-align: center;
			padding: 10px;
		}

		#logo-header img{
			margin: 0 auto;
		}

		#filter {
			text-align: center;
			color:white;
		}
		#filter > select {
			color:black;
			font-weight: bold;
		}
		#filter > select > option {
			color:black;
			font-weight: bold;
		}
		
	</style>
@stop

@section('content')
	<div class="col-sm-3 scroll" id="template-section">
		<div id="logo-header" class="col-sm-12">
			<img src="{{URL::asset('theme/images/logo2.png')}}" alt="Work Scout" />
		</div>
		<div class="col-sm-12 form-group" id="filter">
			<label>Choose your resume template</label>
			<select class="form-control">
				<option value="general">General</option>
				<option value="professional">Professional</option>
				<option value="artsy">Artsy</option>
			</select>
		</div>
		<div class="col-sm-12">
			@foreach($templates as $template)
				<div class="col-sm-6 template-div">
					<img src='{{URL::asset("images/templates/$template->template_number.png")}}' class="img-responsive {{$template->template_category}}">
				</div>
			@endforeach
		</div>
	</div>
	<div class="col-sm-9 scroll" id="resume-section">
		<div class="col-sm-8 col-sm-offset-2 scroll" id="inner-resume-section-1">
			@include('templates.resume-template-6')
		</div>
	</div>
@stop

 @section('script_plugins')
 	<script type="text/javascript">
 	
 	</script>
 @stop