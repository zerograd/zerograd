@extends('layout.newthemelayout')

@section('title')
	<title>Manage Jobs</title>
@stop

@section('content')
<!-- Titlebar
================================================== -->
<div id="titlebar" class="single">
	<div class="container">

		<div class="sixteen columns">
			<h2>Manage Jobs</h2>
			<nav id="breadcrumbs">
				<ul>
					<li>You are here:</li>
					<li><a href="#">Home</a></li>
					<li>Job Dashboard</li>
				</ul>
			</nav>
		</div>

	</div>
</div>


<!-- Content
================================================== -->
<div class="container">
	
	<!-- Table -->
	<div class="sixteen columns">

		<p class="margin-bottom-25">Your listings are shown in the table below. Expired listings will be automatically removed after 30 days.</p>

		<table class="manage-table responsive-table">

			<tr>
				<th><i class="fa fa-file-text"></i> Title</th>
				<th><i class="fa fa-check-square-o"></i> Filled?</th>
				<th><i class="fa fa-calendar"></i> Date Posted</th>
				<th><i class="fa fa-calendar"></i> Date Expires</th>
				<th><i class="fa fa-user"></i> Applications</th>
				<th></th>
			</tr>
			
			@foreach($postings as $post)		
			<tr id="tr-{{$post->id}}">
				<td class="title"><a href="#">{{$post->title}}</a></td>

				@if($post->filled == 'no')
				<td class="centered" id="filled-{{$post->id}}">-</td>
				@else
				<td class="centered" id="filled-{{$post->id}}"><i class="fa fa-check"></i></td>
				@endif

				<!-- Format the dates -->
				<?php
				$date = date_create($post->posted_date);
				$posted_date = date_format($date, 'F d,Y');
				$date = date_create($post->closing_date);
				$closing_date = date_format($date, 'F d,Y');
				?>
				<td>{{$posted_date}}</td>
				<td>{{$closing_date}}</td>
				<td class="centered"><a href="{{route('manage-applications',$post->id)}}" class="button">Show ({{getCount($post->id,$appliedIDs)}})</a></td>
				<td class="action">
					<a href="#"><i class="fa fa-pencil"></i> Edit</a>
					@if($post->filled == 'no')
					<a id="filled-button-{{$post->id}}" href="javascript:markFilled(this,{{$post->id}},'mark');"><i class="fa  fa-check "></i> Mark Filled</a>
					@else
					<a id="filled-button-{{$post->id}}" href="javascript:unmark(this,{{$post->id}},'unmark');">Unmark</a>
					@endif
					
					<a href="javascript:deleteJob('{{$post->id}}');" class="delete"><i class="fa fa-remove"></i> Delete</a>
				</td>
			</tr>
			@endforeach
					
			<!-- Item #2 -->
			<!-- <tr>
				<td class="title"><a href="#">Web Developer - Front End Web Development, Relational Databases</a></td>
				<td class="centered">-</td>
				<td>September 30, 2015</td>
				<td>October 10, 2015</td>
				<td class="centered"><a href="manage-applications.html" class="button">Show (4)</a></td>
				<td class="action">
					<a href="#"><i class="fa fa-pencil"></i> Edit</a>
					<a href="#"><i class="fa  fa-check "></i> Mark Filled</a>
					<a href="#" class="delete"><i class="fa fa-remove"></i> Delete</a>
				</td>
			</tr> -->	

			<!-- Item #2 -->
			

		</table>

		<br>
		<a href="#" class="button">Add Job</a>

	</div>

</div>

@stop


@section('script_plugins')
	<script type="text/javascript">
		function markFilled(element,id,mark){
			$.post('{{route('mark-filled')}}',{id:id,_token:"{{csrf_token()}}",mark:'yes'},function(data){
				$('#filled-' + id).html('<i class="fa fa-check"></i>');
				console.log($('#filled-button-' + id));
				$('#filled-button-' + id).attr('href','javascript:unmark(this,{{$post->id}},"unmark")');
				$(element)[0].innerText = 'Unmark';
			});
		}

		function unmark(element,id,mark){
			$.post('{{route('mark-filled')}}',{id:id,_token:"{{csrf_token()}}",mark:'no'},function(data){
				$('#filled-' + id).html('-');
				console.log($('#filled-button-' + id));
				$('#filled-button-' + id).attr('href','javascript:markFilled(this,{{$post->id}},"mark")');
				$(element)[0].innerText = 'Mark Filled';
			});
		}

		function deleteJob(id){
			$.post('{{route('delete-job')}}',{id:id,_token:"{{csrf_token()}}"},function(data){
				$('#tr-'+id).fadeOut();
			});
		}
	</script>
@stop