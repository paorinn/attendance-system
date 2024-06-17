@extends('layouts.simple')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css')}}">
@endsection

@section('content')
<div class="register-form">
    <h2 class="register-form__hading content__heading">会員登録</h2>
    <div class="register-form__inner">
        <form action="/register" class="register-form__form" method="post">
            @csrf
            <div class="register-form__group">
                <input type="text" class="register-form__input" name="name" id="name
                " placeholder="名前">
                <p class="register-form__error-message">
                    @error('name')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="register-form__group">
                <input type="mail" class="register-form__input" name="email" id="email" placeholder="メールアドレス">
                <p class="login-form__error-message">
                    @error('email')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="register-form__group">
                <input type="password" class="register-form__input" name="password" id="password" placeholder="パスワード">
                <p class="login-form__error-message">
                    @error('password')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="register-form__group">
                <input type="password" class="register-form__input" name="password_confirmation" id="password-confirmation" placeholder="確認用パスワード" />
                <p class="login-form__error-message">
                    @error('password_confirmation')
                    {{ $message }}
                    @enderror
                </p>
            </div>
            <input type="submit" class="register-form__btn btn" value="会員登録">
        </form>
    </div>
    <p class="login-from__message">アカウントをお持ちの方はこちらから</p>
    <a href="/login" class="outside__link">ログイン</a>
</div>
@endsection('content')

