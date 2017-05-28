
@extends('layout.header-layout')

@section('title')
    Results
@stop

@section('styles')
    <style>

            #Container{
                height:85%;
            }
            #results li  {
                    border: 1px solid #ddd; /* Add a border to all links */
                    margin-top: -1px; /* Prevent double borders */
                    background-color: #f6f6f6; /* Grey background color */
                    padding: 12px; /* Add some padding */
                    text-decoration: none; /* Remove default text underline */
                    font-size: 18px; /* Increase the font-size */
                    color: black; /* Add a black text color */
                    display: block; /* Make it into a block element to fill the whole list */
            }
            .loader {
            border: 16px solid #f3f3f3; /* Light grey */
            border-top: 16px solid #3498db; /* Blue */
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
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
        .posting:hover {
            text-decoration: none;
            color:black;
        }
        .no-hover:hover{
            text-decoration: none;
            color:black;
        }

        .btn {
            background-color: #26a69a;
            color:white;
        }

        #navigation {
            background-color:#354886; 
        }

        .navigation button {
            border:1px solid white;
        }

        #otherContainer {
            height:50px;
        }
        </style>
@stop

@section('style_plugins')
    
@stop        
        @section('content')
            @include('nav');
        <div id="Container">
                  <div class="preloader-wrapper big active">
                    <div class="spinner-layer spinner-blue-only">
                      <div class="circle-clipper left">
                        <div class="circle"></div>
                      </div><div class="gap-patch">
                        <div class="circle"></div>
                      </div><div class="circle-clipper right">
                        <div class="circle"></div>
                      </div>
                    </div>
                  </div>
                  @if($found == "yes" && isset($found))
                <div id="filters" class="col-md-2" style="border-right:1px solid grey;height:100%;">
                    <h1>Years of Experience</h1>
                    <div id="radios">
                        <input class="years" id="option1" name="options" type="radio" value="1">
                        <label for="option1">1 year</label>
                        <input class="years" id="option2" name="options" type="radio" value="2">
                        <label for="option2">2 years</label>
                        <input  class="years" id="option3" name="options" type="radio" value="3">
                        <label for="option3">3 years</label>
                    </div>
                </div>
                @endif

                @if($found == "yes" && isset($found))
                <div id="results-area" class="col-md-10 scroll" style="height:100%;text-align: center;overflow-y: scroll;">
                @else
                <div id="results-area" class="col-md-12 scroll" style="height:100%;text-align: center;overflow-y: scroll;">
                @endif
                <div class="loader" style="display:none;position: absolute;z-index:1;top:40%;left:40%;"></div>
                    @if($found == "yes" && isset($found))
                    <ul id="results" class="col-sm-12" style="list-style: none;margin:0;padding: 0;">
                        @include('results')
                    </ul>
                    @else
                    <ul id="results" class="col-sm-12" style="list-style: none;margin:0;padding: 0;">
                        <li class="col-sm-12">
                                <div class="col-sm-12"><h5> <strong>NO RESULTS FOUND</strong></h5></div>
                        </li>
                        <a href="{{URL::to('/')}}"><button class="btn waves-effect waves-teal " style="margin:10px;font-weight: bold;">Return to Home and Try a new search.</button></a>
                    </ul>
                    @endif
                    <input type="text" style="visibility: hidden" value="{{$keywords}}" id="searchkeywords" />
                </div>
        </div> 
        
        
        <div id="post-overlay" style="display:none;position:absolute;z-index:3;top:0;left:0;width:100%;height:100%;background: rgba(0,0,0,0.8);">
            <div class="container">
                
            </div>
            <div style="position:absolute;top:0;right:10px;" id="close-overlay" onClick="closeOverlay();">
                <button type="button" class="btn btn-danger">X</button>
            </div>
        </div>
        @stop
        @section('script_plugins')
            <script>
            $('#radios').radiosToSlider({
                animation: true,
            });

            $('#radios').click(function(){
                console.log($('.slider-bar.transition-enabled').width());
            });
      </script>
        <script type="text/javascript">
        
            function postExperience(ui){
                var li = $('#results li');
                li.each(function(){
                    $(this).hide();
                });
                
                $(".loader").show();
                

                var data = {
                    "_token": "{{ csrf_token() }}",
                    'relevance' : $('#relevance').val(),
                    'distance' : $('#slider-distance').slider("value"),
                    'experience': ui.value,
                    'searchkeywords' : $('#searchkeywords').val() 
                 }

                 $.post('{{route('filter-results')}}',data,function(data){
                    
                    setTimeout(function(){
                        $(".loader").hide();
                        $('#results').html(data);
                    },200);
                      
                 });
            }
            

        $(function () {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
            });
        });

        function showPost(id){
            $.post('{{route('posting-get')}}',{
                "_token": "{{ csrf_token() }}", 
                id:id
            },function(data){
                $('#post-overlay').show();
                $('#post-overlay .container').html(data);
            })
        }

        function closeOverlay(){
            $('#post-overlay').hide();
        }

        </script>
        @stop
