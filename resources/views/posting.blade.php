
@extends('layout.header-layout')

@section('title')
  {{$posting->title}} : {{$posting->keywords}}
@stop

@section('styles')
    <style type="text/css">
        #navigation {
            background-color: #354886;
        }
        h1,h2,p{
            color:black;
            font-weight: 600;
        }
        #register-form{
        border: 1px solid white;
        margin-top:5px;
        height:auto;
        text-align:center;
        padding:30px 10px;
        border-radius:10px;
    }
    #register-form > input {
        padding:10px;
        margin:10px 0;
        width:100%;
        color: #354886;
        margin-top: 20px;
        font-weight: bold;
        font-family: 'Raleway', sans-serif;
    }
    ul {
        list-style: none;
        padding: 0;
         margin: 0;
    }
    #responsibilities li {
        padding-left: 8px;
    }
    #responsibilities span {
        margin:8px;
        color:black;
            font-weight: 600;
    }
    #requirements-list li {
        padding-left: 8px;
    }
    #requirements-list span {
        margin:8px;
        color:black;
            font-weight: 600;
    }
    li:before {
      content: '■'; 
      color:#354886; /* or whatever color you prefer */
    }
    
    .container-fluid {
        height:100%;
    }
    </style>

@stop

@section('style_plugins')
    {{ HTML::style('css/posting-responsive.css') }}
@stop

@section('content')
    @include('nav')
    <div class="container-fluid remodal-bg">
        <div id="overview" class=" col-lg-3 col-sm-5 col-xs-12" style="text-align:center;border-right:1px solid black;">
            <div class="container-fluid">
                    <div class="col-sm-12" style="margin-top:40px;">
                <img class="center-block" style="width: 200px;height: 155px;margin:0 auto;" src="{{URL::asset('/images/nasa.png')}}" alt="Company Photo">
                </div>
                <div class="col-sm-12" style="padding:20px;">
                    <h1>{{$posting->title}}</h1>
                    <a href="{{route('company-get',$posting->companyID)}}" class="no-hover"><h2>{{$posting->company_name}}</h2></a>
                    <h3 style="font-weight: bold">REQUIRED EXPERIENCED: {{$posting->required_experience}} years</h3>
                    <h4 style="font-weight: bold">Job Type: {{$posting->status}}</h4>
                    <div class="col-sm-12">
                        <p class="col-sm-6"><span><i class="fa fa-link" aria-hidden="true"></i></span>Website</p>
                        <p class="col-sm-6"><span><i class="fa fa-twitter" aria-hidden="true"></i></span>Social Media</p>
                    </div>
                    <p style="font-weight: bold"><span style="margin:0 2px;color:#354886;"><i class="fa fa-map-marker" aria-hidden="true"></i></span> Location: {{$posting->location}}</p>
                    <p style="font-weight: bold"><span style="margin:0 2px;color:#354886;"><i class="fa fa-key" aria-hidden="true"></i></span>Keywords: {{$posting->keywords}}</p>
                    @if($posting->showSalary == 'yes')
                    <p style="font-weight: bold"><span style="margin:0 2px;color:#354886;"><i class="fa fa-money" aria-hidden="true"></i></span>Salary: ${{$posting->salary}}</p>
                    @else
                    <p style="font-weight: bold"><span style="margin:0 2px;color:#354886;"><i class="fa fa-money" aria-hidden="true"></i></i></span>Salary: Available on Request</p>
                    @endif
                    <p style="font-weight: bold">Posted: {{$posting->posted_date}}</p>
                    
                </div>
                <div id="buttons" class="col-sm-12">
                    @if(!Session::has('user_id'))
                    <a data-remodal-target="modal">    <button style="margin:0 auto" class="btn btn-primary waves-effect waves-teal">Apply Now</button></a>
                    <a data-remodal-target="modal">   <button style="margin:0 auto" class="btn btn-primary waves-effect waves-teal" type="button" onClick="saveJob(this);">Save this Job</button></a>
                    @else
                        @if($appliedTo > 0)
                            <button style="margin:0 auto" class="btn btn-primary waves-effect waves-teal" type="button">Applied</button>

                        @else
                            <button style="margin:0 auto" class="btn btn-primary waves-effect waves-teal" type="button" onclick="applyToJob();">Apply Now</button>
                        @endif
                        
                    
                        @if($saved > 0)
                            <button style="margin:0 auto" class="btn btn-primary waves-effect waves-teal" type="button" onClick="unsaveJob(this);">Saved</button>
                        @else
                            <button style="margin:0 auto" class="btn btn-primary waves-effect waves-teal" type="button" onClick="saveJob(this);">Save this Job</button>
                        @endif
                    @endif
                    
                </div>
                <!-- END OF BUTTONS -->
                <!-- Share icons -->
                <div class="col-sm-12" style="margin-top: 40px;">
                    <span class="number number-primary"><i class="fa fa-twitter" aria-hidden="true"></i>
                    </span>
                    <span class="number number-primary"><i class="fa fa-instagram" aria-hidden="true"></i>
                    </span>
                    <span class="number number-primary"><i class="fa fa-linkedin" aria-hidden="true"></i>
                    </span>
                </div>
            </div>
        </div> 
        <!-- JOB DESCRIPTION AREA -->
        <div id="job-area" class="col-lg-9 col-sm-7 col-xs-12">
            <h2>Job Description:</h2>
            <div class="col-sm-12">
                <p>{{$posting->description}}</p>
            </div>
            <h2>Key Responsibilities:</h2>
            <div class="col-sm-12">
                <ul id="responsibilities">
                    <li><span>{{$posting->description}}</span></li>
                </ul>
            </div>
            <h2>Requirements:</h2>
            <div class="col-sm-12">
                <ul id="requirements-list">
                    <li><span>{{$posting->description}}</span></li>
                </ul>
            </div>
        </div>
        <!-- END OF JOB DESCRIPTION AREA -->
    </div>

    <!-- Sign Up Modal -->
<div class="remodal" data-remodal-id="modal">
  <button data-remodal-action="close" class="remodal-close"></button>
    <div id="login-panel">
        <form id="register-form">
            {{ csrf_field() }}
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

    <input type="text" name="post_id" id="post_id" value="{{$post_id}}" hidden>
@stop

@section('script_plugins')
    <script type="text/javascript">
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
        function verifyLogin(){
            var email = document.getElementById('email');
            var password = document.getElementById('password');
            var name = document.getElementById('student_name');
            if(email.value.length == 0){
                alert("Please enter your email.");
                }else if(name.value.length == 0){
                alert("Please enter your name.");
            }else if(password.value.length == 0){
                alert("Please enter your password.");
            }else{
                var data = $("#register-form").serialize();
                $.post('{{URL::to('/student-register/register')}}'
                    ,data,function(data){
                        if(data == "success"){
                            window.location = "{{URL::to('/')}}";
                        }else if(data == "User Already Exist"){
                            alert('User Already Exist');
                        }
                    }
                );
            }
       }

       function applyToJob(){
           var postID = $('#post_id').val();
           $.post('{{route('apply-to-job')}}',{id:postID,_token:"{{csrf_token()}}"},function(data){
                if(data == "applied already"){
                    alert('You have already applied for this position.')
                }else{
                    alert('You have succesfully applied for this position.');
                }
                
           });
       }
    </script>
@stop