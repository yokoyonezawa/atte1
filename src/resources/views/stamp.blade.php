@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/stamp.css') }}">
@endsection

@section('content')

<div class="stamp-top">
    <div class="stamp-top__content">
        <h2>{{ $user->name }}さんお疲れ様です！</h2>
    </div>
</div>

<div class="stamp-content">
    <div class="stamp-section">
        <form class="stamp-content__item" action="/stamp/start" method="post">
            @csrf
            <button class="stamp__btn-start" type="submit"  >勤務開始</button>
        </form>
        <form class="stamp-content__item" action="/stamp/end" method="post">
            @csrf
            <button class="stamp__btn-end" type="submit"  >勤務終了</button>
        </form>
    </div>

    <div class="stamp-section">
        <form class="stamp-content__item" action="/stamp/start_break" method="post">
            @csrf
            <button class="stamp__btn-break-start" type="submit"  >休憩開始</button>
        </form>


        <form class="stamp-content__item" action="/stamp/end_break" method="post">
            @csrf
            <button class="stamp__btn-break-end" type="submit"  >休憩終了</button>
        </form>
    </div>
</div>


@endsection

