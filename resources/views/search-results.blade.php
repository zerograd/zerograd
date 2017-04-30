<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>ZeroGrad</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <!-- Styles -->
        {{ HTML::style('css/styles.css') }}
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
        </style>
        <script>
  $( function() {
    $( "#slider" ).slider({
      value:0,
      min: 0,
      max: 3,
      step: 1,
      slide: function( event, ui ) {

        postExperience(ui);
        $( "#amount" ).text( 'Years of Experience: ' + ui.value );
      }
    });
    $( "#amount" ).text( 'Years of Experience: ' + $( "#slider" ).slider( "value" ) );
  } );
 $( function() {
    $( "#slider-distance" ).slider({
      value:0,
      min: 0,
      max: 100,
      step: 25,
      slide: function( event, ui ) {
         // postFilter(ui);
        $( "#distance" ).text( 'Distance: ' + ui.value );
      }
    });
    $( "#distance" ).text( 'Distance: ' + $( "#slider-distance" ).slider( "value" ) );
  } );

  </script>
    </head>
    <body>
        <div id="header">
            <a href="{{URL::to('/')}}"><h1 id="logo" style="margin:0;padding:15px; color:white;display:block;">Zer<span class="zeroLogo">0</span>Grad</h1></a>
        </div>
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
                <div id="filters" class="col-md-2" style="border-right:1px solid grey;height:100%;">
                    <div id="relevance-div" class="col-sm-12" style="height:33%;line-height: 2;">
                        <label>Sort By:</label>
                        <select id="relevance" style="color:#5CF0EF;font-weight: bold;">
                            <option value="relevance" style="color:#5CF0EF;font-weight: bold;">Relevance</option>
                            <option value="date" style="color:#5CF0EF;font-weight: bold;">Recent</option>
                        </select>
                    </div>
                    <div id="radius" class="col-sm-12" style="height:33%;line-height: 2;">
                        <label id="distance"></label>
                        <div id="slider-distance" style="background-color: #5CF0EF;"></div>
                    </div>
                    <div id="experience" class="col-sm-12" style="height:33%;line-height: 2;">
                        <label id="amount">Years of Experience:</label>
                        <div id="slider" style="background-color: #5CF0EF;"></div>
                    </div>
                </div>
                <div id="results-area" class="col-md-10 scroll" style="height:100%;text-align: center;overflow-y: scroll;">
                <div class="loader" style="display:none;position: absolute;z-index:1;top:40%;left:40%;"></div>
                    @if($found == "yes")
                    <ul id="results" class="col-sm-12" style="list-style: none;margin:0;padding: 0;">
                        @include('results')
                    </ul>
                    @else
                    <ul id="results" class="col-sm-12" style="list-style: none;margin:0;padding: 0;">
                        <li class="col-sm-12">
                                <div class="col-sm-6"><h5> <strong>NO RESULTS FOUND</strong></h5></div>
                        </li>
                    </ul>
                    @endif
                </div>
        </div> 
        <div id="otherContainer">

        </div>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
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
                    'experience': ui.value
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
        </script>

    </body>
</html>
