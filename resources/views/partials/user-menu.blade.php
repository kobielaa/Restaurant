<div class="container">
    <nav class="navbar navbar-expand-lg">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Branding Image -->
        {{--  <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>  --}}
        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <ul class="nav">
                @if (Auth::guest())
                <li class="nav-item" data-toggle="modal" data-target="#loginModal">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <a class="nav-link">Login</a>
                </li>
                <li class="nav-item">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                </li>
                @else
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" 
                        data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        @if (Auth::user()->hasRole('admin'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.index') }}">
                                Dashboard
                            </a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.adverts.index') }}">
                                My adverts
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
                @endif
            </ul>
            <!-- Modal -->
            @include('partials.login-modal')
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg" id="languages-navbar">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Branding Image -->
        {{--  <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>  --}}
        <div class="collapse navbar-collapse">
            <ul class="nav">
                @if(count($globalData['languages']))
                @foreach ($globalData['languages'] as $row)
                <li class="nav-item lang-{{ strtolower($row->code)}}">
                    <a href="/{{ strtolower($row->code)}}" class="nav-link">
                        <img src="/img/flags/{{ strtolower($row->code)}}.png"/>
                    </a>
                </li>
                @endforeach
                @endif
            </ul>
        </div>
    </nav>
</div>