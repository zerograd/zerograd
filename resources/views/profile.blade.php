@extends('layout.newthemelayout')

@section('title')
	<title>ZeroGrad</title>
@stop


@section('content')

<!-- Titlebar
================================================== -->
<div id="titlebar">
	<div class="container remodal-bg">
		<div class="ten columns">
			<span><a href="browse-jobs.html">{{$student->title}}</a></span>

			@if(Session::has('user_id') and Session::get('user_id') == $id)
			<h2>{{$student->name}}&nbsp<span class="full-time">{{$student->status}}</span><a href="{{route('public-profile-edit',Session::get('user_id'))}}" style="text-decoration:none;"><span class="full-time" style="color:white;">Edit This Page</span></a></h2>
			@else
			<h2>{{$student->name}}&nbsp<span class="full-time">{{$student->status}}</span></h2>
			@endif
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
				<h4>{{$student->name}}</h4>
				
				<span><a href="http://{{$student->website}}" target="_blank"><i class="fa fa-at" aria-hidden="true"></i> {{$student->website}}</a></span>
				<span><a href="mailto:{{$student->email}}"><i class="fa fa-envelope" aria-hidden="true"></i>&nbspContact</a></span>
			</div>
			<div class="clearfix"></div>
		</div>

		

		<br>
		<p>Summary:</p>

		<p>{{$student->summary}}</p>
		
		<br>

		<h4 class="margin-bottom-10">Skills</h4>

		<ul class="list-1">
			@foreach(explode(',',$student->skills) as $skill)
				<li>{{$skill}}</li>
			@endforeach
		</ul>

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
						<i class="fa fa-user"></i>
						<div>
							<strong>Title:</strong>
							<span>{{$student->title}}</span>
						</div>
					</li>
					<li>
						<i class="fa fa-star" aria-hidden="true"></i>
						<div>
							<strong>Rating:</strong>	
							<span>98%</span>
						</div>
					</li>
				</ul>


				

				
				

			</div>

		</div>

	</div>
	<!-- Widgets / End -->


</div>

<div class="remodal" data-remodal-id="modal" data-remodal-options="hashTracking: false">
  <button data-remodal-action="close" class="remodal-close"></button>
    <div id="login-panel">
        <form id="register-form">
            { csrf_field() }
            <h2 style="color:#29C9C8;;">Sign Up Today and begin your search</h2>
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
        <form id="apply-form" action="{route('apply-to-job',$posting->id)}" method="POST" enctype="multipart/form-data">
        	{csrf_field()}
			<input type="text" placeholder="Full Name"  name="student_name" value="{Session::get('student_name')}"/>
			<input type="text" placeholder="Email Address" name="email" value="{Session::get('email')}">
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



<div class="remodal" data-remodal-id="modal" data-remodal-options="hashTracking: false, closeOnOutsideClick: false">
  <a href="{{URL::to('/')}}"><button class="remodal-close"></button></a>
    <div id="login-panel">
        <form id="register-form">
            {{ csrf_field() }}
            <h2 style="color:#29C9C8;;">Sign Up Today and View this page</h2>
            
            <a href="{{URL::to('/my-account')}}"><button type="button" class="white-btn" style="margin:0 auto;padding:15px;">Student?</button></a>
            <a href="{{URL::to('/employer/myaccount')}}"><button type="button" class="white-btn" style="margin:0 auto;padding:15px;" >Employer?</button></a>
            <div class="links col-sm-12" style="margin-top: 5px;">
                <a href="{{URL::to('/')}}" style="color:black;font-weight: 600;">Return home</a>
            </div>
        </form>
    </div>
</div>
@stop

@section('script_plugins')
	<script type="text/javascript">
		
		
	</script>
@stop