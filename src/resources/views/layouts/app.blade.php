<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
    <title>Atte</title>
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/">Atte</a>
        </div>
            <nav>
                <ul class="header-nav">
                    @if (Auth::check())
                    <li class="header-nav__item">
                        <a class="header-nav__link" href="/stamp">ホーム</a>
                    </li>
                    <li class="header^nav__item">
                        <a class="header-nav__link" href="/date">日付一覧</a>
                    </li>
                    <li class="header-nav__item">
                        <form class="form-header-nav" action="/logout" method="post">
                        @csrf
                            <button class="header-nav__link" type="submit" >ログアウト</button>
                        </form>
                    </li>
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