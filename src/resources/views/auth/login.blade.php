@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<body>
    <div class="login__content">
        <h2 class="login__content-ttl">ログイン</h2>
        <form class="login-form" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="login-form__item">
                <input type="email" name="email" class="login-form__item-input" placeholder="メールアドレス" required>
            </div>
            <div class="login-form__item">
                <input type="password" name="password" class="login-form__item-input" placeholder="パスワード" required>
            </div>
            <div class="login-form__btn">
                <button type="submit" class="btn">ログイン</button>
            </div>
        </form>
        <div class="login__content-detail">
            <p class="login__content-detail-1">アカウントをお持ちでない方はこちらから</p>
            <p class="login__content-detail-2"><a href="{{ route('register') }}">会員登録</a></p>
        </div>
    </div>
</body>

@endsection