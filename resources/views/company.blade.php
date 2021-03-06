@extends('layout.newthemelayout')

@section('title')
    <title>{{$company->company_name}}</title>
@stop


@section('content')

<!-- Titlebar
================================================== -->
<div id="titlebar">
    <div class="container remodal-bg">
        <div class="ten columns">

            @if(Session::has('employer_id') and Session::get('employer_id') == $id)
            <h2>{{$company->company_name}}&nbsp<span class="full-time" style="color:white;">VERIFIED</span><a href="{{route('employer-profile-edit',$id)}}" style="text-decoration:none;"><span class="full-time" style="color:white;">Edit This Page</span></a></h2>
            @else
            <h2>{{$company->company_name}}&nbsp<span class="full-time" style="color:white;">VERIFIED</span></h2>
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
                <h4>{{$company->company_name}}</h4>
                
                <span><a href="{{$company->website}}" target="_blank"><i class="fa fa-at" aria-hidden="true"></i>{{$company->website}}</a></span>
                <span><a href="mailto:{{$company->profile_email}}"><i class="fa fa-envelope" aria-hidden="true"></i>&nbspContact</a></span>
            </div>
            <div class="clearfix"></div>
        </div>

        

        <br>
        <h3>Summary:</h3>

        <p>{{$company->company_overview}}</p>
        
        <br>

        <h4 class="margin-bottom-10">Jobs Offered By: &nbsp {{$company->company_name}}</h4>

        @if(sizeof($jobs) > 0)
        <ul class="job-list">
            @foreach($jobs as $job)
                <li class="highlighted"><a href="{{route('get-posting',$job->id)}}" target="_blank" onClick="seen();">
                    <img src="{{URL::asset('/images/job-list-logo-01.png')}}" alt="">
                    <div class="job-list-content">
                        <h4>{{$job->title}}</h4>
                        <div class="job-icons">
                            <span style="text-transform: capitalize;"><i class="fa fa-briefcase"></i>{{$job->company}}</span>
                            <span><i class="fa fa-map-marker"></i>{{$job->location}}</span>
                            <?php 
                                $date = date_create($job->posted_date);
                                $formattedDate = date_format($date,'F d, Y');
                            ?>
                            <span><i class="fa fa-calendar" aria-hidden="true"></i></i>{{$formattedDate}}</span>
                        </div>
                    </div>
                    </a>
                    <div class="clearfix"></div>
                </li>
            @endforeach
        </ul>
        @endif
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
                        <i class="fa fa-building"></i>
                        <div>
                            <strong>Headquaters:</strong>
                            <span>{{$company->company_location}}</span>
                        </div>
                    </li>
                    <li>
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <div>
                            <strong>Company Size:</strong>    
                            <span>{{$company->employees}}+ employees</span>
                        </div>
                    </li>
                    <li>
                        <i class="fa fa-phone" aria-hidden="true"></i>
                        <div>
                            <strong>Telephone:</strong>    
                            <span></span>
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
  <a href="{URL::to('/')}"><button class="remodal-close"></button></a>
    <div id="login-panel">
        <form id="register-form">
            { csrf_field() }
            <h2 style="color:#29C9C8;;">Sign Up Today and View this page</h2>
            
            <a href="{URL::to('/my-account')}"><button type="button" class="white-btn" style="margin:0 auto;padding:15px;">Student?</button></a>
            <a href="{URL::to('/employer/myaccount')}"><button type="button" class="white-btn" style="margin:0 auto;padding:15px;" >Employer?</button></a>
            <div class="links col-sm-12" style="margin-top: 5px;">
                <a href="{URL::to('/')}" style="color:black;font-weight: 600;">Return home</a>
            </div>
        </form>
    </div>
</div>
@stop

@section('script_plugins')
    <script type="text/javascript">
        
        
    </script>
@stop