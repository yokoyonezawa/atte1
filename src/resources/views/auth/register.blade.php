@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<body>
    <div class="register__content">
        <h1 class="register__content-ttl">会員登録</h1>
        <form class="register-form" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="register-form__item">
                <input type="text" name="name" class="register-form__item-input" placeholder="名前" value="{{ old('name') }}" required>
            </div>
            <div class="register-form__item">
                <input type="email" name="email" class="register-form__item-input" placeholder="メールアドレス" value="{{ old('email') }}" required>
            </div>
            <div class="register-form__item">
                <input type="password" name="password" class="register-form__item-input" placeholder="パスワード" required>
            </div>
            <div class="register-form__item">
                <input type="password" name="password_confirmation" class="register-form__item-input" placeholder="確認用パスワード" required>
            </div>
            <div class="register-form__btn">
                <button type="submit" class="btn">会員登録</button>
            </div>
        </form>
        <div class="register__content-detail">
            <p class="register__content-detail-1">アカウントをお持ちの方はこちらから</p>
            <p class="register__content-detail-2"><a href="{{ route('login') }}">ログイン</a></p>
        </div>
    </div>
</body>

@endsection
