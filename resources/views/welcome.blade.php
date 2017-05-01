<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
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
        <div id="Container">
            <form action="{{route('submit-search')}}" method="post">
            {{ csrf_field() }}
                <div class="search-header col-md-12 col-xs-12">
                    <h1 class="text-center">Start your search to gain worlds of experience. </h1>
                </div>
                <div class="search-boxes col-md-6 col-xs-6 col-md-offset-3">
                    <input class="col-md-8 col-xs-8 col-md-offset-2" type="text" name="searchkeywords" id="searchkeywords" placeholder="Keywords" />
                    <input class="col-md-8 col-xs-8 col-md-offset-2" type="text" name="searchlocation" id="searchlocation" placeholder="Location"/>
                </div>
                <div class="search-button-div col-md-12 col-xs-12">
                        <button class="white-btn" style="background-color:#354886;margin:10px auto;padding:5px 15px" type="submit">Search</button>
                        <a style="display:block;font-weight:bold;" class="advanced-search" href="#"> Advanced Search </a>
                </div>
            </form>
        </div>
        <div id="otherContainer">
            <div id="social-medias" class="col-md-3 col-xs-3">
                <h2 class="text-center">Social Media</h2>
                <div id="twitter" class="col-md-12 col-xs-12">
                    <a href="#">
                    <img src="{{URL::asset('/images/twitter-icon.png')}}" alt="twitter-icon"/>
                    <h3>Twitter</h3></a>
                </div>
                <div id="instagram" class="col-md-12 col-xs-12">
                    <a href="#">
                    <img src="{{URL::asset('/images/instagram-icon.png')}}" alt="instagram-icon"/>
                    <h3>Instagram</h3></a>
                </div>
                <div id="facebook" class="col-md-12 col-xs-12">
                    <a href="#">
                    <img src="{{URL::asset('/images/facebook-icon.png')}}" alt="facebook-icon"/>
                    <h3>Facebook</h3></a>
                </div>
            </div>
            <div id="tips" class="col-md-6 col-xs-6" >
                <h2 class="text-center">Tips &amp; Advice </h2>
            </div>
            <div id="polls-and-reviews" class="col-md-3 col-xs-3">
                <h2 class="text-center">Polls</h2>
                <div id="polls">
                    <h3>How many years of experience should an "entry level" job require?</h3>
                    <form action="">
                        <input type="checkbox" name="0" value="0">0 years of experience<br>
                        <input type="checkbox" name="1" value="1">1 years of experience<br>
                        <input type="checkbox" name="2" value="2">2 years of experience<br>
                    </form>
                    <a href="#" id="view-results" >View Results</a>
                </div>
                <h2 class="text-center">Reviews</h2>
            </div>
        </div>  
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>
