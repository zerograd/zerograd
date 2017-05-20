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
                        <input  style="width:100%;margin:0;padding:30px;border-top-left-radius: 5px;border-bottom-left-radius: 5px;color:#23CCF3;font-weight: bold;" type="text" name="searchkeywords" id="searchkeywords" placeholder="Keywords" />
                    </div>
                    <div class="col-md-5" style="padding:0;">
                        <input class="col-md-12" style="width:100%;margin:0;padding:30px;color:#23CCF3;font-weight: bold;" type="text" name="searchlocation" id="searchlocation" placeholder="Location"/>
                    </div>
                    <div class="col-md-2" style="padding:0;">
                        <button class="search-btn"  type="submit">Search</button>
                            <a style="display:block;font-weight:bold;" class="advanced-search text-center" href="#"> Advanced Search </a>
                    </div>
                </div>
            </form>
        </div>
        <!-- LATEST JOBS -->
            <div id="latest-jobs" style="background-color:white;width:100%;height:1000px;padding:5px;">
                <h4 class="text-center" style="margin: 50px 0 10px 0;text-transform: uppercase;color: black;">Latest</h4>
                <div class="col-sm-12" style="text-align: center;">
                    <h2 style="margin-bottom: 35px;font-weight: bold;font-size: 32px;">Recent jobs</h2>
                    <div style="margin:5px auto;background-color:##23CCF3;width:80px;height:3px;">
                    </div>
                </div>
                
                    <div class="container-fluid">
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
                                        <h4 style="margin:0;display:inline-block;padding:5px;color:#FFFFFF;font-weight: bold;float:right;text-transform: uppercase;font-size:14px;background-color: {{ $badges[mt_rand(0,2)]}};">
                                            
                                            @if(isset($posting->status))
                                                {{$posting->status}}
                                            @else
                                                Not Specified
                                            @endif
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            </li>
                        @endforeach
                        </ul>
                        <div class="col-md-12" style="text-align: center;">
                        <a href="{{URL::to('/search')}}"><button type="button" style="margin:0 auto;padding:10px 40px;font-weight: 600;letter-spacing: 1px;font-size: 18px"class="btn btn-info">BROWSE ALL JOBS</button></a>
                        </div>
                    </div>
                    
                
            </div>

        <!-- Database info -->
        
            <div id="database-info" style="background-color:white;width:100%;height:221px;text-align: center;margin-top:120px;">

                <div class="container-fluid">
                    <!-- Jobs -->
                <div class="counter col-md-3 ">
                    <div class="row" style="text-align: center;"><h2 >{{$sizeOfJobs}} + </h2>
                    <div style="margin:20px auto;width:60px;height:2px;background-color:#23CCF3; "></div>
                    </div>

                    <div class="row"><h4>Jobs</h4></div>

                </div>

                <!-- Members -->
                <div class="counter col-md-3">
                    <div class="row" style="text-align: center;"><h2>{{$sizeOfMembers}} + </h2></div>
                    <div style="margin:20px auto;width:60px;height:2px;background-color:#23CCF3; "></div>
                    <div class="row"><h4>Members</h4></div>

                </div>

                <!-- Resumes -->
                <div class="counter col-md-3">
                    <div class="row" style="text-align: center;"><h2>{{$sizeOfResumes}} + </h2></div>
                    <div style="margin:20px auto;width:60px;height:2px;background-color:#23CCF3; "></div>
                    <div class="row"><h4>Resume</h4></div>

                </div>

                <!-- Companies -->
                <div class="counter col-md-3">
                    <div class="row" style="text-align: center;"><h2>{{$sizeOfCompanies}} + </h2></div>
                    <div style="margin:20px auto;width:60px;height:2px;background-color:#23CCF3; "></div>
                    <div class="row"><h4>Company</h4></div>

                </div>
                </div>
            </div>
        
         <!-- HOW IT WORKS  -->
         <div id="how-it-works" style="margin-top:170px;background-color:white;width:100%;height:762px;padding:50px;">
            <div class="col-md-12">
                <h3 style="float:left;margin: 0;font-size: 16px;">WORKFLOW</h3>
            </div>
            <div class="col-md-12">
                <div class="col-md-6" style="padding:0;">
                    <h1 style="font-size: 48px;font-weight: bold;">How it Works</h1>
                    <div class="btn-info" style="float:left;margin:20px auto;width:60px;height:2px;"></div>
                    <div class="col-md-12" style="margin-top: 40px;">
                            <p style="font-size: 22px;">Pellentesque et pulvinar orci. Suspendisse sed euismod purus. Pellentesque nunc ex, ultrices eu enim non, consectetur interdum nisl. Nam congue interdum mauris, sed ultrices augue lacinia in. Praesent turpis purus, faucibus in tempor vel, dictum ac eros.</p>
                        <br>
                        <p style="font-size: 22px; ">
                            Nulla quis felis et orci luctus semper sit amet id dui. Aenean ultricies lectus nunc, vel rhoncus odio sagittis eu. Sed at felis eu tortor mattis imperdiet et sed tortor. Nullam ac porttitor arcu. Vivamus tristique elit id tempor lacinia. Donec auctor at nibh eget tincidunt. Nulla facilisi. Nunc condimentum dictum mattis.
                        </p>
                        <button type="submit" class="btn btn-primary" style="margin-top:70px;border-radius: 3px;padding: 15px 40px;">LEARN MORE</button>
                    </div>
                </div>
                <div class="col-md-6">
                    <img src="{{URL::asset('/images/iphone.png')}}" class="img-responsive">
                </div>
            </div>
        </div>

        <!-- POPULAR CATEGORIES -->
        <div id="popular-categories" style="margin-top:170px;background-color:#F6F6F6;width:100%;height:1000px;padding:50px;">
            <div class="col-md-12">
                <h3 class="text-center" style="margin: 0;font-size: 20px;">CATEGORIES</h3>
                <h3 class="text-center" style="margin: 30px 0;font-size: 48px;font-weight: bold;">Popular Categories</h3>
                    <div style="margin:30px auto;width:60px;height:2px;background-color:#23CCF3; "></div>
                <h3 class="text-center" style="margin: 0;font-size: 20px;font-weight: bold;">The most popular categories</h3>
            </div>
            <div class="col-md-12" style="margin:40px 0;height:auto;">
                @foreach ($categories as $category)
                <div class="category">
                    <div class="icon-div">
                        <div class="inner-icon-div">
                            <i class="{{$category->icon}}" aria-hidden="true"></i>
                        </div>
                    </div>
                    <h1 class="text-center" style="font-size: 28px;font-weight: bold;">{{$category->cat_name}}</h1>
                    <p class="text-center" style="margin:20px;font-size: 18px;font-weight: bold;color:#C6C6C6;">{{$category->cat_description}}</p>
                </div>
                @endforeach
            </div>
        </div>

@stop
