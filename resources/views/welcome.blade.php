@extends('layout.header-layout')

@section('title')
    Zerograd
@stop

@section('content')    
        <div id="Container" style="background: url('{{URL::asset('/images/background.jpg')}}');background-size:100% 100%;">
            @include('nav')
            <form action="{{route('submit-search')}}" method="post">
            {{ csrf_field() }}
                <div id="title-div" class="col-sm-12">
                    <div class="search-header col-md-12 col-xs-12">
                        <h1 class="text-center" style="">Start your search to gain worlds of experience. </h1>
                        <p class="text-center">Find a job within minutes</p>
                    </div>
                </div>
                <div class="search-area col-md-10 col-md-offset-1">
                    <div class="col-md-5" style="padding:0;">
                        <input  style="width:100%;margin:0;padding:30px;border-top-left-radius: 5px;border-bottom-left-radius: 5px;" type="text" name="searchkeywords" id="searchkeywords" placeholder="Keywords" />
                    </div>
                    <div class="col-md-5" style="padding:0;">
                        <input class="col-md-12" style="width:100%;margin:0;padding:30px;" type="text" name="searchlocation" id="searchlocation" placeholder="Location"/>
                    </div>
                    <div class="col-md-2" style="padding:0;">
                        <button class="search-btn"  type="submit">Search</button>
                            <a style="display:block;font-weight:bold;" class="advanced-search text-center" href="#"> Advanced Search </a>
                    </div>
                </div>
            </form>
        </div>
        <!-- LATEST JOBS -->
        <div id="latest-jobs" style="background-color:white;width:100%;height:120%;">
            <h4 class="text-center" style="margin: 50px 0 10px 0;text-transform: uppercase;color: black;">Latest</h4>
            <div class="col-sm-12" style="text-align: center;">
                <h2 style="margin-bottom: 35px;font-weight: bold;font-size: 32px;">Recent jobs</h2>
                <div style="margin:5px auto;background-color:#354886;width:80px;height:3px;">
                </div>
            </div>
            <div class="col-md-12">
                <ul style="margin:0;padding:100px;list-style: none;">
                    @foreach($postings as $posting)
                        <li class="recent-job" style="padding:40px;">
                        <div class="container">
                            <img src="{{URL::asset('/images/google.png')}}" style="float:left;width:60px;height:60px;" alt="company logo" title="">
                            <div class="col-md-11">
                                <div class="row">
                                    <h3 style="margin:0 40px;color:black;font-weight: bold;display:inline-block;float:left;">{{$posting->title}}</h3>
                                    <h4 style="margin:0;display:inline-block;color:#C6C6C6;font-weight: bold;float:right;">{{$posting->location}}</h4>
                                </div>
                                <div class="row" style="margin-top:20px;">
                                    
                                    <h3 style="margin:0 40px;color:black;display:inline-block;float:left;">{{$posting->company_name}}</h3>
                                    <h4 style="margin:0;display:inline-block;padding:5px;color:#FFFFFF;font-weight: bold;float:right;text-transform: uppercase;font-size:14px;background-color: {{ $badges[mt_rand(0,2)]}};">{{$posting->status}}</h4>
                                </div>
                            </div>
                        </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!-- <div id="otherContainer">
            <div id="social-medias" class="col-md-3 col-xs-12">
                <h2 class="text-center">Social Media</h2>
                <div id="twitter" class="col-md-12 col-xs-4">
                    <a>
                    <h3 class="col-xs-12 text-center"><i class="fa fa-twitter-square" aria-hidden="true"></i>&nbspTwitter</h3></a>
                </div>
                <div id="instagram" class="col-md-12 col-xs-4">
                    <a href="https://instagram.com/zerograd" target="_blank">
                    
                    <h3 class="col-xs-12 text-center"><i class="fa fa-facebook-square text-center" aria-hidden="true"></i>&nbspInstagram</h3></a>
                </div>
                <div id="facebook" class="col-md-12 col-xs-4">
                    <a>
                    <h3 class="col-xs-12 text-center"><i class="fa fa-instagram fa-2 text-center" aria-hidden="true"></i>&nbspFacebook</h3></a>
                </div>
            </div>
            <div id="tips" class="col-md-6 col-xs-12" >
                <h2 class="text-center">Tips &amp; Advice </h2>
                <div class="col-xs-12">
                    @foreach ($advices as $advice)
                        <p style="font-size:16px;color:white;text-align: center;"><i class="fa fa-circle fa-1" aria-hidden="true"></i>&nbsp{{$advice->advice}}</p>
                    @endforeach
                </div>
            </div>
        </div> -->  

@stop
