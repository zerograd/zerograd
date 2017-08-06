
@if($numberOfResults > 0)

@foreach($postings as $posting)
	@if($posting)
	<li><a href="{{route('get-posting',$posting->id)}}" target="_blank" onClick="seen();">
				<img src="{{URL::asset('/images/job-list-logo-01.png')}}" alt="">
				<div class="job-list-content">
					<h4>{{$posting->title}}</h4>
					<div class="job-icons">
						<span style="text-transform: capitalize;"><i class="fa fa-briefcase"></i>{{$posting->company}}</span>
						<span><i class="fa fa-map-marker"></i>{{$posting->location}}</span>
						<?php 
							$date = date_create($posting->posted_date);
							$formattedDate = date_format($date,'F d, Y');
						?>
						<span><i class="fa fa-calendar" aria-hidden="true"></i></i>{{$formattedDate}}</span>
					</div>
					<p>{{$posting->description}}</p>
				</div>
				</a>
				<div class="clearfix"></div>
	</li>
	@endif
@endforeach

<div class="pagination-container">
			@include('pagination')
</div>

@else
	<span style="color:black;font-weight: 600;">No Results were found.</span>
@endif