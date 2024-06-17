@extends('layouts.simple')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css')}}">
@endsection

@section('content')
<div class="login-form">
    <h2 class="login-form__hading content__heading">ログイン</h2>
    <div class="login-form__inner">
        <form action="/login" class="login-form__form" method="post">
            @csrf
            <div class="login-form__group">
                <input type="mail" class="login-form__input" name="email" id="email" placeholder="メールアドレス">
                <p class="login-form__error-message">
                    @error('email')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="login-form__group">
                <input type="password" class="login-form__input" name="password" id="password" placeholder="パスワード">
                <p class="login-form__error-message">
                    @error('password')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <input type="submit" class="login-form__btn btn" value="ログイン">
        </form>
    </div>
    <p class="login-from__message">アカウントをお持ちでない方はこちらから</p>
</div>
<a href="/register" class="outside__link">会員登録</a>
@endsection('content')

