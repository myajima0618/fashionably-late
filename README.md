# お問い合わせフォーム
## 環境構築
### Dockerビルド
1．git clone git@github.com:coachtech-material/laravel-docker-template.git  
2．クローンしたディレクトリ名を変更  
	mv laravel-docker-template fashionably-late  
3．個人用リモートリポジトリの作成（GitHub上）  
4．名前を変更したディレクトリへ移動  
	cd fashionably-late  
5．ローカルリポジトリから紐づけ先を変更  
	git remote set-url origin 作成したリポジトリのurl  
6．git remote -v　で紐づけ先が自分の作成したURLになっていれば成功  
3．docker-compose コマンドでビルド  
	docker-compose up -d --build  

### Laravel環境構築
1．PHPコンテナへログイン  
	docker-compose exec php bash  
2．Laravelパッケージインストール  
	composer install  
3．.env.exampleファイルから.envファイルを作成  
	cp .env.example .env  
4．.envファイルの環境変数を変更  
	docker-compose.ymlで作成したデータベース名、ユーザ名、パスワードを記述する  
5．php artisan key:generate  
6．テーブル作成  
	_ php artisan make:migration create_contacts_table  
	_ php artisan make:migration create_categories_table  
	_ usersテーブルについてはデフォルトのものを活用  
7．カラム設定（マイグレーションファイルへの記述）  
	手順6で作成したファイルにカラムの設定を行う（参照：テーブル仕様書）  
8．マイグレーションの実行  
	php artisan migrate  
9．シーダーファイルの作成  
	php artisan make:seeder CategoriesTableSeeder  
10．シーダーファイルの編集後、シーダーファイルの登録  
11．シーディングの実行  
	php artisan db:seed  


## 使用技術
Laravel Framework 8.83.8  
PHP 7.4.9  
MySQL 8.0.35  

## ER図
![contact_ER drawio](https://github.com/myajima0618/fashionably-late/assets/161842305/d3799d30-58f6-44f8-9f60-1624d42f35ca)

## URL
開発環境：http://localhost/  
phpMyAdmin：http://localhost:8080/  
