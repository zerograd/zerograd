<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
    <script src="https://use.fontawesome.com/ba4723fdf4.js"></script>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ZeroGrad</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <!-- Styles -->
        {{ HTML::style('css/styles.css') }}
    </head>
    <body>
        <div id="header">
            <div id="logo-div" class="col-md-6 col-xs-6">
                <a href="{{URL::to('/')}}"><h1 id="logo" style="margin:0;padding:15px; color:white;display:block;">Zer<span class="zeroLogo">0</span>Grad</h1></a>

            </div>
            <div class="col-md-6 col-xs-6">
                <ul class="navigation">
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
        <div class="container">
            <div  class="row" style="margin:50px 0;height:100%;border:1px solid #354886;border-radius: 10px;padding:10px;">
                    <h2>About</h2>
                        <p style="color:black;font-weight: bold;">ZeroGrad is a site where we believe that employers need a better way to share entry-level jobs with fresh and eager graduates. We don't believe experience is the issue when applying to jobs but rather a miscommunication between the hiring companies and job seekers; Zerograd attempts to build a strong communication between the two. </p>
            </div>
        </div>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>
