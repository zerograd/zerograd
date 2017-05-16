
 
        

        
        
    
    
        
          <div  style="margin:50px 0;height:100%;border:1px solid #354886;border-radius: 10px;padding:10px;background-color: #FFFFFF;">
                <div class="row" style="text-align: center;margin-top: 15px;">
                    <img class="center-block img-responsive" style="width: 200px;height: 155px;float: left;margin:0 40px;" src="{{URL::asset('/images/nasa.png')}}" alt="Company Photo">
                    <div class="row" style="text-align: left;float:left;">
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
                
                <div class="row" style="text-align: center;">
                    <h4 class="text-center" style="display:block;margin:0 auto;font-weight: bold;">
                        Job Description:
                    </h4>
                </div>
                <div class="row" style="text-align: center;">
                    <div class="col-sm-8 col-sm-offset-2">
                        <p style="font-weight: bold;">{{$posting->description}}<p>
                    </div>
                </div>
            </div>
        <input type="text" style="visibility: hidden" value="{{$keywords}}" id="searchkeywords" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            // function backToResults(){
            //     var keywords = $('#searchkeywords').val();
            //     $.post('{{route('submit-search')}}',{

            //     },function(data){

            //     });
            // }
        </script>
        
    

