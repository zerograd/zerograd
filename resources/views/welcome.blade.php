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