@extends('layout.newthemelayout')

@section('title')
	<title>Browse Jobs</title>
@stop

@section('styles')
	<style type="text/css">
		.loader {
            border: 16px solid #f3f3f3; /* Light grey */
            border-top: 16px solid #26ae61; /* Blue */
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .pagination a {
    color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    transition: background-color .3s;
}

.pagination a.active {
    background-color: #4CAF50;
    color: white;
}

.pagination a:hover:not(.active) {background-color: #ddd;}
	</style>
@stop

@section('content')
<!-- Titlebar
================================================== -->
<div id="titlebar">
	<div class="container">
		<div class="ten columns">
			@if (isset($keywords) and $keywords != 'None')
				<span id="browse-title">We found {{$numberOfResults}} jobs matching:</span>
				<h2 id="keywords-title">{{$keywords}}</h2>

			@else
				<span id="browse-title">Browse 15000+ jobs</span>
				<h2 id="keywords-title"></h2>
			@endif
		</div>

		<div class="six columns">
			<a href="{{URL::to('employer/myaccount')}}#tab2" class="button">Post a Job, It’s Free!</a>
		</div>

	</div>
</div>


<!-- Content
================================================== -->
<div class="container">
	<!-- Recent Jobs -->
	<div class="ten columns">
	<div class="padding-right">
		
		<form action="#" method="get" class="list-search">
			<button type="button" onclick="filter();"><i class="fa fa-search"></i></button>
			<input type="text"  id="keywords" placeholder="job title or keywords" @if($keywords != 'None') value="{{$keywords}}" @else value="" @endif name="keywords"/>
			<div class="clearfix"></div>
		</form>

		<ul id="results" class="job-list full">
			@include('sub-results')
		</ul>
		<div class="clearfix"></div>

		

	</div>
	</div>


	<!-- Widgets -->
	<div class="five columns">

		<!-- Sort by -->
		<div class="widget">
			<h4>Sort by</h4>

			<!-- Select -->
			<form id="category-form">
			<select data-placeholder="Choose Category" name="category" class="chosen-select-no-single">
				<option value="recent">Newest</option>
				<option value="">Relevance</option>
			</select>
			</form>

		</div>

		<!-- Location -->
		<div class="widget">
			<h4>Location</h4>
			<form id="location-form" action="#" method="post">
				<input type="text" name="location" placeholder="City" @if(isset($location) and $location != '') value="{{$location}}" @endif/>

				
					<input type="number" class="from" placeholder="Radius" name="kilometers" value=""/>
				
				
				<!-- <input type="text" id="zip-code" class="zip-code" placeholder="Postal Code" name="zipcode" value=""/><br> -->

				<button class="button" type="button" onClick="filter();" style="color:white;">Filter</button>
			</form>
		</div>

		<!-- Job Type -->
		<div class="widget">
			<h4>Job Type</h4>

			<ul class="checkboxes">
				<form id="job-type-form">
					<li>
						<input id="check-1" type="checkbox" name="type-0" value="<required>" checked>
						<label for="check-1">Any Type</label>
					</li>
					<li>
						<input id="check-2" type="checkbox" name="type-1" value="fulltime">
						<label for="check-2">Full-Time</label>
					</li>
					<li>
						<input id="check-3" type="checkbox" name="type-2" value="parttime">
						<label for="check-3">Part-Time</label>
					</li>
					<li>
						<input id="check-4" type="checkbox" name="type-3" value="internship">
						<label for="check-4">Internship</label>
					</li>
				</form>
			</ul>

		</div>

		<!-- Years of Experience -->
		<!-- <div class="widget">
			<h4>Years Of Experience</h4>

			<ul class="checkboxes">
				<form id="level-form">
					<li>
						<input id="check-10" type="checkbox" name="level-0" value="Any" checked>
						<label for="check-10">Any</label>
					</li>
					<li>
						<input id="check-20" type="checkbox" name="level-1" value="1">
						<label for="check-20">1 Year</label>
					</li>
					<li>
						<input id="check-30" type="checkbox" name="level-2" value="2">
						<label for="check-30">2 years</label>
					</li>
					<li>
						<input id="check-40" type="checkbox" name="level-3" value="3">
						<label for="check-40">3 years</label>
					</li>
				</form>
			</ul>

		</div> -->

		<!-- Rate/Hr -->

		<!-- <div class="widget">
			<h4>Rate / Hr</h4>

			<ul class="checkboxes">
				<li>
					<input id="check-6" type="checkbox" name="check" value="check-6" checked>
					<label for="check-6">Any Rate</label>
				</li>
				<li>
					<input id="check-7" type="checkbox" name="check" value="check-7">
					<label for="check-7">$0 - $25 <span>(231)</span></label>
				</li>
				<li>
					<input id="check-8" type="checkbox" name="check" value="check-8">
					<label for="check-8">$25 - $50 <span>(297)</span></label>
				</li>
				<li>
					<input id="check-9" type="checkbox" name="check" value="check-9">
					<label for="check-9">$50 - $100 <span>(78)</span></label>
				</li>
				<li>
					<input id="check-10" type="checkbox" name="check" value="check-10">
					<label for="check-10">$100 - $200 <span>(98)</span></label>
				</li>
				<li>
					<input id="check-11" type="checkbox" name="check" value="check-11">
					<label for="check-11">$200+ <span>(21)</span></label>
				</li>
			</ul>

		</div> -->



	</div>
	<!-- Widgets / End -->


</div>

<input type="hidden" name="page" id="page" value="{{$page}}">
@stop

@section('script_plugins')
	<script type="text/javascript">
		function seen(){
			$.post("{{route('seen')}}",{_token:"{{csrf_token()}}"},function(data){

			});
		}
		function pagination(page){
			$('#page').val(page);
			var categoryForm = $('#category-form').serialize();
			var locationForm = $('#location-form').serialize();
			var jobTypeForm = $('#job-type-form').serialize(); 
			var levelForm = $('#level-form').serialize();
			var keywords  = $('#keywords').val();
			
			var data = categoryForm +'&'+ locationForm +'&'+ jobTypeForm +'&'+ levelForm + '&_token={{csrf_token()}}' + '&keywords=' + keywords + '&page=' + page; 
			$.post('{{route('job-pagination')}}',data,function(data){
				if(keywords){
					$('#keywords-title').text(keywords);
				}
				$('#browse-title').text('We found ' + data.numberOfResults +' jobs matching:');
				$('#results').html(data.view);
			});
		}
		function filter(){
			$('#results').html('<div class="loader" style="display:none;margin:0 auto;"></div>');
			$('.loader').show();
			var categoryForm = $('#category-form').serialize();
			var locationForm = $('#location-form').serialize();
			var jobTypeForm = $('#job-type-form').serialize(); 
			var levelForm = $('#level-form').serialize();
			var keywords  = $('#keywords').val();
			
			var data = categoryForm +'&'+ locationForm +'&'+ jobTypeForm +'&'+ levelForm + '&_token={{csrf_token()}}' + '&keywords=' + keywords; 
			$.post('{{route('api-filter')}}',data,function(data){
				$('.loader').hide();
				if(keywords){
					$('#keywords-title').text(keywords);
				}
				$('#browse-title').text('We found ' + data.numberOfResults +' jobs matching:');
				$('#results').html(data.view);
			});
		}
	</script>
@stop