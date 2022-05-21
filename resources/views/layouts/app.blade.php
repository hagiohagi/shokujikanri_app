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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</head>
<body>
    <div id="app">
        <div class="container-fluid bg-white">
            <nav class="navbar navbar-light">
                <span class="navbar-brand mb-0 h1">食事記録</span>

                @if( Auth::check() )
                <div class="d-flex justify-content-end">
                    {{ Auth::user()->name}}さん
                    <!-- <logout-component></logout-component> -->
                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#logoutModal">
                        <img src="/images/logout.jpg" width="40" alt="ログアウト">
                    </button> 
                </div>

                <!-- Modal -->
                <div class="modal fade" id="logoutModal" aria-labelledby="logoutModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body text-center">
                                <h5 class="modal-title" id="logoutModalLabel">ログアウトしてよろしいですか？</h5>
                                <div class="d-flex justify-content-around mt-5">
                                    <input type="button" class="btn btn-secondary" data-dismiss="modal" style="width:100px" value="戻る">
                                    <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <input type="submit" class="btn btn-secondary" style="width:150px" value="ログアウトする">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</div>
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
