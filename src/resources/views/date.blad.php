@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
@endsection

@section('content')
<div class="attendance-form">
    @auth
    <div class="user-info">
        {{ Auth::user()->name }}
    </div>
    @endauth

    <div class="container">
    @foreach ($attendancesByDate as $attendance)
    <div class="attendance">
      <table>
        <th>{{$attendance->user_name}}</th>
        <tr><td>出勤</td><td>{{$items->punchIn}}</td></tr>
        <tr><td>休憩開始</td><td>{{$items->breakIn}}</td></tr>
        <tr><td>休憩終了</td><td>{{$items->breakOut}}</td></tr>
        <tr><td>退勤</td><td>{{$items->punchOut}}</td></tr>
        <tr><td>勤務時間</td><td>{{$items->workTime}}</td></tr>
      </table>
    </div>
    @endforeach
  </div>
</div>
@endsection