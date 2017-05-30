
@extends('layout.header-layout')

@section('title')
  {{$posting->title}}
@stop

@section('styles')
    <style type="text/css">
        #navigation {
            background-color: #354886;
        }
        h1,h2,p{
            color:black;
            font-weight: 600;
        }
    </style>

@stop
@section('content')
    @include('nav')
    <div class="container-fluid">
        <div class="col-sm-3" style="height:100%;text-align:center;border-right:1px solid black;">
            <div class="col-sm-12" style="margin-top:40px;">
            <img class="center-block" style="width: 200px;height: 155px;margin:0 auto;" src="{{URL::asset('/images/nasa.png')}}" alt="Company Photo">
            </div>
            <div class="col-sm-12" style="padding:20px;">
                <h1>{{$posting->title}}</h1>
                <a href="{{route('company-get',$posting->companyID)}}" class="no-hover"><h2>{{$posting->company_name}}</h2></a>
                <h3 style="font-weight: bold">REQUIRED EXPERIENCED: {{$posting->required_experience}} years</h3>
                <h4 style="font-weight: bold">Job Type: {{$posting->status}}</h4>
                <p style="font-weight: bold">Location: {{$posting->location}}</p>
                <p style="font-weight: bold">Keywords: {{$posting->keywords}}</p>
                
                <p style="font-weight: bold">Posted: {{$posting->posted_date}}</p>
                
            </div>
            <div id="buttons" class="col-sm-12">
                <button style="margin:0 auto" class="btn btn-primary waves-effect waves-teal">Apply Now</button>
                @if($saved > 0)
                    <button style="margin:0 auto" class="btn btn-primary waves-effect waves-teal" type="button" onClick="unsaveJob(this);">Saved</button>
                @else
                    <button style="margin:0 auto" class="btn btn-primary waves-effect waves-teal" type="button" onClick="saveJob(this);">Save this Job</button>
                @endif
                
            </div>
            <div class="col-sm-12" style="margin-top: 40px;">
                <span class="number number-primary"><i class="fa fa-facebook" aria-hidden="true"></i>
                </span>
                <span class="number number-primary"><i class="fa fa-twitter" aria-hidden="true"></i>
                </span>
                <span class="number number-primary"><i class="fa fa-instagram" aria-hidden="true"></i>
                </span>
                <span class="number number-primary"><i class="fa fa-linkedin" aria-hidden="true"></i>
                </span>
            </div>
        </div>
        <div class="col-sm-9">
            <h2>Job Description:</h2>
            <div class="col-sm-12">
                <p>{{$posting->description}}</p>
            </div>
        </div>
    </div>

    <input type="text" name="post_id" id="post_id" value="{{$post_id}}" hidden>
@stop

@section('script_plugins')
    <script type="text/javascript">
        function saveJob(button){
            $.post('{{route('save-job',$posting->id)}}',{_token:"{{csrf_token()}}"},function(data){
                if(data == 1){
                    $(button).text('Saved');
                    $(button).attr('onClick','unsaveJob(this)');
                }else{
                    alert('Please Login to save this Job');
                }  
            });
        }

        function unsaveJob(button){
            $.post('{{route('unsave-job',$posting->id)}}',{_token:"{{csrf_token()}}"},function(data){
                if(data == 1){
                    $(button).text('Save this Job');
                     $(button).attr('onClick','saveJob(this)');
                }  
            });
        }
    </script>
@stop