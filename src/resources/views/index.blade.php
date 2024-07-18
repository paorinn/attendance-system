@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="index-form">
    @auth
    <div class="user-info">
        {{ Auth::user()->name }}さんお疲れ様です！
    </div>
    @endauth

    <p>{{session('message')}}</p>
    <form class="timestamp" action="/attendance/clock-in" method="post">
        @csrf
        <button>勤務開始</button>
    </form>
    <form class="timestamp" action="/attendance/clock-out" method="post">
        @csrf
        <button>勤務終了</button>
    </form>
    <form class="timestamp" action="/attendance/break-in" method="post">
        @csrf
        <button>休憩開始</button>
    </form>
    <form class="timestamp" action="/attendance/break-out" method="post">
        @csrf
        <button>休憩終了</button>
    </form>
    <div class="container">
    @foreach ($items as $items)
    <div class="attendance">
      <table>
        <th>{{$items->user_name}}</th>
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

<output class="realtime"></output>
<script src="{{ asset('/js/time.js') }}"></script>
@endsection