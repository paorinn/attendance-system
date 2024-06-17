@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="index-form">
    <button class="attendance___btn">勤務開始</button>
    <button class="attendance___btn">勤務終了</button>
    <button class="attendance___btn">休憩開始</button>
    <button class="attendance___btn">休憩終了</button>
</div>
@endsection