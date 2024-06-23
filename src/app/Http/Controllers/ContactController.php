<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;
use Illuminate\Pagination\Paginator;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ContactController extends Controller
{
    // 初期表示
    public function index(Request $request)
    {
        $categories = Category::all();

        return view('index', compact('categories'));
    }

    // 確認画面表示
    public function confirm(ContactRequest $request)
    {
        $contact = $request->only([
            'last_name',
            'first_name',
            'gender',
            'email',
            'tel1',
            'tel2',
            'tel3',
            'address',
            'building',
            'category_id',
            'detail'
        ]);
        $category = Category::find($request->category_id);

        return view('confirm', compact('contact', 'category'));
    }

    // 新規登録機能
    public function store(ContactRequest $request)
    {
        $contact = $request->only([
            'last_name',
            'first_name',
            'gender',
            'email',
            'tel',
            'address',
            'building',
            'category_id',
            'detail'
        ]);
        Contact::create($contact);
        return view('thanks');
    }

    // 管理画面表示
    public function admin()
    {
        $contacts = Contact::with('category')->paginate(7);
        $categories = Category::all();
        return view('admin', compact('contacts', 'categories'));
    }

    // 検索機能
    public function search(Request $request)
    {
        $contacts = Contact::with('category')->KeywordSearch($request->keyword)->GenderSearch($request->gender)->CategorySearch($request->category_id)->DateSearch($request->date)->Paginate(7);
        $categories = Category::all();
        return view('admin', compact('contacts', 'categories'));
    }

    // 削除機能
    public function destroy(Request $request)
    {
        Contact::find($request->id)->delete();

        return redirect('/admin')->with('message', 'お問い合わせ情報を削除しました');
    }

    // CSVダウンロード
    public function download()
    {
        //$contacts = Contact::with('category')->KeywordSearch($request->keyword)->GenderSearch($request->gender)->CategorySearch($request->category_id)->DateSearch($request->date);
        $contacts = Contact::all()->toArray();

        $head = [
            'ID',
            'カテゴリの種類',
            '名',
            '姓',
            '性別',
            'メールアドレス',
            '電話番号',
            '住所',
            '建物名',
            'お問い合わせ内容',
            '作成日',
            '更新日'
        ];

        $f = fopen('contacts.csv', 'w');
        if ($f) {
            // カラムの書き込み
            mb_convert_variables('SJIS', 'UTF-8', $head);
            fputcsv($f, $head);
            // データの書き込み
            foreach ($contacts as $contact) {
                mb_convert_variables('SJIS', 'UTF-8', $contact);
                fputcsv($f, $contact);
            }
        }
        // ファイルを閉じる
        fclose($f);

        // HTTPヘッダ
        header("Content-Type: application/octet-stream");
        header('Content-Length: ' . filesize('contacts.csv'));
        header('Content-Disposition: attachment; filename=contacts.csv');
        readfile('contacts.csv');

        return view('admin', compact('contacts'));
    }
}
