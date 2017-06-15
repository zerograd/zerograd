<nav id="navigation" class="navbar" style="margin-bottom: 0;">
  <div class="container-fluid">
    <div class="navbar-header col-md-3" style="margin:0;">
      <button type="button" class="navbar-toggle white-btn" data-toggle="collapse" data-target="#myNavbar" style="z-index: 1">
        <span class="icon-bar" style="color:white;"></span>
        <span class="icon-bar" style="color:white;"></span>
        <span class="icon-bar" style="color:white;"></span>                        
      </button>
       <a href="{{URL::to('/')}}"><h1 id="logo" style="margin:0;padding:15px; color:white;display:block;" class="text-xs-center">Zer<span class="zeroLogo">0</span>Grad</h1></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar" style="margin: 0;">
      <div class="col-md-9" style="padding: 0;">
        <ul class="navigation nav navbar-nav">
          <li><a href="{{URL::to('/about')}}"><button class="white-btn user-btn">About</button></a></li>
          <li><a><button class="white-btn user-btn">Contact Us</button></a></li>
          @if(!Session::has('user_id') and !Session::has('employer_id') )
                    <li class="col-md-3 col-xs-4"><a href="{{URL::to('/login')}}"><button class="white-btn">LOGIN</button></a></li>
                    <li class="col-md-3 col-xs-4"><a href="{{URL::to('/student-register')}}"><button class="white-btn">Register</button></a></li>
                    <li class="col-md-3 col-xs-4"><a href="{{URL::to('/employer-register')}}"><button class="white-btn">Employer?</button></a></li>
                    @else 
                      @if(Session::has('user_id'))
                    <li><a href="{{URL::to('/student/home')}}"><button class="white-btn user-btn"><b>Logged in as:</b>{{Session::get('student_name')}}</button></a></li>
                    @else
                    <li><a href="{{URL::to('/employer/home')}}"><button class="white-btn user-btn"><b>Logged in as:</b> {{Session::get('company_name')}}</button></a></li>
                    @endif
          @endif
        </ul>
      </div>
    </div>
  </div>
</nav>