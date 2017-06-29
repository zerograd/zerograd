
@foreach($postings as $posting)
                    <a href="{{$posting->url}}" style="text-decoration: none;color:black;" target="_blank">    
                        <div class="container-fluid recent-job">
                            <img src="{{URL::asset('/images/google.png')}}" style="float:left;width:60px;height:60px;" alt="company logo" title="">
                            <div class="col-md-11">
                                <div class="row">
                                    <h3 style="margin:0 40px;color:black;font-weight: bold;display:inline-block;float:left;">{{$posting->jobtitle}}</h3>
                                    <h4 style="margin:0;display:inline-block;color:#C6C6C6;font-weight: bold;float:right;">{{$posting->city}}</h4>
                                </div>
                                <div class="row" style="margin-top:20px;">
                                    
                                    <h3 style="margin:0 40px;color:black;display:inline-block;float:left;">{{$posting->company}}</h3>
                                    <h4 style="margin:0;display:inline-block;padding:5px;color:#FFFFFF;font-weight: bold;float:right;text-transform: uppercase;font-size:14px;background-color: {{ $badges[mt_rand(0,2)]}};">
                                            
                                            @if(isset($posting->jobtype))
                                                {{$posting->jobtype}}
                                            @else
                                                Not Specified
                                            @endif</h4>
                                </div>
                            </div>
                        </div>
                    </a>
@endforeach

@if($numberOfPages > $page )
 <button id="loadmorebutton" type="button" onclick="loadMore();" class="loadmorebutton btn btn-block btn-primary">Load More Jobs</button>
@endif