# 翻訳QR
翻訳QRを動かすにあたって必要な情報を記します。
翻訳QRのアプリケーションの説明書は![manual.pdf](https://github.com/sasasa/translation_QR/blob/master/manual.pdf)にあります。

## インストール
* Gitをインストールして下さい。Macの場合はHomebrewでインストールして下さい。Windowsの場合は![Git for Windows](https://gitforwindows.org/)をインストールして下さい。
* ソースコードを見るためには![vscode](https://code.visualstudio.com/download)をインストールしてください
* 動作環境として![Docker Desktop for Windows](https://hub.docker.com/editions/community/docker-ce-desktop-windows) もしくは![Docker Desktop for Mac](https://hub.docker.com/editions/community/docker-ce-desktop-mac/)をインストールしてください

## vscode拡張機能
PHP(Laravel)で書かれたソースコードを確認するにはvscodeに
以下の拡張機能をインストールしてください。

* PHP Intelephense(似たものにPHP IntelliSenseがあるが機能が劣るためこちらにする)
* PHP Debug(x-debugを動かすのに必要)
* Laravel Snippets
* Laravel Blade Snippets
* Laravel Artisan
* Laravel Extra Intellisense
* Laravel goto view
* laravel-goto-controller

### vscode組み込みの機能を無効にする
* php.suggest.basicのチェックを外す
* php.validate.enableのチェックを外す

### PHP Debug設定/.vscode/launch.json
```javascript
{
  "version": "0.2.0",
  "configurations": [
    {
      "name": "XDebug on docker",
      "type": "php",
      "request": "launch",
      "port": 9000,//php.iniで設定したxdebug用のport番号
      "pathMappings": {
          // {docker上のlaravel root}:{ローカルlaravel root}
          "/work":"/プロジェクトルートまでのパス/backend"
      },
      "ignore": [
          "**/vendor/**/*.php"
      ],
    }
  ]
}
```

### Laravel goto view設定setting.json
```javascript
{
  "laravel_goto_view.folders": {

      "default": "/backend/resources/views",
      "vendor": "/backend/resources/views/vendor"
  }
}
```
### laravel-goto-controller設定setting.json
```javascript
{
  "laravel_goto_controller.pathController": "/backend/app/Http/Controllers"
}
```

---

## 翻訳QRを動かす手順

以下のどの場所でコマンドを実行するかよく確認してください。
* [pc]... お手元のパソコン環境MacかWindows
* [web]... Dockerのwebコンテナ内
* [app]... Dockerのappコンテナ内
* [db]... Dockerのdbコンテナ内

### Gitで落としてきたアプリをDockerで立ち上げる
```
[pc]$ exec winpty bash
[pc]$ git clone git@github.com:sasasa/translation_QR.git
[pc]$ cd translation_QR
[pc]$ docker-compose up -d --build
```
### 以下の表示でDockerコンテナが立ち上がっている
```
Creating translation_qr_app_1 ... done
Creating translation_qr_db_1  ... done
Creating translation_qr_phpmyadmin_1 ... done
Creating translation_qr_web_1        ... done
```

### npmのインストール
```
[pc]$ docker-compose exec web sh
[web]# npm install
[web]# exit
```

### Laravelのインストールと設定
```
[pc]$ docker-compose exec app bash
[app]# COMPOSER_MEMORY_LIMIT=-1 composer install
[app]# cp .env.example .env
[app]# php artisan key:generate
[app]# php artisan migrate
[app]# php artisan db:seed
[app]# chmod 777 -R storage/
[app]# php artisan storage:link
[app]# exit
```

### DBの確認
```
[pc]$ docker-compose exec db bash
[db]# mysql -u root -p translation (passを聞かれたらsecret)
mysql> show tables;
mysql> SELECT * FROM users;
mysql> exit
[db]# exit
```


### アプリにアクセスできるか確認
https://localhost/home#/
にアクセスして以下のアカウントで入ることができるかを確認する。
| email | pass |
| ------------- | ------------- |
| fulltime0@gmail.com  | hogehoge  |


### MyPHPAdminにアクセスできるか確認
http://localhost:8080/
にアクセスしてtranslationデータベース内のテーブルを確認できるかを確認する。

## 翻訳QRのデザインを変更する際の手順

### 変更すべき箇所
* /backend/resources/views/*.blade.php
* /backend/resources/js/components/*.vue
* /backend/resources/sass/*.scss

### 変更手順
1. ```docker-compose exec web npm run watch```で変更を待ち受ける
1. https://localhost:3000/home# にアクセスする
1. 変更したいURLを調べる。(例：https://localhost/d6c145bfd54212e280262ee0f913575bf8c727bf55e71f578547a37e65d55572/items#/ja/drink
1. /backend/routes/web.phpでどのルートかを確認する(例：`Route::get('{seat_hash}/items', 'ItemsController@items');`
1. コントローラーを見てどのviewを使っているかを確認する(例：'items.items'とあるので/backend/resources/views/items/items.blade.phpを使っているということが分かる。
1. ふつうはこのページを書き換えて終了だがvue.jsを使っている場合はさらに調査が必要。(例：&lt;router-view&gt;とあるのでvue-routerを使っているとわかる。
1. vue-routerの設定は/backend/resources/js/router.jsにあるので確認すると(例：#/ja/drinkに当てはまるのはMenuComponent.vueだと確認できる。
1. /backend/resources/js/components/MenuComponent.vueを変更する
1. npm run watchが変更を探知して自動でビルドする。

### ※自動でビルドしてくれないときは
dockerではなくローカル環境にnpmをインストールする必要がある。
