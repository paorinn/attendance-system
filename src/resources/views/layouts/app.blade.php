<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atte</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('css')
</head>
<body>
    <div class="app">
        <header class="header">
            <h1 class="header__heading">Atte</h1>
            <a href="/">ホーム</a>
            <input type="date" value="<?php echo date('Y-m-d', strtotime('-1 day')); ?>">
            @if (Auth::check())
            <form action="/logout" method="post" class="form">
                @csrf
                <button class="header-nav__button">ログアウト</button>
            </form>
            @endif
        </header>
        <div class="content">
            @yield('content')
        </div>
    </div>
    <small>Atte, inc.</small>
</body>

</html>