<div class="header">
    <nav class="navbar  fixed-top navbar-site navbar-light bg-light navbar-expand-md"
         role="navigation">
        <div class="container">

            <div class="navbar-identity">
               {{--  <a href="{{url('/home')}}" class="navbar-brand logo logo-title" style="padding-top: 5px;">
                    <img alt="img" src="{{url('/assets/images/logo/isp_logo.png')}}"> --}}
                <span class="logo-icon">
                    <img alt="img" src="{{url('/assets/images/logo/isp_logo.png')}}">
                </a>
            </div>

            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav ml-auto navbar-right">
                    <li class="dropdown no-arrow nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <span>{{ Auth::user()->full_name }}</span> <i class="icon-down-open-big fa"></i>
                        </a>
                        <ul class="dropdown-menu user-menu dropdown-menu-right">{{-- 
                            <li class="active dropdown-item">
                                <a href="#"><i class="icon-home"></i> Personal Home </a>
                            </li> --}}
                            {{-- @if (Auth::user()->user_type == 'admin') --}}
                            <li class="dropdown-item">
                                <a href="{{url('/users')}}"><i class="fas fa-sign-in-alt"></i> User Management </a>
                            </li> 
                            {{-- @endif --}}
                            <li class="dropdown-item">
                                <a href="{{url('/logout')}}"><i class="fas fa-sign-out-alt"></i> Logout </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
</div>
<!-- /.header -->