@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')

<div class="register__content">
    <div class="register__content--ttl">
        <h2>
            会員登録
        </h2>
    </div>
    <form class="register-form" action="/register" method="post">
        @csrf
        <div class="register-form__item">
            <input class="register-form__item-input" type="text" name="name" placeholder="名前" value="{{ old('name') }}" />
        </div>
        <div class="register-form__item">
            <input class="register-form__item-input" type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}" />
        </div>
        <div class="register-form__item">
            <input class="register-form__item-input" type="password" name="password" placeholder="パスワード" />
        </div>
        <div class="register-form__item">
            <input class="register-form__item-input" type="password" name="password_confirmation" placeholder="確認用パスワード" />
        </div>
        <div class="register-form__btn">
            <input class="register-form__btn btn" type="submit" value="会員登録">
        </div>
    </form>
    <div class="register__content-detail">
        <div class=register__content-detail-1>
            <p>アカウントをお持ちの方はこちらから</p>
        </div>
        <div class=register__content-detail-2>
            <a href="/login">ログイン</a>
        </div>
    </div>
</div>

@endsection