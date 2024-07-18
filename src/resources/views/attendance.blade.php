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
    @foreach ($itmes as $itme)
    <div class="attendance">
      <table>
        <th>{{$itme->user_name}}</th>
        <tr><td>出勤</td><td>{{$itme->punchIn}}</td></tr>
        <tr><td>休憩開始</td><td>{{$itme->breakIn}}</td></tr>
        <tr><td>休憩終了</td><td>{{$itme->breakOut}}</td></tr>
        <tr><td>退勤</td><td>{{$itme->punchOut}}</td></tr>
        <tr><td>勤務時間</td><td>{{$itme->workTime}}</td></tr>
      </table>
    </div>
    @endforeach
  </div>
</div>
@endsection