<header class="">
        
    <div id="navbarSupportedContent">
        <nav>
            <div class="container flex">
                <img class="nav-logo" src="{{asset('storage/images/logo-deliveboo.png')}}" alt="logo-deliveboo">
                <!-- Right Side Of Navbar -->
                <ul class="nav_login flex">
                    <!-- Authentication Links -->
                    @guest
                        <li class="mr-15">
                            <a class="" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="">
                                <a class="" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="">
                            <a id="navbarDropdown" class="" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            <div class="" aria-labelledby="navbarDropdown">
                                <a class="" href="{{ route('logout') }}"
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
        <div class="box-video">
            <video controls>
                <source src="video.mp4" type="video/mp4">
            </video>
        </div>
    </div>
        
</header>