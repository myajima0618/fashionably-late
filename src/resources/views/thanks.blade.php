@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thanks-content">
    <div class="thanks-content__back">
        Thank you
    </div>
    <div class="thanks-content__text">
        <h2>お問い合わせありがとうございました</h2>
        <div class="thanks-content__button">
            <a href="/">HOME</a>
        </div>
    </div>
</div>
@endsection