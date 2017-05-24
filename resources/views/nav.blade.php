<nav id="navigation" class="navbar" style="">
  <div class="container-fluid">
    <div class="navbar-header col-md-3">
      <button type="button" class="navbar-toggle white-btn" data-toggle="collapse" data-target="#myNavbar" style="z-index: 1">
        <span class="icon-bar" style="color:white;"></span>
        <span class="icon-bar" style="color:white;"></span>
        <span class="icon-bar" style="color:white;"></span>                        
      </button>
       <a href="{{URL::to('/')}}"><h1 id="logo" style="margin:0;padding:15px; color:white;display:block;" class="text-xs-center">Zer<span class="zeroLogo">0</span>Grad</h1></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <div class="col-md-3" style="padding: 0;">
        <ul class="navigation nav navbar-nav" style="padding:20px;">
          <li><a href="{{URL::to('/about')}}" style="font-size:18px;">About</a></li>
          <li><a style="font-size:18px;">Contact Us</a></li>
        </ul>
      </div>
      <div class="col-md-5" style="padding: 0;">
        <ul class="navigation nav navbar-nav" style="float:right;padding:15px;">
          @if(!Session::has('user_id'))
                    <li><a href="{{URL::to('/login')}}"><button class="white-btn">LOGIN</button></a></li>
                    <li style="padding:40px 0;">or</li>
                    <li style="padding:20px 0;"><a href="{{URL::to('/student-register')}}">register</a></li>
                    <li><a href="{{URL::to('/employer-register')}}"><button class="white-btn">Employer?</button></a></li>
                    @else
                    <li><a href="{{URL::to('/student/home')}}"><button class="white-btn">{{Session::get('student_name')}}</button></a></li>
          @endif
        </ul>
      </div>
    </div>
  </div>
</nav>