<!doctype html>
<html lang=ja>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <script src="{{ asset('js/app.js') }}" defer></script>


    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">

    @yield('css')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <header class="header">
        <div class="headerinner">
            <a class="headerlogo" href="/stamp">Atte</a>
        </div>
            <nav>
                <ul class="header-nav">
                    @if (Auth::check())
                    <li class="header-navitem">
                        <a class="header-navlink" href="/stamp">ホーム</a>
                    </li>
                    <li class="header^navitem">
                        <a class="header-navlink" href="/attendance">日付一覧</a>
                    </li>
                    <li class="header-navitem">
                        <form class="form-header-nav" action="{{ route('logout') }}" method="post">
                        @csrf
                            <button type="submit" class="header-navlink">ログアウト</button>
                        </form>
                    </li>
                    <!-- <li class="header-navitem">
                        <form class="form-header-nav" action="/logout" method="post">
                        @csrf
                            <a class="header-navlink" href="/logout">ログアウト</a>
                        </form>
                    </li> -->
                    @endif
                </ul>
            </nav>
    </header>

    <main>
        @yield('content')
    </main>
    <footer>
        <small>Atte,inc</small>
    </footer>
</body>
</html>