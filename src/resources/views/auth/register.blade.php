@extends('layouts.admin_app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('button')
    <a href="/login">login</a>
@endsection

@section('content')
<div class="content__wrapper">
    <div class="content__header">
        Register
    </div>
    <form class="form" action="/register" method="post">
        @csrf
        <div class="register-box">
            <div class="register-box__item">
                <p>お名前</p>
                <input type="text" name="name" placeholder="例: 山田　太郎" value="{{ old('name') }}">
                <div class="form-item__error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="register-box__item">
                <p>メールアドレス</p>
                <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                <div class="form-item__error">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="register-box__item">
                <p>パスワード</p>
                <input type="password" name="password" placeholder="例: coachtech1106">
                <div class="form-item__error">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="register-box__button">
                <button type="submit" class="login-box__button-submit">登録</button>
            </div>
        </div>
    </form>
</div>
@endsection