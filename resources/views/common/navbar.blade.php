<nav class="navbar navbar-expand-lg navbar-light navbar-dark
                    bg-primary custom-navbar">
    <div class="d-flex navbar-collapse navbarTogglerblock" id="navbarTogglerDemo01">
        <div class="menu-icon">
            <img src="{{ url('/')}}/images/menu.png" alt="">
        </div>
        <form class="form-inline search-bar my-2 mr-auto
                            my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="{{ __('navbar.Search') }}..." id="productInput" aria-label="Search">
            <button class="searchbtn" type="submit"></button>
        </form>


        <ul class="navbar-nav">
            @auth()
            <li>
                <div class="userblock">
                    <div class="user-img">
                        <img src="./images/logo.svg" alt="" style="width: 90%;">
                    </div>
                    <div class="usertext">
                        <div class="dropdown">
                            <a class="dropdown-toggle-arrow" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ auth()->user()->name }}

                                <small>
                                    ({{ auth()->user()->role->name }})
                                </small>

                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-block" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="javascript:void(0);" onclick="debugger;$('#logout-form').submit();">
                                    Logout
                                </a>
                                <form action="{{ route('logout') }}" method="post" id="logout-form" style="display: none;">
                                    @csrf
                                    <button type="submit">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="nav-item active" title="Logout">
                <a class="nav-link" href="javascript:void(0);" onclick="debugger;$('#logout-form').submit();">
                    <i class="fa fa-sign-out fa-2x"></i>
                    <span class="sr-only">(current)</span>
                </a>
            </li>
            @else
            <li class="nav-item active login-button" title="Login">
                <a class="nav-link" href="javascript:void(0);">
                    <i class="fa fa-sign-in fa-2x"></i>
                    <span class="sr-only">(current)</span>
                </a>
            </li>
            @endauth
        </ul>
    </div>
</nav>