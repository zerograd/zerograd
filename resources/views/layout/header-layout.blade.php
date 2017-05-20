<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
    <!-- <script src="https://use.fontawesome.com/ba4723fdf4.js"></script> -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{URL::asset('/css/font-awesome-4.7.0/css/font-awesome.min.css')}}">

        <title>
            @yield('title')
        </title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script> -->
        <script src="{{URL::asset('/js/jquery.min.js')}}"></script>
        
        <link href="{{URL::asset('/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
        
        <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css"> -->
        
        
        <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css"> -->

        <!-- Styles -->
        {{ HTML::style('css/styles.css') }}
        {{ HTML::style('css/responsive.css') }}
            @yield('styles')
            
            @yield('style_plugins')
        

    </head>
    <body>
        @yield('content')
        <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script> -->
        <script src="{{URL::asset('/js/bootstrap.min.js')}}"></script>
        @yield('script_plugins')
    </body>
</html>
