@foreach($postings as $posting)
                        <li class="recent-job" style="padding:40px;">
                        <div class="container-fluid">
                            <img src="{{URL::asset('/images/google.png')}}" style="float:left;width:60px;height:60px;" alt="company logo" title="">
                            <div class="col-md-11">
                                <div class="row">
                                    <h3 style="margin:0 40px;color:black;font-weight: bold;display:inline-block;float:left;">{{$posting->title}}</h3>
                                    <h4 style="margin:0;display:inline-block;color:#C6C6C6;font-weight: bold;float:right;">{{$posting->location}}</h4>
                                </div>
                                <div class="row" style="margin-top:20px;">
                                    
                                    <h3 style="margin:0 40px;color:black;display:inline-block;float:left;">{{$posting->company_name}}</h3>
                                    <h4 style="margin:0;display:inline-block;padding:5px;color:#FFFFFF;font-weight: bold;float:right;text-transform: uppercase;font-size:14px;background-color: {{ $badges[mt_rand(0,2)]}};">{{$posting->status}}</h4>
                                </div>
                            </div>
                        </div>
                        </li>
@endforeach