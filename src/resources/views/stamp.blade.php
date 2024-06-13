@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/date.css') }}">
@endsection

@section('content')

<div class="stamp-top">
    <h2>{{ $user->name }}さんお疲れ様です！</h2>
</div>
<div class="stamp-content">
    <form class="stamp-content__item" action="/stamp/start" method="get">
        <button class="stamp__btn-star" type="submit"  >勤務開始</button>
    </form>
</div>
<div class="stamp-content">
    <form class="stamp-content__item" action="/stamp/end" method="get">
        <button class="stamp__btn-end" type="submit"  >勤務終了</button>
    </form>
</div><div class="stamp-content">
    <form class="stamp-content__item" action="/stamp/start_break" method="get">
        <button class="stamp__btn-break-start" type="submit"  >休憩開始</button>
    </form>
</div><div class="stamp-content">
    <form class="stamp-content__item" action="/stamp/end_break" method="get">
        <button class="stamp__btn-break-end" type="submit"  >休憩終了</button>
    </form>
</div>


@endsection