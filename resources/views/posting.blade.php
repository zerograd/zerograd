<!DOCTYPE html>
<html lang="{ config('app.locale') }">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title></title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">

  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>
        <!-- Styles -->
        {{ HTML::style('css/styles.css') }}
        <style>
        #header{
            height:10%;

        }
        #Container{
            height:90%;
        }

        .waves-effect .waves-white .waves-ripple {
         /* The alpha value allows the text and background color
         of the button to still show through. */
          background-color: rgba(239, 246, 237, 0.65);
        }
        .btn {
            margin:5px;
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

        
        .no-hover:hover{
            text-decoration: none;
            color:black;
        }
        </style>
    </head>
    <body>
        <div id="header">
            <div id="logo-div" class="col-md-6 col-xs-6">
                <a href="{{URL::to('/')}}"><h1 id="logo" style="margin:0;padding:15px; color:white;display:block;">Zer<span class="zeroLogo">0</span>Grad</h1></a>

            </div>
            <div class="col-md-6 col-xs-6">
                <ul class="navigation">
                    <li><a>Home</a></li>
                    <li><a>About</a></li>
                    <li><a>Contact Us</a></li>
                   @if(!Session::has('user_id'))
                        <a href="{{URL::to('/student-login')}}"><button class="white-btn">Login</button></a>
                        <button class="white-btn">Employer?</button>
                    @else
                    <a href="{{URL::to('/student/home')}}"><button class="white-btn">{{Session::get('student_name')}}</button></a>
                    @endif

                    
                </ul>
            </div>
        </div>
        <div class="col-sm-12" style="display:block;float:left;">
            <a href="{{URL::to('/')}}" class="no-hover"><h5 style="float:left;">Back to Search Tool</h5></a>
        </div>
        <div class="container">
            <div  style="margin:50px 0;height:100%;border:1px solid #354886;border-radius: 10px;padding:10px;">
                <div class="row" style="text-align: center;margin-top: 15px;">
                    <img class="center-block img-responsive" style="width: 200px;height: 155px;float: left;margin:0 40px;" src="{{URL::asset('/images/nasa.png')}}" alt="Company Photo">
                    <div class="row" style="text-align: left;float:left;">
                        <h4>{{$posting->title}}</h4>
                        <a href="{{route('company-get',$posting->companyID)}}" class="no-hover"><h5>{{$posting->company_name}}</h5></a>
                        <p style="font-weight: bold">Location: {{$posting->location}}</p>
                        <p style="font-weight: bold">Keywords: {{$posting->keywords}}</p>
                        <p style="font-weight: bold">REQUIRED EXPERIENCED: {{$posting->required_experience}}</p>
                        <p style="font-weight: bold">Posted: {{$posting->posted_date}}</p>
                        <button style="margin:0 auto" class="btn waves-effect waves-teal">Save this Job</button>
                        <button style="margin:0 auto" class="btn waves-effect waves-teal">Apply Now</button>
                        <button style="margin:0 auto" class="btn waves-effect waves-teal">Share!</button>
                    </div>
                </div>
                
                <div class="row" style="text-align: center;">
                    <h4 class="text-center" style="display:block;margin:0 auto;font-weight: bold;">
                        Job Description:
                    </h4>
                </div>
                <div class="row" style="text-align: center;">
                    <div class="col-sm-8 col-sm-offset-2">
                        <p style="font-weight: bold;">{{$posting->description}}<p>
                    </div>
                </div>
            </div>
        </div>
        <input type="text" style="visibility: hidden" value="{{$keywords}}" id="searchkeywords" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            // function backToResults(){
            //     var keywords = $('#searchkeywords').val();
            //     $.post('{{route('submit-search')}}',{

            //     },function(data){

            //     });
            // }
        </script>
    </body>
</html>
