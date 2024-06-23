@extends('layouts.admin_app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('button')
    <a href="/register">register</a>
@endsection

@section('content')
<div class="content__wrapper">
    <div class="content__header">
        Login
    </div>
    <form class="form" action="/login" method="post">
        @csrf
        <div class="login-box">
            <div class="login-box__item">
                <p>メールアドレス</p>
                <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                <div class="form-item__error">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="login-box__item">
                <p>パスワード</p>
                <input type="password" name="password" placeholder="例: coachtech1106">
                <div class="form-item__error">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="login-box__button">
                <button type="submit" class="login-box__button-submit">ログイン</button>
            </div>
        </div>
    </form>
</div>
@endsection