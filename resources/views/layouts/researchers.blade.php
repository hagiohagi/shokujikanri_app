<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ mix('/js/app.js') }}" defer></script>
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div class="container-fluid bg-white">
        <div class="container">
            <nav class="navbar navbar-light">
                <span class="navbar-brand mb-0 h1">食事記録</span>
            </div>

                @if( Auth::guard('researchers')->check() )
                <logout-component></logout-component>
                <form method="POST" action="{{ route('researchers.logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('ログアウト') }}
                            </x-dropdown-link>
                        </form>
                @else
                @endguest
            </nav>
        </div>
    </div>

        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
