<nav class="navbar navbar-expand-lg navbar-dark" style="background-color:  #002080;">
    <div class="container-fluid">
        <img src="/img/utem-logo.png" alt="logo" style="width: 5%;">
        <a class="navbar-brand" href="/">UTeM-Xpress</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="#">About us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Career</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Developer</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">About Developer</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">{Something else here}</a></li>
                        </ul>
                    </li>
                @endguest
                @if (Route::has('login'))
                    @auth
                        @if($message == '1')
                            <li class="nav-item">
                                <a href="{{url('/student/home')}}" class="nav-link placeorder">Place Order</a>
                            </li>
                            @if($active >= '1')
                                <li class="nav-item">
                                    <a href="{{url('/student/activeOrder')}}" class="nav-link activeorder">Active Order</a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a href="{{url('/student/showOrderRecord')}}" class="nav-link orderrecord">Order Record</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('/student/showFavouriteRunner')}}" class="nav-link favouriterunner">Favourite Runner</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/student/profile') }}" class="nav-link userprofile">{{Auth::user()->email}}</a>
                            </li>
                        @elseif($message == '2')
                            <li class="nav-item">
                                <a href="{{url('/staff/home')}}" class="nav-link placeorder">Place Order</a>
                            </li>
                            @if($active >= '1')
                                <li class="nav-item">
                                    <a href="{{url('/staff/activeOrder')}}" class="nav-link activeorder">Active Order</a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a href="{{url('/staff/showOrderRecord')}}" class="nav-link orderrecord">Order Record</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('/staff/showFavouriteRunner')}}" class="nav-link favouriterunner">Favourite Runner</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/staff/profile') }}" class="nav-link userprofile">{{Auth::user()->email}}</a>
                            </li>
                            @elseif($message == '3')
                            <li class="nav-item">
                                <a href="{{url('/runner/home')}}" class="nav-link orderlisting">Order Listing</a>
                            </li>
                            @if(isset($ongoing))
                                @if(!$ongoing->isEmpty())
                                <li class="nav-item">
                                    <a href="{{url('/runner/onGoingOrder')}}" class="nav-link ongoingorder">On-Going Order</a>
                                </li>
                                @endif
                            @endif
                            @if(isset($complete))
                                @if(!$complete->isEmpty())
                                    <li class="nav-item">
                                        <a href="{{url('/runner/completedOrder')}}" class="nav-link pastorder">Past Order</a>
                                    </li>
                                @endif
                            @endif
                            <li class="nav-item">
                                <a href="{{ url('/runner/earning') }}" class="nav-link myearnings">My Earnings</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/runner/profile') }}" class="nav-link runnerprofile">{{Auth::user()->email}}</a>
                            </li>
                            @else
                                <li class="nav-item">
                                    <a href="{{ url('/admin/home') }}" class="nav-link adminhome">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/admin/manageUser') }}" class="nav-link manageuser">Manage User</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/admin/manageRunner') }}" class="nav-link managerunner">Manage Runner</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/admin/manageOrder') }}" class="nav-link manageorder">Manage Order</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/admin/manageAdmin') }}" class="nav-link manageadmin">Manage Admin</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/admin/profile') }}" class="nav-link adminprofile">{{Auth::user()->email}}</a>
                                </li>
                        @endif
                    @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">Log in</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="nav-link">Register</a>
                            </li>
                        @endif
                    @endif
                    @endauth
            </ul>
        </div>
    </div>
</nav>

