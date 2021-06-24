
<header class="dashboard_header">
    
    <div id="navbarSupportedContent">
        <nav id="header_vue">
            <div class="container flex">
                <a class="nav_logo" href="{{route('search')}}"><img class="nav_logo" src="{{asset('storage/images/ciBoo.png')}}" alt="logo-deliveboo"></a> 
                <!-- Right Side Of Navbar -->
                <i class="fas fa-hamburger hamburger__menu" v-on:click="show = !show"></i>
                <ul class="nav_login flex" :class=" show ? 'dropdown__menu' : ''">
                    <!-- Authentication Links -->
                    @guest
                        <li class="mr-15">
                            <a class="nav_link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="flex">
                                <a class="nav_link" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="flex">
                            <a id="navbarDropdown" class="mr-15" href="{{route('admin.plate.index')}}" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            <a id="navbarDropdown" class="mr-15" href="{{route('admin.restaurant.orders', Auth::user()->id)}}" >
                                Ordini
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
</header>
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<script>
    new Vue({
    el: '#header_vue',
    data: {
        show: false
    }
});
</script> 
