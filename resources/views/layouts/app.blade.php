<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | Attendance</title>

    <!-- Scripts -->
    <script src="{{ secure_asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
    <script src="{{ secure_asset('js/batchBlockAssign.js') }}"></script>
    <script src="{{ secure_asset('js/attendBut.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ secure_url('css/geolocation.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('css/loader.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    @stack('geolocation')

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                      @can('attendance sheet')
                            <li class="nav-item">
                                    <a class="nav-link" href="{{ route('attendance') }}">Attendance Sheet</a>
                                    </li>
                                  @endcan
                      @can('blocks')
                            <li class="nav-item">
                                    <a class="nav-link" href="{{ route('blocks.index') }}">Blocks</a>
                                    </li>
                                  @endcan
                                  @can('Groups')
                            <li class="nav-item">
                                    <a class="nav-link" href="{{ route('group.index') }}">Groups</a>
                                    </li>
                                  @endcan
                                  @can('export')
                                    <li class="nav-item">
                                            <a class="nav-link" href="{{ route('exports.index') }}">Export</a>
                                            </li>
                                          @endcan
                                          @can('problems')
                                            <li class="nav-item">
                                                    <a class="nav-link" href="{{ route('problem') }}">Problems</a>
                                                    </li>
                                                  @endcan
                                          @role('admin')
                                                <li class="nav-item">
                                                <a class="nav-link" href="{{ route('users.index') }}">Users</a>
                                                </li>
                                                <li class="nav-item">
                                                <a class="nav-link" href="{{ route('roles.index') }}">Roles</a>
                                                </li>
                                                <li class="nav-item">
                                                <a class="nav-link" href="{{ route('permissions.index') }}">Permissions</a>
                                                </li>
                                                <li class="nav-item">
                                                <a class="nav-link" href="{{ route('college.index') }}">College</a>
                                                </li>
                                                @endrole

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            {{-- <li class="nav-item">
                          <a class="btn btn-success btn-lg btn-block waves-effect waves-light" href="{{ url('cas/login')}}">{{ __('Login with KSAU-HS account') }}</a>
                          </li> --}}
                            {{-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif --}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
        <div class="text-center"><small>@version</small></div>
    </div>
</body>
</html>
