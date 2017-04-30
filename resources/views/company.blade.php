<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{$company->company_name}}</title>

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
                    <a href="{{URL::to('/student-login')}}"><button class="white-btn">Login</button></a>
                    <button class="white-btn">Employer?</button>
                </ul>
            </div>
        </div>
        <div class="container">
            <div  style="margin:50px 0;height:100%;border:1px solid #354886;border-radius: 10px;padding:10px;">
                <div class="row" style="text-align: center;margin-top: 15px;">
                    <img class="center-block img-responsive" style="width:400px;height:315px;" src="{{URL::asset('/images/nasa.png')}}" alt="Company Photo">
                </div>
                <div class="row" style="text-align: center;">
                    <h2 class="text-center" style="display:block;margin:0 auto;font-weight: bold;">{{$company->company_name}}</h2>
                </div>
                <div class="row" style="text-align: center;">
                    <h4 class="text-center" style="display:block;margin:0 auto;font-weight: bold;">
                        @if($company->followers > 1000)
                            1000+ Followers
                        @else
                            {{$company->followers}} Followers
                        @endif
                    </h4>
                </div>
                <div class="row" style="text-align: center;">
                    <button style="margin:0 auto" class="btn waves-effect waves-white">
                    @if($company->jobs_avaliable > 20)
                        20+ Jobs
                    @else
                        {{$company->jobs_avaliable}} Jobs
                    @endif

                    </button>
                    <button style="margin:0 auto" class="btn waves-effect waves-white waves-ripple ">
                    @if($company->employees > 500)
                        500+ Employees
                    @else
                        {{$company->employees}} Employees
                    @endif
                    </button>
                    <button style="margin:0 auto" class="btn waves-effect waves-teal"> Follow</button>
                </div>
                <div class="row" style="text-align: center;">
                    <h6 style="font-weight: bold;">Company Overview</h6>
                    <div class="col-sm-8 col-sm-offset-2">
                        <p style="font-weight: bold;">The National Aeronautics and Space Administration is an independent agency of the executive branch of the United States federal government responsible for the civilian space program, as well as aeronautics and aerospace research.
                        President Dwight D. Eisenhower established NASA in 1958[10] with a distinctly civilian (rather than military) orientation encouraging peaceful applications in space science. The National Aeronautics and Space Act was passed on July 29, 1958, disestablishing NASA's predecessor, the National Advisory Committee for Aeronautics (NACA). The new agency became operational on October 1, 1958.<p>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>
