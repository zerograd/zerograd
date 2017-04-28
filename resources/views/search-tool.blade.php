@extends('layout.homepage-layout')

@section('title')
  Search Tool
@stop

@section('styles')
	<style>
		#profile{
			height:420px;
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

		.searchBy {
			padding:10px;
		}
		.searchBy:hover {
			background-color:#E1E1E1;
		}
		.scroll::-webkit-scrollbar {
    		width: 10px;
		}
		 
		.scroll::-webkit-scrollbar-track {
		    -webkit-box-shadow: inset 0 0 1px rgba(0,0,0,0.3);
		}
		 
		.scroll::-webkit-scrollbar-thumb {
		  background: rgba(224,224,224,0.8);
		  outline: 1px solid slategrey;
		}

		.links {
			color:black;
			font-weight: bold;
		}
	</style>
@stop

@section('content')
	@include('layout.main-layout')
		<div id="content">
			<div class="col-sm-12">	
				<div class="panel-name">
					<h2>Search</h2>
				</div>	
				<div id="profile" class="col-sm-11">
					<div class="row">
						<div class="col-sm-4 searchBy" style="text-align: center;color:black;margin: 10px 0;">Search By Company</div>
						<div class="col-sm-4 searchBy" style="text-align: center;color:black;margin: 10px 0;">Search By Industry</div>
						<div class="col-sm-4 searchBy" style="text-align: center;color:black;margin: 10px 0;">Search By School ?</div>
					</div>
					<div class="col-sm-12" style="height:350px;border:1px solid black;overflow: hidden;">
						<div class="col-sm-12" style="">
							<input id="filter" style="width:100%;margin-top:10px;color:#354886;font-weight:bold;"type="text" value="" placeholder="Filter Companies Here..." />
							<div id="no-results" class="col-sm-12" style="display:none;">
									<a href="#" >No Results found</a>
							</div>
							<div class="col-sm-12 scroll"  id="results" style="height:300px;overflow-y: scroll;">
								@foreach ($companies as $company)
									<div class="col-sm-12"  style="padding:10px;">
										<a href="#" name="{{$company->company_name}}" class="links">{{$company->company_name}}</a>
									</div>
								@endforeach
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
@stop

@section('script_plugins')
	<script type="text/javascript">
		setInterval(function(){
			if($('#filter').val().length == 0){
				var results = $('#results a');
				results.each(function(){
					$(this).parent().show();
				});
			}
		},100);
		$('#filter').keypress(function(event){
			if(event.key != 32){
				var key = event.key;
				var results = $('#results a');
				results.each(function(){
					var company = $(this)[0].name;
					var currentFilterText = $('#filter').val() + event.key;
					currentFilterText = currentFilterText.trim();
	                var trimCompany = company.substring(0,currentFilterText.length);
	                if((currentFilterText) != trimCompany){
	                	$(this).parent().hide();
	                }else{
	                	$(this).parent().show();
	                }
				});
			}
		});

	</script>
@stop