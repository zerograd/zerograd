@foreach ($postings as $posting)
                            <li class="col-sm-12" style="height:150px;">
                                <div class="col-sm-2" style="height:100%">
                                	<img class="img-responsive" style="height:100%" src="{{URL::asset('/images/nasa.png')}}"/>
                                </div>
                                <div class="col-sm-10">
                                	<div class="col-sm-12">
                                		<h4 style="display:block;float:left;">{{$posting->title}}</h4>
                                	</div>
                                	<div class="col-sm-6"><h5 style="display: block;float: left;"><a href="{{route('company-get',$posting->company_id)}}"><strong style="text-transform: capitalize;">{{$posting->company_name}} - </strong></a>
                                	<span>{{$posting->location}}</span>
                                	</h5></div>
	                                <div class="col-sm-6"><h5 style="display: block;
    float: right;">Posted: <strong>{{$posting->posted_date}}</strong></h5></div>
	                                <div class="col-sm-6 keywords"><h5 style="display: block;float: left;">Keywords: <strong>{{$posting->keywords}}</strong></h5></div>
	                                <div class="col-sm-6 keywords"><h5 style="display: block;float: right;"><strong>REQUIRED EXPERIENCE: {{$posting->required_experience}} years</strong></h5></div>
                                </div>
                            </li>
@endforeach