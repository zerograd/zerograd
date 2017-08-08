@extends('layout.newthemelayout')

@section('title')
	<title>ZeroGrad: Editing Mode</title>
@stop


@section('content')

<!-- Titlebar
================================================== -->
<div id="titlebar">
	<div class="container remodal-bg">
		<div class="ten columns">
			<span><a>Settings</a></span>
		</div>

		<div class="six columns">
			
		</div>

	</div>
</div>


<!-- Content
================================================== -->
<div class="container remodal-bg">
	
	<!-- Recent Jobs -->
	<div class="eleven columns">
	<div class="padding-right">
		
		<!-- Company Info -->
		<div class="company-info">
			<img src="{{$path}}" alt="">
			<div class="content">
				<h4 editable-text="user.name"><% user.name || "Add a name" %></h4>

				
				<span><a href="http://{{$student->website}}" target="_blank" editable-text="user.website"><i class="fa fa-at" aria-hidden="true"></i> <% user.website || "No site" %></a></span>
				<span><a href="mailto:{{$student->email}}"><i class="fa fa-envelope" aria-hidden="true"></i>&nbspContact</a></span>
			</div>
			<div class="clearfix"></div>
		</div>

		

		<br>
		<p>Summary:</p>

		<p editable-textarea="user.summary" e-rows="7" e-cols="40"><% user.summary || "Add a Description"%></p>
		
		<br>

		<h4 class="margin-bottom-10">Skills</h4>

		<ul class="list-1">
				<li editable-text="user.skills" style="display: inline-block;"><% user.skills || "Add Skills"%> (Seperate Skills By Commas)</li>
		</ul>

	</div>
	</div>




	<button type="button" class="btn btn-success" style="float:right;" ng-click="updateProfile();">Save Profile</button>


</div>


@stop

@section('script_plugins')

<!-- Angular code for this page -->
	<script type="text/javascript">

		
		
		
	</script>
@stop