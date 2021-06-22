<header class="">
        
    <div id="navbarSupportedContent">
        <nav class="transparent">
            <div class="container flex">
                <img class="nav_logo" src="{{asset('storage/images/ciBoo.png')}}" alt="logo-deliveboo">
                <!-- Right Side Of Navbar -->
                <ul class="nav_login flex">
                    <!-- Authentication Links -->
                    @guest
                        <li class="mr-15">
                            <a class="nav_link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="flex">
                                <a class="nav_link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="flex">
                            <a id="navbarDropdown" class="mr-15 user_link" href="{{route('admin.plate.index')}}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            <div class="flex" aria-labelledby="navbarDropdown">
                                <a class="nav_link" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>
    </div>

    <div class="jumbotron">
        <div class="box_video">
            <video playsinline autoplay muted loop poster="" class='banner_video'> 
                <source src="{{asset('storage/images/bannerCiboo.mp4')}}" type="video/mp4" >
            </video>
        </div>
    </div>
        
</header>