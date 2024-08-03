@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
@endsection

@section('content')
<div class="attendance-form">
    <input type="date" value="<?php echo date('Y-m-d', strtotime('-1 day')); ?>">

    <div class="container">
        <div class="attendance">
            <table>
                <thead>
                    <tr>
                        <th>名前</th>
                        <th>勤務開始</th>
                        <th>勤務終了</th>
                        <th>休憩時間</th>
                        <th>勤務時間</th>
                    </tr>
                </thead>
                @foreach ($items[0] as $item)
                    <tbody>
                        <tr>
                            <td>{{ $item['user_name'] }}</td>
                            <td>{{ $item['punchIn'] }}</td>
                            <td>{{ $item['punchOut'] }}</td>
                            <td></td>
                            <td>{{ $item['workTime'] }}</td>
                        </tr>
                    </tbody>
                    @endforeach
            </table>
        </div>
    </div>
</div>
@endsection