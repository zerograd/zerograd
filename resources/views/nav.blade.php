<nav id="navigation" class="navbar" style="background-color: #354886;">
              <div class="container-fluid">
                <div class="navbar-header col-md-7">
                  <button type="button" class="navbar-toggle white-btn" data-toggle="collapse" data-target="#myNavbar" style="z-index: 1">
                    <span class="icon-bar" style="color:white;"></span>
                    <span class="icon-bar" style="color:white;"></span>
                    <span class="icon-bar" style="color:white;"></span>                        
                  </button>
                   <a href="{{URL::to('/')}}"><h1 id="logo" style="margin:0;padding:15px; color:white;display:block;" class="text-xs-center">Zer<span class="zeroLogo">0</span>Grad</h1></a>
                </div>
                <div class="collapse navbar-collapse col-md-4" id="myNavbar">
                  <ul class="navigation nav navbar-nav">
                    <li style="text-align: center;"><a href="{{URL::to('/about')}}">About</a></li>
                    <li><a>Contact Us</a></li>

                    @if(!Session::has('user_id'))
                    <li><a href="{{URL::to('/student-login')}}"><button class="white-btn">Login</button></a></li>
                    <li><a><button class="white-btn">Employer?</button></a></li>
                    @else
                    <li><a href="{{URL::to('/student/home')}}"><button class="white-btn">{{Session::get('student_name')}}</button></a></li>
                    @endif
                    
                    </ul>
                </div>
              </div>
            </nav>