@extends('layout.header-layout')

@section('title')
    Zerograd
@stop

@section('content')    
    <section style="background: url('{{URL::asset('/images/background.jpg')}}') no-repeat;background-size: 100% 100%;">
            <div class="class-sm-12" id="Container" style="background-size:100% 100%;">
                @include('nav')
                <form action="{{route('submit-search')}}" method="post" id="search-form">
                {{ csrf_field() }}
                    <div id="title-div" class="col-sm-12">
                        <div class="search-header col-md-12 col-xs-12">
                            <h1 class="text-center" style="">Start your search to gain worlds of experience. </h1>
                            <p class="text-center">Find a job within minutes</p>
                        </div>
                    </div>
                    <div class="search-area col-md-10 col-md-offset-1">
                        <div class="col-md-5" style="padding:0;">
                            <input type="text" name="searchkeywords" id="searchkeywords" placeholder="Keywords" />
                        </div>
                        <div class="col-md-5" style="padding:0;">
                            <input class="col-md-12"  type="text" name="searchlocation" id="searchlocation" placeholder="Location"/>
                        </div>
                        <div class="col-md-2" style="padding:0;">
                            <button class="search-btn"  type="button" onClick="submitSearch();">Search</button>
                                <a style="display:block;font-weight:bold;" class="advanced-search text-center" href="#"> Advanced Search </a>
                        </div>
                    </div>
                </form>
            </div>
    </section>

    <section>
        <!-- LATEST JOBS -->
            <div id="latest-jobs" style="background-color:white;width:100%;height:1000px;padding:5px;">
                <h4 class="text-center" style="margin: 50px 0 10px 0;text-transform: uppercase;color: black;">Latest</h4>
                <div class="col-sm-12" style="text-align: center;">
                    <h2 style="margin-bottom: 35px;font-weight: bold;font-size: 32px;">Recent jobs</h2>
                    <div style="margin:5px auto;background-color:##23CCF3;width:80px;height:3px;">
                    </div>
                </div>
                
                    <div class="container-fluid">
                        <ul>
                        @foreach($postings as $posting)
                        <a href="{{route('posting-get',['title' => $posting->title,'id' => $posting->id])}}" style="text-decoration: none;"><li class="recent-job col-lg-8 col-lg-offset-2 col-md-6 col-xs-12">
                            <div class="container-fluid" style="text-align: center;">
                                    <img src="{{URL::asset('/images/google.png')}}" alt="company logo" title="">
                                <div class="col-md-10 col-sm-11 col-xs-12">
                                    <div class="row">
                                        <h3 class="post-title">{{$posting->title}}</h3>
                                        <h4 class="location">{{$posting->location}}</h4>
                                    </div>   
                                    <div class="row">
                                        <h3 class="post-company-name">{{$posting->company_name}}</h3>
                                        <h4 class="status" style="background-color: {{ $badges[mt_rand(0,2)]}};">
                                            
                                            @if(isset($posting->status))
                                                {{$posting->status}}
                                            @else
                                                Not Specified
                                            @endif
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            </li></a>
                        @endforeach
                        </ul>
                        <div class="col-md-12" style="text-align: center;">
                        <a href="{{URL::to('/search')}}"><button type="button" style="margin:0 auto;padding:10px 40px;font-weight: 600;letter-spacing: 1px;font-size: 18px"class="btn btn-info">BROWSE ALL JOBS</button></a>
                        </div>
                    </div>
                    
                
            </div>
    </section>
    
     <!-- Database info -->
        <section>
                 
            <div id="database-info" style="background-color:white;width:100%;height:221px;text-align: center;">
                <h1 class="database-info-title">Statistics</h1>
                <div class="container-fluid">
                    <!-- Jobs -->
                <div class="counter col-lg-2 col-lg-offset-2 col-md-3 col-xs-6">
                    <div class="row-fluid" style="text-align: center;"><h2 >{{$sizeOfJobs}} + </h2>
                    <div style="margin:20px auto;width:60px;height:2px;background-color:#23CCF3; "></div>
                    </div>

                    <div class="row-fluid"><h4>Jobs</h4></div>

                </div>

                <!-- Members -->
                <div class="counter col-lg-2  col-md-3 col-xs-6">
                    <div class="row-fluid" style="text-align: center;"><h2>{{$sizeOfMembers}} + </h2></div>
                    <div style="margin:20px auto;width:60px;height:2px;background-color:#23CCF3; "></div>
                    <div class="row-fluid"><h4>Members</h4></div>

                </div>

                <!-- Resumes -->
                <div class="counter col-lg-2 col-md-3 col-xs-6">
                    <div class="row-fluid" style="text-align: center;"><h2>{{$sizeOfResumes}} + </h2></div>
                    <div style="margin:20px auto;width:60px;height:2px;background-color:#23CCF3; "></div>
                    <div class="row-fluid"><h4>Resume</h4></div>

                </div>

                <!-- Companies -->
                <div class="counter col-lg-2 col-md-3 col-xs-6">
                    <div class="row-fluid" style="text-align: center;"><h2>{{$sizeOfCompanies}} + </h2></div>
                    <div style="margin:20px auto;width:60px;height:2px;background-color:#23CCF3; "></div>
                    <div class="row-fluid"><h4>Company</h4></div>

                </div>
                </div>
            </div>
        </section>


        <!-- HOW IT WORKS  -->
         <section>
             <div id="how-it-works">
                <div class="col-md-12">
                    <h3 style="float:left;margin: 0;font-size: 16px;">WORKFLOW</h3>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6" style="padding:0;">
                        <h1 style="font-size: 48px;font-weight: bold;">How it Works</h1>
                        <div class="btn-info col-xs-8 col-xs-offset-2" style="float:left;margin:20px auto;height:2px;"></div>
                        <div class="col-md-12" style="margin-top: 40px;text-align: center;">
                                <p class="how-it-works-text">Pellentesque et pulvinar orci. Suspendisse sed euismod purus. Pellentesque nunc ex, ultrices eu enim non, consectetur interdum nisl. Nam congue interdum mauris, sed ultrices augue lacinia in. Praesent turpis purus, faucibus in tempor vel, dictum ac eros.</p>
                            <br>
                            <p class="how-it-works-text">
                                Nulla quis felis et orci luctus semper sit amet id dui. Aenean ultricies lectus nunc, vel rhoncus odio sagittis eu. Sed at felis eu tortor mattis imperdiet et sed tortor. Nullam ac porttitor arcu. Vivamus tristique elit id tempor lacinia. Donec auctor at nibh eget tincidunt. Nulla facilisi. Nunc condimentum dictum mattis.
                            </p>
                            <button  type="submit" class="how-it-works-button btn btn-primary">LEARN MORE</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img src="{{URL::asset('/images/iphone.png')}}" class="img-responsive">
                    </div>
                </div>
            </div>
         </section>

         <!-- POPULAR CATEGORIES -->
        <section>
            <div id="popular-categories">
            <div class="col-md-12">
                <h2 class="text-center">CATEGORIES</h2>
                <h3 class="text-center">Popular Categories</h3>
                    <div style="margin:30px auto;width:60px;height:2px;background-color:#23CCF3; "></div>
                <h2 class="text-center">The most popular categories</h2>
            </div>
            <div class="col-md-12" style="margin:40px 0;height:auto;">
                @foreach ($categories as $category)
                <a href="{{route('filter-by-category',$category->cat_id)}}" style="text-decoration:none;">
                    <div class="category">
                        <div class="icon-div">
                            <div class="inner-icon-div">
                                <i class="{{$category->icon}}" aria-hidden="true"></i>
                            </div>
                        </div>
                        <h1 class="text-center" style="font-size: 28px;font-weight: bold;">{{$category->cat_name}}</h1>
                        <p class="text-center" >{{$category->cat_description}}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        </section>

        <!-- SUBSCRIBE -->

        <section>
            <div id="subscribe-section">
                <div style="width:100%;height:100%;background: rgba(0,0,0,0.5);padding:5px;">
                    <div class="col-md-12" style="padding:30px;">
                        <h3 class="text-center">Subscribe</h3>
                    </div>
                    <div class="col-md-12" style="margin:30px 0 0 0;">
                    <h3 class="text-center">Get weekly top new jobs delivered to your inbox</h3>
                    </div>
                    <div class="col-lg-6 col-lg-offset-3">
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="Your email address">
                          <span class="input-group-btn">
                            <button class="btn btn-success"  type="button">Subscribe</button>
                          </span>
                        </div>
                    </div>
                </div>
                
            
            </div>
        </section>

        <!-- FOOTER -->
        <footer class="site-footer">

      <!-- Top section -->
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-6">
            <h6>About</h6>
            <p class="text-justify">An employment website is a web site that deals specifically with employment or careers. Many employment websites are designed to allow employers to post job requirements for a position to be filled and are commonly known as job boards. Other employment sites offer employer reviews, career and job-search advice, and describe different job descriptions or employers. Through a job website a prospective employee can locate and fill out a job application.</p>
          </div>

          <div class="col-xs-6 col-md-3">
            <h6>Company</h6>
            <ul class="footer-links">
              <li><a href="page-about.html">About us</a></li>
              <li><a href="page-typography.html">How it works</a></li>
              <li><a href="page-faq.html">Help center</a></li>
              <li><a href="page-typography.html">Privacy policy</a></li>
              <li><a href="page-contact.html">Contact us</a></li>
            </ul>
          </div>

          <div class="col-xs-6 col-md-3">
            <h6>Trendeing jobs</h6>
            <ul class="footer-links">
              <li><a href="job-list.html">Front-end developer</a></li>
              <li><a href="job-list.html">Android developer</a></li>
              <li><a href="job-list.html">iOS developer</a></li>
              <li><a href="job-list.html">Full stack developer</a></li>
              <li><a href="job-list.html">Project administrator</a></li>
            </ul>
          </div>
        </div>

        <hr>
      </div>
      <!-- END Top section -->

      <!-- Bottom section -->
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-sm-6 col-xs-12">
            <p class="copyright-text">Copyrights © 2017 All Rights Reserved by <a href="{{URL::to('/')}}">ZeroGrad</a>.</p>
          </div>

          <div class="col-md-4 col-sm-6 col-xs-12">
            <ul class="social-icons">
              <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
              <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
              <li><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
      <!-- END Bottom section -->


        <!-- floating arrow -->
        <a href="#Container">        <div id="float-back" style="text-align:center; display:none; background-color:#23CCF3;width:70px;height:70px;opacity: 0.5">
            <i class="fa fa-arrow-up" aria-hidden="true" style="margin:0 auto;line-height:2;font-size:30px;color:white;"></i>
        </div></a>
@stop

@section('script_plugins')
    <script type="text/javascript">
        $(document).ready(function(){
             $(document).scroll(function(){
                    if($(document).scrollTop() > 216){
                        $('#float-back').fadeIn(800);
                        
                    }else{
                        $('#float-back').fadeOut(800);
                    }
             });
        });


        function submitSearch(){
            var keywords = $('#searchkeywords').val();
            var location = $('#searchlocation').val();
            if(location.length > 0 || keywords.length > 0){
                $('#search-form').submit();
            }else if(location.length == 0 || keywords.length == 0){
                swal('Please enter a keyword and/or location');                
            }
        }
    </script>
@stop