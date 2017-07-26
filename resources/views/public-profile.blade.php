@extends('layout.newthemelayout')

@section('title')
	<title>{{$student->student_name}}</title>
@stop


@section('content')

<!-- Titlebar
================================================== -->
<div id="titlebar">
	<div class="container remodal-bg">
		<div class="ten columns">
			
			
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
				<h4>{{$student->student_name}}</h4>
				
				
			</div>
			<div class="clearfix"></div>
		</div>

		

		<br>
		

		

	</div>
	</div>


	<!-- Widgets -->
	<div class="four columns">

		<!-- Sort by -->
		<div class="widget">
			<h4>Overview</h4>

			

		</div>

	</div>
	<!-- Widgets / End -->


</div>

<div class="remodal" data-remodal-id="modal" data-remodal-options="hashTracking: false, closeOnOutsideClick: false">
  <a href="{{URL::to('/')}}"><button class="remodal-close"></button></a>
    <div id="login-panel">
        <form id="register-form">
            {{ csrf_field() }}
            <h2 style="color:#29C9C8;;">Sign Up Today and View this page</h2>
            
            <a href="{{URL::to('/my-account')}}" style="text-decoration: none;color:white;"><button type="button" class="white-btn" style="margin:0 auto;padding:15px;">Student?</button></a>
            <a href="{{URL::to('/employer/myaccount')}}" style="text-decoration: none;color:white;"><button type="button" class="white-btn" style="margin:0 auto;padding:15px;" >Employer?</button></a>
            <div class="links col-sm-12" style="margin-top: 5px;">
                <a href="{{URL::to('/')}}" style="color:black;font-weight: 600;">Return home</a>
            </div>
        </form>
    </div>
</div>
<div class="remodal" data-remodal-id="modal-apply" data-remodal-options="hashTracking: false">
  <button data-remodal-action="close" class="remodal-close"></button>
    <div id="login-panel">
        <form id="apply-form" action="{route('apply-to-job',$posting->id)}" method="POST" enctype="multipart/form-data">
        	
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



@stop

@section('script_plugins')
	<script type="text/javascript">
		$(document).ready(function(){
            @if(!Session::has('user') and !Session::has('employer_id'))
                var inst = $('[data-remodal-id=modal]').remodal();
                inst.open();
            @endif
        });
		
	</script>
@stop