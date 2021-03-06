@extends('layout.newthemelayout')

@section('title')
	<title>ZeroGrad: {{$posting->title}}</title>
@stop


@section('content')

<!-- Titlebar
================================================== -->
<div id="titlebar">
	<div class="container">
		<div class="ten columns">
			<h2>{{$posting->title}}&nbsp</h2>
		</div>

		<div class="six columns">
			@if($saved > 0)
				<a href="#" class="button dark"><i class="fa fa-star" onClick="saveJob(this);"></i>Saved</a>
			@else
				<a href="#" class="button dark"><i class="fa fa-star" onClick="saveJob(this);"></i> Bookmark This Job</a>
			@endif
		</div>

	</div>
</div>


<!-- Content
================================================== -->
<div class="container">
	
	<!-- Recent Jobs -->
	<div class="eleven columns">
	<div class="padding-right">
		
		<!-- Company Info -->
		<div class="company-info">
			<img src="{{URL::asset('images/company-logo.png')}}" alt="">
			<div class="content">
				<h4>{{$posting->company}}</h4>
			</div>
			<div class="clearfix"></div>
		</div>

		<p class="margin-reset">
			{{$posting->description}}
		</p>

		<br>
		<p>The <strong>{{$posting->title}}</strong> will have responsibilities that include:...</p>

		@if(!Session::has('user_id'))                
          <a data-remodal-target="modal" href="#" class="button">Read More!</a>
    	@else
		  <a href="{{$posting->url}}"  class="button">READ MORE</a>
		@endif
		<br>

		<!-- <h4 class="margin-bottom-10">Job Requirment</h4>

		<ul class="list-1">

		</ul> -->

	</div>
	</div>


	<!-- Widgets -->
	<div class="four columns">

		<!-- Sort by -->
		<div class="widget">
			<h4>Overview</h4>

			<div class="job-overview">
				
				<ul>
					<li>
						<i class="fa fa-map-marker"></i>
						<div>
							<strong>Location:</strong>
							<span>{{$posting->location}}</span>
						</div>
					</li>
					<li>
						<i class="fa fa-list-ol" aria-hidden="true"></i>
						<div>
							<strong>Required Experience</strong>
							<span>{{$posting->required_experience}} Years</span>
						</div>
					</li>
					<li>
						<i class="fa fa-user"></i>
						<div>
							<strong>Job Title:</strong>
							<span>{{$posting->title}}</span>
						</div>
					</li>
					<li>
						<i class="fa fa-money"></i>
						<div>
							<strong>Salary:</strong>	
							@if($posting->showSalary == 'yes')
								<span>${{$posting->salary}}</span>
							@else
								<span>Provide on Request</span>
							@endif
						</div>
					</li>
				</ul>


				@if(!Session::has('user_id'))                
                    <a data-remodal-target="modal" href="#" class="button">Apply For This Job</a>
					<a data-remodal-target="modal" href="#" class=" button">Save Job</a>
                @else
                	@if($appliedTo > 0)
                	 <a href="#!" class="button">Applied</a>
                	 @else
                	 <a href="{{$posting->url}}"  class="button">Apply For This Job</a>
                	 @endif

                	@if($saved > 0) 
					 <a href="#!" class="button" onClick="unsaveJob(this);">Saved</a>

					 @else
					  <a href="#!" class="button" onClick="saveJob(this);">Save Job</a>
					 @endif
                @endif

				
				

			</div>

		</div>

	</div>
	<!-- Widgets / End -->


</div>

<div class="remodal" data-remodal-id="modal" data-remodal-options="hashTracking: false">
  <button data-remodal-action="close" class="remodal-close"></button>
    <div id="login-panel">
        <form id="register-form">
            {{ csrf_field() }}
            <h2 style="color:#29C9C8;;">Sign Up Today</h2>
            <input type="text" id="student_name" name="student_name" placeholder="Name" value=""/>
            <input type="text" id="email" name="email" placeholder="Email" value=""/>
            <input type="password" id="password" name="password" placeholder="Password" value=""/>
            
            <button data-remodal-action="confirm" type="button" class="white-btn" style="margin:0 auto;padding:15px;" onClick="verifyLogin();">Register</button>
            <div class="links col-sm-12" style="margin-top: 5px;">
                <a href="#" style="color:black;font-weight: 600;">Need to Contact Us?</a>
            </div>
        </form>
    </div>
</div>
<div class="remodal" data-remodal-id="modal-apply" data-remodal-options="hashTracking: false">
  <button data-remodal-action="close" class="remodal-close"></button>
    <div id="login-panel">
        <form id="apply-form" action="{{route('apply-to-job',$posting->id)}}" method="POST" enctype="multipart/form-data">
        	{{csrf_field()}}
			<input type="text" placeholder="Full Name"  name="student_name" value="{{Session::get('student_name')}}"/>
			<input type="text" placeholder="Email Address" name="email" value="{{Session::get('email')}}">
			<textarea placeholder="Your message / cover letter sent to the employer" name="message" id="message"></textarea>

			<!-- Upload CV -->
			<div class="upload-info"><strong>Upload your CV (optional)</strong> <span>Max. file size: 5MB</span></div>
			<div class="clearfix"></div>

			<label class="upload-btn">
			    <input type="file" multiple name="user_file" />
			    <i class="fa fa-upload"></i> Browse
			</label>
			<span class="fake-input" id="file-name">No file selected</span>

			<div class="divider"></div>

			<button class="send button" style="color:white;" type="submit" >Send Application</button>
		</form>
    </div>
</div>

<div class="small-dialog-content">
						
					</div>

<input type="hidden" name="post_id" id="post_id" value="{{$posting->id}}" >

@stop

@section('script_plugins')
	<script type="text/javascript">
		$(document).ready(function(){
		$("input[type='file']").change(function(e) {
			var fileName = e.target.files[0].name;
        	$('#file-name').text(fileName);
    	});
		});
		function saveJob(button){
            $.post('{{route('save-job',$posting->id)}}',{_token:"{{csrf_token()}}"},function(data){
                if(data == 1){
                    $(button).text('Saved');
                    $(button).attr('onClick','unsaveJob(this)');
                }else{
                    
                }  
            });
        }

        function unsaveJob(button){
            $.post('{{route('unsave-job',$posting->id)}}',{_token:"{{csrf_token()}}"},function(data){
                if(data == 1){
                    $(button).text('Save this Job');
                     $(button).attr('onClick','saveJob(this)');
                }  
            });
        }
		
	</script>
@stop