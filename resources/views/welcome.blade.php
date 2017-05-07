@extends('layout.header-layout')

@section('title')
    Zerograd
@stop

@section('content')
            @include('nav')
        <div id="Container">
            <form action="{{route('submit-search')}}" method="post">
            {{ csrf_field() }}
                <div class="search-header col-md-12 col-xs-12">
                    <h1 class="text-center">Start your search to gain worlds of experience. </h1>
                </div>
                <div class="search-boxes col-md-6 col-xs-12 col-md-offset-3">
                    <input class="col-md-8 col-xs-8 col-md-offset-2 col-xs-offset-2" type="text" name="searchkeywords" id="searchkeywords" placeholder="Keywords" />
                    <input class="col-md-8 col-xs-8 col-md-offset-2 col-xs-offset-2" type="text" name="searchlocation" id="searchlocation" placeholder="Location"/>
                </div>
                <div class="search-button-div col-md-12 col-xs-12">
                        <button class="white-btn" style="background-color:#354886;margin:10px auto;padding:5px 15px" type="submit">Search</button>
                        <a style="display:block;font-weight:bold;" class="advanced-search" href="#"> Advanced Search </a>
                </div>
            </form>
        </div>
        <div id="otherContainer">
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
        </div>  

@stop
