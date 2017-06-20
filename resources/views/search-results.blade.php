
@extends('layout.header-layout')

@section('title')
    Results
@stop

@section('styles')
    <style>

           

           #Container{
             height:100%;
           }

            #results .recent-job  {
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
            position: fixed;
            width:100%;
             z-index: 2;
        }

        .navigation button {
            border:1px solid white;
        }

        #otherContainer {
            height:50px;
        }

        select {
            
        }
        select,option {
            font-weight: 600;
        }
        
        label{
            margin-top: 30px;
        }
        .location {
            margin-bottom: 10px;
        }
        .location {
            display: block;
            height: 34px;
            padding: 6px 12px;
            font-size: 16px;
            line-height: 1.42857143;
            color: black;
            font-weight: 600;
            background-color: #fff;
            background-image: none;
            border: 1px solid #ccc;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
            -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        }

        .location::placeholder{
            font-size: 12px;
        }

        #job-types li ,
        #years li {
            height:40px;
        }
        /*Checkbox CSS*/
        
        .customcheckbox {
            display:inline-block;
            width:20px;
            height: 20px;
            border:1px solid grey;
            border-radius: 2px;
            cursor:pointer;
        }
        .innerspan {
            background-color: #2980b9;
            height:100%;
            padding: 2px;
        }

        .checkmark {
            position: absolute;
            color:white;
        }

        .checkboxlabel{
            display:inline-block;
            color:black;
            font-weight: 600;
            margin-left:10px;
            margin-right:4px;
            text-align: center;
            
        }
        
        .salary,.salary::placeholder{
           font-size: 16px;
           color:black;
           font-weight:600; 
        }
                </style>
@stop

      
        @section('content')
            <!-- @include('nav') -->
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
                 <div class="container-fluid">
                    <div id="filters" class="col-md-2 scroll" style="padding-top:77px;border-right:1px solid grey;height:100%;overflow-y: scroll">
                    <div class="form-group">
                        <label>Sort By</label>
                        <select name="date" id="date" class="form-control">
                            <option value="newest">Newest</option>
                            <option value="relevance">Relevance</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select name="category" id="category" class="form-control">
                            <option value="All" selected>All</option>
                            @foreach($categories as $category)
                                <option value="{{$category->cat_id}}">{{$category->cat_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Location</label>
                        <input name="location" id="location" placeholder="City" class="form-control" style="margin-bottom: 10px;color:black;font-weight: 600;">
                    </div>
                    <div class="form-group">
                        <label>Job Type</label>
                        <div  class="col-xs-12">
                            <ul id="job-types" style="list-style: none;margin:0;padding: 0;">
                                <li>
                                   <div class="customcheckbox anytype type" onClick="onCustomCheckbox(this);">
                                   </div>
                                   <label class="checkboxlabel">All</label>
                                </li>
                                <li>
                                   <div class="customcheckbox type" onClick="onCustomCheckbox(this);">
                                   </div>
                                   <label class="checkboxlabel">Full-Time</label>
                                </li>
                                <li>
                                   <div class="customcheckbox type" onClick="onCustomCheckbox(this);">
                                   </div>
                                   <label class="checkboxlabel">Part-Time</label>
                                </li>
                                <li>
                                   <div class="customcheckbox type" onClick="onCustomCheckbox(this);">
                                   </div>
                                   <label class="checkboxlabel">Permanent</label>
                                </li>
                                <li>
                                   <div class="customcheckbox type" onClick="onCustomCheckbox(this);">
                                   </div>
                                   <label class="checkboxlabel">Internship</label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Years of Experience</label>
                        <div  class="col-xs-12">
                            <ul id="years" style="list-style: none;margin:0;padding: 0;">
                                <li>
                                   <div class="customcheckbox anyyears years" onClick="onCustomCheckboxYears(this);">
                                   </div>
                                   <label class="checkboxlabel" value="Any">Any</label>
                                </li>
                                <li>
                                   <div class="customcheckbox years" onClick="onCustomCheckboxYears(this);">
                                   </div>
                                   <label class="checkboxlabel" value="1">1 Year</label>
                                </li>
                                <li>
                                   <div class="customcheckbox years" onClick="onCustomCheckboxYears(this);">
                                   </div>
                                   <label class="checkboxlabel" value="2">2 Years</label>
                                </li>
                                <li>
                                   <div class="customcheckbox years" onClick="onCustomCheckboxYears(this);">
                                   </div>
                                   <label class="checkboxlabel" value="3">3 Years</label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Salary</label>
                        <input name="from" id="from" type="number" style="font-size: 16px;color:black;font-weight:600;" class="salary form-control col-md-6" placeholder="Min.">
                        <input name="to" id="to" type="number" class="salary form-control col-md-6" style="margin-bottom: 10px;font-size: 16px;color:black;font-weight:600;" placeholder="Max.">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-block" type="button" onClick="filter();" >Search</button>
                    </div>
                </div>
                @endif

                @if($found == "yes" && isset($found))
                <div id="results-area" class="col-md-10 scroll" style="padding-top:77px;height:100%;text-align: center;overflow-y: scroll;">
                @else
                <div id="results-area" class="col-md-12 scroll" style="padding-top:77px;height:100%;text-align: center;overflow-y: scroll;">
                    @endif
                    <div class="loader" style="display:none;position: absolute;z-index:1;top:40%;left:40%;"></div>
                        @if($found == "yes" && isset($found))
                        
                            <h2 id="resultssize">Found {{$numberOfResults}} @if($numberOfResults > 1) results @else result @endif</h2>
                            <div id="results" class="col-sm-12" style="list-style: none;margin:0;padding: 0;">
                            @include('results')
                            </div>
                        
                        @else
                        <div class="row-fluid">
                            <ul id="results" class="col-sm-12 scroll" style="list-style: none;margin:0;padding: 0;">
                                <li class="col-sm-12">
                                        <div class="col-sm-12"><h5> <strong>NO RESULTS FOUND</strong></h5></div>
                                </li>
                                <a href="{{URL::to('/')}}"><button class="btn waves-effect waves-teal " style="margin:10px;font-weight: bold;">Return to Home and Try a new search.</button></a>
                            </ul>
                        </div>
                        @endif
                        <input type="text" style="visibility: hidden" value="{{$keywords}}" id="searchkeywords" />
                        <input type="text" hidden value="{{$page}}" id="page" />
                        <input type="text" hidden value="{{$limit}}" id="limit" />
                    </div>
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
            
      
        <script type="text/javascript">
            $(document).ready(function(){
                var preCheckedBox = $('.anytype')[0];
                onCustomCheckbox(preCheckedBox);
                var preCheckedBox = $('.anyyears')[0];
                onCustomCheckboxYears(preCheckedBox);
            });
            function loadMore(){
                var page = Number($('#page').val()) + 1;
                $('#page').val(page);
                var jobs = $('#job-types').find('.customcheckbox.checked');
                var jobsList = '';
                var date = $('#date').val();
                var location = $('#location').val();
                jobs.each(function(){
                    var title = $(this).parent().find('label').text();
                    jobsList = jobsList + title + " ";
                });
                if(jobsList.length == 0){
                    alert('Please select a job type.');
                    return false;
                }
                //Get all experience
                var levels = $('#years').find('.customcheckbox.checked');
                var levelsList = '';
                levels.each(function(){
                    var title = $(this).parent().find('label').attr('value');
                    levelsList = levelsList + title + " ";
                });
                if(levelsList.length == 0){
                    alert('Please select an experience level.');
                    return false;
                }

                // var li = $('#results li');
                // li.each(function(){
                //     $(this).hide();
                // });
                

                var from  = $('#from').val();
                var to  = $('#to').val();
                var category = $('#category').val();
                $.post('{{route('load-more')}}',{page:page,limit:$('#limit').val(),category:category,jobtypes:jobsList,levels:levelsList,location:location,date:date,from:from,to:to,_token:"{{csrf_token()}}"},function(data){
                        $('.loadmorebutton').remove();
                        $('#results').append($(data));
                });
            }

            function filter(){

                //Get all selected job types
                var jobs = $('#job-types').find('.customcheckbox.checked');
                $('#page').val(1);
                var jobsList = '';
                var date = $('#date').val();
                var location = $('#location').val();
                jobs.each(function(){
                    var title = $(this).parent().find('label').text();
                    jobsList = jobsList + title + " ";
                });
                if(jobsList.length == 0){
                    alert('Please select a job type.');
                    return false;
                }
                //Get all experience
                var levels = $('#years').find('.customcheckbox.checked');
                var levelsList = '';
                levels.each(function(){
                    var title = $(this).parent().find('label').attr('value');
                    levelsList = levelsList + title + " ";
                });
                if(levelsList.length == 0){
                    alert('Please select an experience level.');
                    return false;
                }

                $('.recent-job').hide();
                
                $(".loader").show();

                var from  = $('#from').val();
                var to  = $('#to').val();
                var category = $('#category').val();
                $.post('{{route('filter-results')}}',{category:category,jobtypes:jobsList,levels:levelsList,location:location,date:date,from:from,to:to,_token:"{{csrf_token()}}"},function(data){
                    var results = data.numberOfResults
                    if(results > 1){
                        $('#resultssize').text('Found ' + results + ' results');
                    }else if(results == 1){
                        $('#resultssize').text('Found ' + results + ' result');
                    }else{
                        $('#resultssize').text('Found ' + 0 + ' results');
                    }
                    $('#limit').val(data.limit);
                    setTimeout(function(){
                        $(".loader").hide();
                        $('#results').html(data.view);
                    },200);
                });
            }
            function onCustomCheckbox(element){
                if($(element).hasClass('anytype') == true && $(element).hasClass('checked') == false){
                    $('.checked').each(function(){
                        if(!$(this).hasClass('years')){
                            var check = $($(this).children()[0]);
                            check.remove();
                            $(this).removeClass('checked');
                        }
                        
                    });
                }
                if($('.anytype').hasClass('checked') == true && $(element).hasClass('checked') == false ){
                    var check = $($('.anytype').children()[0]);
                        check.remove();
                        $('.anytype').removeClass('checked');
                }

                if($(element).hasClass('checked') == true){
                    var check = $($(element).children()[0]);
                    check.remove();
                    $(element).removeClass('checked');
                    return true;
                }
                var span = element;
                var innerspan = $('<div class="innerspan"><i class="fa fa-check checkmark" aria-hidden="true"></i></div>');
                $(span).append(innerspan);
                $(span).addClass('checked');
                // $(span).css('background-color','#23CCF3');
            }
            function onCustomCheckboxYears(element){
                if($(element).hasClass('anyyears') == true && $(element).hasClass('checked') == false){
                    $('.checked').each(function(){
                        if(!$(this).hasClass('type')){
                            var check = $($(this).children()[0]);
                            check.remove();
                            $(this).removeClass('checked');
                        }
                    });
                }
                if($('.anyyears').hasClass('checked') == true && $(element).hasClass('checked') == false ){
                    var check = $($('.anyyears').children()[0]);
                        check.remove();
                        $('.anyyears').removeClass('checked');
                }

                if($(element).hasClass('checked') == true){
                    var check = $($(element).children()[0]);
                    check.remove();
                    $(element).removeClass('checked');
                    return true;
                }
                var span = element;
                var innerspan = $('<div class="innerspan"><i class="fa fa-check checkmark" aria-hidden="true"></i></div>');
                $(span).append(innerspan);
                $(span).addClass('checked');
                // $(span).css('background-color','#23CCF3');
            }
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
                    
                    if(data == "No Results"){
                        $('#results').html('No Results were Found. Try a different search.');
                    }else{
                         setTimeout(function(){
                        $(".loader").hide();
                        $('#results').html(data);
                        },200);
                    }   
                      
                 });
                    
                    
            }
            

        $(function () {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
            });
        });

        function showPost(id){
           
        }

        function closeOverlay(){
            $('#post-overlay').hide();
        }

        </script>
        @stop
