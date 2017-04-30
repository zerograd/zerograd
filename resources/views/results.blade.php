@foreach ($postings as $posting)
                            <li class="col-sm-12" style="height:100px;">
                                <div class="col-sm-2" style="height:100%">
                                	<img class="img-responsive" style="height:100%" src="{{URL::asset('/images/nasa.png')}}"/>
                                </div>
                                <div class="col-sm-10">
                                	<div class="col-sm-6"><h5 style="display: block;float: left;"><strong style="text-transform: capitalize;">{{$posting->company_name}}</strong></h5></div>
	                                <div class="col-sm-6"><h5 style="display: block;
    float: right;">Posted: <strong>{{$posting->posted_date}}</strong></h5></div>
	                                <div class="col-sm-12 keywords"><h5 style="display: block;float: left;">Keywords: <strong>{{$posting->keywords}}</strong></h5></div>
                                </div>
                            </li>
@endforeach