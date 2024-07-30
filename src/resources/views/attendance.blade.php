@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
@endsection

@section('content')

<header class="date-header">
    <h2>
        <a href="{{ url('/attendance?date=' . $previousDate) }}">＜</a>
        {{ $date }}
        <a href="{{ url('/attendance?date=' . $nextDate) }}">＞</a>
    </h2>
</header>
<main>
    <div class="date__content">
        <table>
            <tr>
                <th>名前</th>
                <th>勤務開始</th>
                <th>勤務終了</th>
                <th>休憩時間</th>
                <th>勤務時間</th>
            </tr>
            @foreach ($stamps as $stamp)
                <tr>
                    <td>{{ $stamp->user->name }}</td>
                    <td>{{ $stamp->start_time }}</td>
                    <td>{{ $stamp->end_time }}</td>
                    <td>{{ gmdate('H:i:s', $stamp->breaks->sum(function ($break) {
                        $start = \Carbon\Carbon::parse($break->start_time);
                        $end = \Carbon\Carbon::parse($break->end_time);
                        return $start->diffInSeconds($end);
                    })) }}</td>
                    <td>{{ $stamp->calculateWorkHours() }}</td>
                </tr>
            @endforeach
        </table>
    </div>

    <div class="pagination">
        {{ $stamps->links('vendor.pagination.custom') }}
    </div>
</main>



@endsection