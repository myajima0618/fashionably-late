@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="content__wrapper">
    <div class="content__header">
        Contact
    </div>
    <form class="contact-form" action="/confirm" method="post">
        @csrf
        <div class="form-item">
            <div class="form-item__title">
                <span class="form-item__title--label">お名前</span>
                <span class="form-item__title--required">※</span>
            </div>
            <div class="form-item__input">
                <div class="form-item__input--name">
                    <input type="text" name="last_name" placeholder="例：山田" value="{{ old('last_name') }}">
                    <input type="text" name="first_name" placeholder="例：太郎" value="{{ old('first_name') }}">
                </div>
                <div class="form-item__error">
                    <div class="form-item__error--name">
                        @error('last_name')
                        {{ $message }}
                        @enderror
                    </div>
                    <div class="form-item__error--name">
                        @error('first_name')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="form-item">
            <div class="form-item__title">
                <span class="form-item__title--label">性別</span>
                <span class="form-item__title--required">※</span>
            </div>
            <div class="form-item__input">
                <div class="form-item__input--gender">
                    <label><input type="radio" name="gender" value="1" checked />男性</label>
                    <label><input type="radio" name="gender" value="2" />女性</label>
                    <label><input type="radio" name="gender" value="3" />その他</label>
                    @error('gender')
                    <div class="form-item__error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-item">
            <div class="form-item__title">
                <span class="form-item__title--label">メールアドレス</span>
                <span class="form-item__title--required">※</span>
            </div>
            <div class="form-item__input">
                <div class="form-item__input--email">
                    <input type="email" name="email" placeholder="例：test@example.com" value="{{ old('email') }}">
                    @error('email')
                    <div class="form-item__error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-item">
            <div class="form-item__title">
                <span class="form-item__title--label">電話番号</span>
                <span class="form-item__title--required">※</span>
            </div>
            <div class="form-item__input">
                <div class="form-item__input--tel">
                    <div class="form-item__tel-inner">
                        <input type="tel" name="tel1" placeholder="080" value="{{ old('tel1') }}">-
                        <input type="tel" name="tel2" placeholder="1234" value="{{ old('tel2') }}">-
                        <input type="tel" name="tel3" placeholder="5678" value="{{ old('tel3') }}">
                    </div>
                </div>
                <div class="form-item__error">

                    <div class="form-item__error--tel">
                        @error('tel1')
                        {{ $message }}
                        @enderror
                    </div>
                    <div class="form-item__error--tel">
                        @error('tel2')
                        {{ $message }}
                        @enderror
                    </div>
                    <div class="form-item__error--tel">
                        @error('tel3')
                        {{ $message }}
                        @enderror
                    </div>

                </div>
            </div>
        </div>
        <div class="form-item">
            <div class="form-item__title">
                <span class="form-item__title--label">住所</span>
                <span class="form-item__title--required">※</span>
            </div>
            <div class="form-item__input">
                <div class="form-item__input--address">
                    <input type="text" name="address" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}">
                    @error('address')
                    <div class="form-item__error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-item">
            <div class="form-item__title">
                <span class="form-item__title--label">建物名</span>
            </div>
            <div class="form-item__input">
                <div class="form-item__input--building">
                    <input type="text" name="building" placeholder="例：千駄ヶ谷マンション101" value="{{ old('building') }}">
                    @error('building')
                    <div class="form-item__error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-item">
            <div class="form-item__title">
                <span class="form-item__title--label">お問い合わせの種類</span>
                <span class="form-item__title--required">※</span>
            </div>
            <div class="form-item__input">
                <div class="form-item__input--category">
                    <select name="category_id" onchange="changeColor(this)">
                        <option value="{{ old('category_id') }}">選択してください</option>
                        @foreach($categories as $category)
                        <option value="{{ $category['id'] }}">{{ $category['content'] }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="form-item__error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-item">
            <div class="form-item__title">
                <span class="form-item__title--label">お問い合わせ内容</span>
                <span class="form-item__title--required">※</span>
            </div>
            <div class="form-item__input">
                <div class="form-item__input--detail">
                    <textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
                    @error('detail')
                    <div class="form-item__error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">確認画面</button>
        </div>
    </form>
</div>
@endsection