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

    <form class="timestamp" action="/api/attendance/clock-in" method="post">
        @csrf
        <button>勤務開始</button>
    </form>
    <form class="timestamp" action="/api/attendance/clock-out" method="post">
        @csrf
        <button>勤務終了</button>
    </form>
    <form class="timestamp" action="/api/attendance/break-start" method="post">
        @csrf
        <button>休憩開始</button>
    </form>
    <form class="timestamp" action="/api/attendance/break-end" method="post">
        @csrf
        <button>休憩終了</button>
    </form>
</div>
@endsection