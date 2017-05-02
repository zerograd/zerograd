@extends('layout.homepage-layout')

@section('title')
	Profile
@stop

@section('styles')
	<style>
		#profile{
			height:400px;
			background-color: white;
			margin:0 50px;

		}
		.panel-name{
			display:inline-block;
			background-color: white;
			border-top:5px solid #13B662;
			margin:0 50px;
			margin-top: 10px;
			padding:5px 25px;
		}
		.panel-name h2{
			margin:10px 0;
			color:black;
			font-weight:500;
		}
	</style>
@stop

@section('content')
	@include('layout.main-layout')
		<div id="content">
			<div class="col-sm-12">	
				<div class="panel-name">
					<h2>Profile</h2>
				</div>	
				<div id="profile" class="col-sm-11">
					
				</div>
			</div>
		</div>
@stop