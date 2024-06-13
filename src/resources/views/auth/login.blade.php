@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')

<div class="login__content">
    <div class="login__content-ttl">
        <h2>ログイン</h2>
    </div>
    <form class="login-form" action="/login" method="post">
        @csrf
        <div class="login-form__item">
            <input class="login-form__item-input" type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}" />
        </div>
        <div class="login-form__item">
            <input class="login-form__item-input" type="password" name="password" placeholder="パスワード" />
        </div>
        <div class="login-form__btn">
            <input class="login-form__btn btn" type="submit" value="ログイン">
        </div>
    </form>
    <div class="login__content-detail">
        <div class=login__content-detail-1>
            <p>アカウントをお持ちでない方はこちらから</p>
        </div>
        <div class=login__content-detail-2>
            <a href="/register">会員登録</a>
        </div>
    </div>
</div>

@endsection