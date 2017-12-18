<nav class="navbar fixed-top navbar-shadowed navbar-expand-sm navbar-dark bg-incognito">
    <a class="navbar-brand" href="#">
        <img src="/images/icon.png" height="25" width="25" class="d-inline-block align-top" alt="">
        SRI-Locatorslist
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0"></ul>
        <ul class="navbar-nav my-2 my-lg-0">
            @guest
            <li class="nav-item">
                <a href="{{ route('login') }}" class="nav-link">
                    Login
                </a>
            </li>
            @else
            <!-- Notification Section -->
            <notification></notification>
            <li class="nav-item dropdown show">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <a href="" class="dropdown-header text-center">
                        <img src="{{ Auth::user()->user_img }}" height="65" width="65" class="rounded-circle border"  alt="{{ Auth::user()->name }} image">
                    </a>
                    <div class="dropdown-divider"></div>
                    <router-link class="dropdown-item" to="/home">
                        Home
                    </router-link>
                    <router-link class="dropdown-item" to="/maintainance">
                        Maintaince
                    </router-link>
                    @if(Auth::user()->userType == 1)
                    <router-link class="dropdown-item" to="/users">
                        Manage Users
                    </router-link>
                    @endif
                    <router-link class="dropdown-item" to="/user/profile">
                        Profile
                    </router-link>
                    @if(Auth::user()->userType == 1)
                    <router-link class="dropdown-item" to="/api-clients">Manage OAuth Clients</router-link>
                    @endif
                    <a class="dropdown-item" v-on:click.prevent="signOut" href="#">
                        Sign-out
                    </a>
                    <!-- <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                             document.getElementById('logout-form').submit(); localStorage.removeItem('_u');">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form> -->
                </div>
            </li>
            @endguest
        </ul>
    </div>
</nav>