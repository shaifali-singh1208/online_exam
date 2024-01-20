<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('home') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Admin Dashboard</span>
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="icon-layout menu-icon"></i>
              <span class="menu-title">Reading Test</span>
              <i class="menu-arrow"></i>
            </a>

            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{url('paragraph')}}">Reading </a></li>
                <!-- {{-- <li class="nav-item"> <a class="nav-link" href="#">Dropdowns</a></li>
                <li class="nav-item"> <a class="nav-link" href="#">Typography</a></li> --}} -->
              </ul>
            </div>
          </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <i class="fa-duotone fa fa-book-open-reader menu-icon"></i> <span class="menu-title">Written Test</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ url('test_write') }}"> Written Test </a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false" aria-controls="error">
            <i class="icon-ban menu-icon"></i>
            <span class="menu-title">Speaking Test</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="error">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="{{url('speak')}}"> Speaking </a></li>
            </ul>
          </div>
        </li>
        <div class="collapse" id="icons">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/icons/mdi.html"></a></li>
            </ul>
        </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
                <i class="icon-grid-2 menu-icon"></i>
                <span class="menu-title">listening</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="tables">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{url('listening')}}">listening</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('users') }}"> 
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">All Users</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('all_test') }}">
            <i class="fa-duotone fa fa-book-open-reader menu-icon"></i>             
                <span class="menu-title">All Test</span>
            </a>
        </li>
      
        {{-- <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">All Users</span>
                <i class="menu-arrow"></i>
            </a> --}}
            {{-- <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
                </ul>
            </div> --}}
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="error">
                <i class="icon-ban menu-icon"></i>
                <span class="menu-title">Transctions </span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
                <ul class="nav flex-column sub-menu">
                    {{-- <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> Earnings </a></li> --}}
                    <li class="nav-item"> <a class="nav-link" href="{{url('transaction')}}"> Tranctions </a></li>
                </ul>
            </div>
        </li>

    </ul>
</nav>
