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
        <style>
            #Container {
                height:90%;
            }
        </style>
    </head>
    <body>
        <div id="header">
            <div id="logo-div" class="col-md-6 col-xs-6">
                <h1>
                Zer<span class="zeroLogo">0</span>Grad
                </h1>

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
        <div id="Container">
            <div id="leftColumn" style="border-right:1px solid grey;height:100%;" class="col-sm-2">

            </div>
        </div> 
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>
