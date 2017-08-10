<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" ng-app="app">
    <head>
    <!-- <script src="https://use.fontawesome.com/ba4723fdf4.js"></script> -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{URL::asset('/css/font-awesome-4.7.0/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{URL::asset('/Remodal-1.1.1/dist/remodal.css')}}">
        <link rel="stylesheet" href="{{URL::asset('/Remodal-1.1.1/dist/remodal-default-theme.css')}}">
        <title>
            @yield('title')
        </title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/sweetalert2/5.3.5/sweetalert2.min.css">

        
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script> -->
        <script src="{{URL::asset('/js/jquery.min.js')}}"></script>
        
        <link href="{{URL::asset('/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('/radios-to-slider/css/radios-to-slider.css')}}">
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.0/angular.min.js"></script>
      <script src=""></script>
      <link href="{{URL::asset('angular-xeditable-0.8.0/css/xeditable.css')}}" rel="stylesheet">
      <script src="{{URL::asset('angular-xeditable-0.8.0/js/xeditable.js')}}"></script>
      <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

        <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css"> -->
        
        
        <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css"> -->

        <!-- Styles -->
        {{ HTML::style('css/styles.css') }}
        {{ HTML::style('css/main-responsive.css') }}
            @yield('styles')
            
            @yield('style_plugins')
        

    </head>
    <body>
        <div class="container-fluid" ng-controller="Ctrl" ng-cloak>
        @yield('content')
        <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script> -->
        <script src="{{URL::asset('/js/bootstrap.min.js')}}"></script>
        <script src="{{URL::asset('/Remodal-1.1.1/dist/remodal.min.js')}}"></script>
        <script src="{{URL::asset('radios-to-slider/js/jquery.radios-to-slider.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/sweetalert2/5.3.5/sweetalert2.min.js"></script>
                 <!-- AngularJS -->
        <script src="{{URL::asset('/js/main.js')}}"></script>
        @yield('script_plugins')
        </div>
    </body>
</html>
