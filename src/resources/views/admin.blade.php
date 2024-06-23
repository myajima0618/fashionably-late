@extends('layouts.admin_app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('button')
<form action="/logout" method="post" class="logout__button">
    @csrf
    <button type="submit">logout</button>
</form>
@endsection

@section('content')
<div class="content__wrapper">
    <div class="content__header">
        Admin
    </div>
    <form class="search-form" id="search-form" action="/admin/search" method="post">
        @csrf
        <div class="search-form__inner">
            <div class="search-form__item">
                <input class="form-item__input-keyword" type="text" name="keyword" value="{{ old('keyword') }}" placeholder="名前やメールアドレスを入力してください">
                <select class="form-item__select-gender" name="gender">
                    <option value="{{ old('gender') }}">性別</option>
                    <option value="all">全て</option>
                    <option value="1">男性</option>
                    <option value="2">女性</option>
                    <option value="3">その他</option>
                </select>
                <select class="form-item__select-category" name="category_id">
                    <option value="">お問い合わせの種類</option>
                    @foreach($categories as $category)
                    <option value="{{$category['id']}}">{{ $category['content'] }}</option>
                    @endforeach
                </select>
                <input class="form-item__input-date" type="date" name="date" value="{{ old('date')}}" placeholder="年/月/日">
            </div>
            <div class="search__button">
                <button type="submit">検索</button>
            </div>
    </form>
    <form class="reset-form" action="/admin" method="get">
        @csrf
        <div class="reset__button">
            <button type="submit">リセット</button>
        </div>
</div>
</form>
</div>

<div class="page__inner">
    <div class="export__button">
        <form class="download-foam" action="/admin/download" method="post">
            @csrf
            <button type="submit">エクスポート</button>
        </form>
    </div>
    <div class="pages">
        {{ $contacts->appends(request()->input())->links('pagination::bootstrap-4') }}
    </div>
</div>
<div class="contact-table">
    <table class="contact-table__inner">
        <tr class="contact-table__row">
            <th class="contact-table__header">お名前</th>
            <th class="contact-table__header">性別</th>
            <th class="contact-table__header">メールアドレス</th>
            <th class="contact-table__header">お問い合わせの種類</th>
            <th class="contact-table__header"></th>
        </tr>
        @foreach($contacts as $contact)
        <tr class="contact-table__row">
            <td class="contact-table__content">
                {{ $contact['last_name'] }}　{{ $contact['first_name'] }}
            </td>
            <td class="contact-table__content">
                @if($contact['gender'] == 1)
                男性
                @elseif($contact['gender'] == 2)
                女性
                @else
                その他
                @endif
            </td>
            <td class="contact-table__content">
                {{ $contact['email'] }}
            </td>
            <td class="contact-table__content">
                {{ $contact['category']['content'] }}
            </td>
            <td class="contact-table__content">
                <button class="detail__button" id="modal-open" data-dialog="#modal-{{ $contact['id'] }}">詳細</button>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@foreach($contacts as $contact)
<dialog id="modal-{{$contact['id']}}">
    <div class="close__button">
        <button id="modal-close">×</button>
    </div>
    <table class="detail-table">
        <tr class="detail-table__row">
            <th class="detail-table__header">お名前</th>
            <td class="detail-table__text">{{ $contact['last_name']}}　{{ $contact['first_name']}}</td>
        </tr>
        <tr class="detail-table__row">
            <th class="detail-table__header">性別</th>
            <td class="detail-table__text">
                @if($contact['gender'] == 1)
                男性
                @elseif($contact['gender'] == 2)
                女性
                @else
                その他
                @endif
            </td>
        </tr>
        <tr class="detail-table__row">
            <th class="detail-table__header">メールアドレス</th>
            <td class="detail-table__text">{{ $contact['email'] }}</td>
        </tr>
        <tr class="detail-table__row">
            <th class="detail-table__header">電話番号</th>
            <td class="detail-table__text">{{ $contact['tel'] }}</td>
        </tr>
        <tr class="detail-table__row">
            <th class="detail-table__header">住所</th>
            <td class="detail-table__text">{{ $contact['address'] }}</td>
        </tr>
        <tr class="detail-table__row">
            <th class="detail-table__header">建物名</th>
            <td class="detail-table__text">{{ $contact['building'] }}</td>
        </tr>
        <tr class="detail-table__row">
            <th class="detail-table__header">お問い合わせの種類</th>
            <td class="detail-table__text">{{ $contact['category']['content'] }}</td>
        </tr>
        <tr class="detail-table__row">
            <th class="detail-table__header">お問い合わせ内容</th>
            <td class="detail-table__text">{{ $contact['detail'] }}</td>
        </tr>
    </table>
    <p>&nbsp;</p>
    <form action="/admin/delete" class="delete-form" method="post">
        @method('DELETE')
        @csrf
        <div class="delete__button">
            <input type="hidden" name="id" value="{{ $contact['id'] }}">
            <button type="submit">削除</button>
        </div>
    </form>
</dialog>
@endforeach
</div>
<script>
    // 変数定義
    const dialogOpen = document.querySelectorAll(".detail__button");
    const dialogClose = document.querySelectorAll("#modal-close");

    dialogOpen.forEach((button) => {
        const dialog = document.querySelector(button.dataset.dialog);

        button.addEventListener("click", () => {

            document.body.classList.add('fixed'); /* bodyのクラスfixedを付与 */
            dialog.showModal();

        })
    })

    // 閉じるとき
    dialogClose.forEach((button) => {
        const dialog = button.closest("dialog");

        button.addEventListener("click", () => {

            document.body.classList.remove('fixed'); /* bodyのクラスfixedを削除 */
            dialog.close();

        });
    });
</script>

@endsection