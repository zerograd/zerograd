<div  style="margin:50px 0;height:100%;border:1px solid #354886;border-radius: 10px;padding:10px;">
                <div class="row" style="text-align: center;margin-top: 15px;">
                    <img class="center-block img-responsive" style="width: 200px;height: 155px;float: left;margin:0 40px;" src="{{URL::asset('/images/nasa.png')}}" alt="Company Photo">
                </div>
                <div class="row" style="text-align: left;">
                        <h4>{{$posting->title}}</h4>
                        <a href="{{route('company-get',$posting->companyID)}}" class="no-hover"><h5>{{$posting->company_name}}</h5></a>
                        <p style="font-weight: bold">Location: {{$posting->location}}</p>
                        <p style="font-weight: bold">Keywords: {{$posting->keywords}}</p>
                        <p style="font-weight: bold">REQUIRED EXPERIENCED: {{$posting->required_experience}}</p>
                        <p style="font-weight: bold">Posted: {{$posting->posted_date}}</p>
                        <button style="margin:0 auto" class="btn waves-effect waves-teal">Save this Job</button>
                        <button style="margin:0 auto" class="btn waves-effect waves-teal">Apply Now</button>
                        <button style="margin:0 auto" class="btn waves-effect waves-teal">Share!</button>
                </div>
</div>