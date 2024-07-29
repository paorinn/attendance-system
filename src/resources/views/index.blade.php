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
    <form class="timestamp" action="/clock-in" method="post">
        @csrf
        <button>勤務開始</button>
    </form>
    <form class="timestamp" action="/clock-out" method="post">
        @csrf
        <button>勤務終了</button>
    </form>
    <form class="timestamp" action="/break-in" method="post">
        @csrf
        <button>休憩開始</button>
    </form>
    <form class="timestamp" action="/break-out" method="post">
        @csrf
        <button>休憩終了</button>
    </form>

<output class="realtime"></output>
<script src="{{ asset('/js/time.js') }}"></script>
@endsection