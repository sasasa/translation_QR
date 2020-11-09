# 翻訳QR説明書 管理者マニュアル


## はじめに
はじめに翻訳QRとは
* 複数言語で飲食店のメニューを作成可能です。
* お客様のスマホでQRコードで読み込んだメニューから注文や決済が可能です。
* お店のPCやスマホから管理画面を開き注文情報の一元管理が可能です。

---

## ユーザーログイン
1. http://url/home/ にアクセスする。とログイン画面が表示されます。
![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/dab6c2e5-331a-3b8f-4265-ce1640d341fe.png)

1. 以下のユーザー情報を入力してログインすると管理画面に遷移します。普段からこのページを利用することになります。最初にログインした際は「ユーザー管理」の「パスワード変更」からパスワードを変更することをお願いいたします。

| email | pass |
| -------------------- | --------- |
| fulltime0@gmail.com  | hogehoge  |
![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/52eb3e1f-c98d-66a4-049c-b28dbb865fda.png)



## ユーザーログアウト
![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/9ced55d0-7079-279b-858d-b2661a7644b0.png)

管理画面で名前をクリックするとログアウトと表示されるのでクリックするとログアウトします。

## 売上確認
![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/72f69bd2-45e6-b6b7-4a61-575e7a2c8842.png)

売上額(税を含む)の確認ができます。ログインユーザーに閲覧以上の権限がないとアクセスできません。
「検索開始日」以上(>=)、「検索終了日」未満(<)で設定した日付の間に発生した売上額を表示します。
閉め日に応じて「検索開始日」「検索終了日」を設定して「検索」ボタンを押してください。



<div style="page-break-before:always"></div>

## 人気商品確認
![localhost_aggregate.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/ead25a41-81ae-c48e-f028-c02983919221.png)

人気・不人気商品の確認ができます。ログインユーザーに閲覧以上の権限がないとアクセスできません。
「検索開始日」以上(>=)、「検索終了日」未満(<)で設定した日付の間の人気商品順に表示します。
閉め日に応じて「検索開始日」「検索終了日」を設定して「検索」ボタンを押してください。

### 売り上げ個数
![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/6bb46b27-05f6-904c-b967-29e7392f8ef1.png)

「売り上げ個数」を選択した場合は「売り上げ個数」が表示され順番に並びます。

### 売り上げ額
![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/bbb510c6-078c-110e-9732-622440e529e2.png)

「売り上げ額」を選択した場合は「売り上げ額」が表示され順番に並びます。



<div style="page-break-before:always"></div>

## メニュー画面・注文画面
![localhost_items.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/5aa354cd-d0ab-905d-d831-1b1fee558a70.png)

メニュー画面・注文画面です。お客様はQRコードを読み取りご自身のスマホからアクセスします。席ごとにQRコードが異なり席を識別することが出来ます。
メニュー画面・注文画面には管理画面からもアクセス可能です。
お客様はこの画面から注文したりお会計を呼んだりできます。
管理画面でジャンルやメニューを用意しさえすれば英語、中国語、韓国語での表示も可能です。

<div style="page-break-before:always"></div>

### 席を選択してメニュー表示
![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/1833961d-8760-722b-e97c-59210b2e905e.png)

ログインユーザーに閲覧以上の権限がないと表示されません。
座席を選択してその注文画面を開くことが出来ます。
※まれにメニュー画面が立ち上がらない場合があります。その場合は座席を何度か選び直してください。

### 言語の切り替え
![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/e1d40183-cc46-1a66-9de4-ec7dcf4ffedc.png)

上記リンクをクリックすると使用言語を切り替えることが出来ます。
管理画面で各国語分のジャンルやメニューを作成する必要があります。

### メニューの切り替え
![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/cd2a7e59-54e4-f6a7-f1e5-90473e949b31.png)

上記リンクでジャンル名をクリックすると表示するメニューを切り替えることが出来ます。

<div style="page-break-before:always"></div>

### 「カートに入れる」もしくは「カートから削除」
![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/8a2b0f2d-5728-813b-3313-fac5aec812c0.png)

「+」をクリックすると商品をカートに入れることが出来ます。
「-」をクリックすると商品をカートから削除することが出来ます。

### カートを見る
![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/5b42d9a9-1213-f068-b67e-673038d5d0e1.png)

「カートを見る」をクリックするとメニューからカート内に遷移します。購入予定のメニューのみが表示されます。

![localhost_items.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/6911516a-9369-1090-dfd6-ececdc491d2d.png)

カート内でも「+」をクリックすると商品をカートに入れることが出来ます。
「-」をクリックすると商品をカートから削除することが出来ます。

### 注文を確定する
![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/299bf7a6-b242-885f-f314-7deae3136181.png)

カート内から注文を確定することが出来ます。「注文を確定する」をクリックすると注文完了画面に遷移します。

![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/0495a0be-9fd7-c223-98a6-e0deecda1aa1.png)

注文完了画面からは注文内容を確認できます。
お客様は注文を終えて料理が来るのを待っている状態になります。
「メニューに戻る」をクリックすると再びメニューが表示されます。
「お会計」をクリックするとサンクスページに遷移します。

### お会計 サンクスページ
![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/d9199d55-af8a-c547-13cd-745edc43a937.png)

「お会計」をクリックするとサンクスページに遷移します。
お客様は店舗の従業員が明細を持ってくるのを待っている状態になります。

<div style="page-break-before:always"></div>

### paypay支払い サンクスページ
![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/75dd2628-150e-d935-cc8e-10d5ab9d772f.png)

paypayに申し込んでいる場合は「paypay支払い」ボタンが表示されます。「paypay支払い」をクリックするとpaypayアプリが起動して支払うことが出来ます。支払いを済ませるとサンクスページに遷移します。以下の様に画面が遷移していきます。

<img src="https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/b88a482d-124d-bb29-6ef9-2538238b6944.jpeg" width="200">
<img src="https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/fb5d57ea-814a-74e5-e62b-0eae6249b675.jpeg" width="200">
<img src="https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/b01bdb15-357b-3ff9-d78c-d14e2708be77.jpeg" width="200">



<div style="page-break-before:always"></div>

## 注文・お会計確認
![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/89d6cccd-70d1-e014-0e70-215676486ef6.png)

リアルタイムに注文とお会計の確認ができます。注文やお会計が入るたびに色と音で知らせてくれます。
どの業務が残っているのか一目瞭然となり画面上から「注文」や「お会計」を消していくことが目的になります。
ログインユーザーに閲覧以上の権限がないとアクセスできません。
「注文」は席名、メニュー名を確認して「準備中」→「お届け済み」と切り替えて行きます。
「お会計」は席名、お会計額を確認して「準備中」→「プリント中」→「精算後」と切り替えていきます。
もしくは「paypay支払い」→「精算後」と切り替えます。

<div style="page-break-before:always"></div>

### お会計　準備中　→　プリント中
![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/2027bbd9-75e1-9b0d-3329-8d90ee1f80a6.png)

お会計を「プリント中」に切り替えると明細の印刷画面が立ち上がるのでそこで印刷を行います。
サーマルプリンターをご用意ください。印刷を終えるかキャンセルするとページが自動で閉じられます。
※印刷設定は起動時に行う必要があります。
※まれに印刷画面が立ち上がらない場合があります。その場合は「準備中」→「プリント中」と選択し直してください

![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/49209e01-16f2-7d56-41af-d848de494841.png)

### お会計　プリント中　→　精算後
![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/40f35fba-bd1b-dc42-3140-54ec5a8b60ae.png)

明細が印刷出来たらお客様の下に行き精算を行なっていただきます。
その後お会計を「精算後」に切り替えると30秒ほどで項目が消えますのでこれで一連の「お会計」の業務が完了です。

### お会計　paypay支払い　→　精算後
![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/fdfb047f-3404-ab9f-6543-f65ba976e64f.png)

お客様がpaypayで支払う際は項目が「paypay支払い」となります。
お客様の下に行き本当に支払っていただいたかどうか確認を行なっていただきます。
スマホの画面を提示していただき以下の様な表示になっていたらpaypayでの支払いは終了しています。

<img src="https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/fb5d57ea-814a-74e5-e62b-0eae6249b675.jpeg" width="300">
<img src="https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/b01bdb15-357b-3ff9-d78c-d14e2708be77.jpeg" width="300">

その後お会計を「精算後」に切り替えると30秒ほどで項目が消えますのでこれで一連の「お会計」の業務が完了です。

![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/a337b0cd-5687-dd44-1aaf-4eefe448e2bf.png)

### 注文　店内飲食　→　テイクアウト　もしくは　テイクアウト　→　店内飲食
![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/8517dfa2-7591-c5b2-4430-d0d8664c84cf.png)

すでに注文を済ませたお客様から「さっきの注文をテイクアウトにして下さい」などと
注文の変更の依頼があった場合「テイクアウト」や「店内飲食」に切り替えます。
もし依頼通りにした場合は税率が異なりますので必ず忘れない様にこの項目を切り替えてください。

<div style="page-break-before:always"></div>

### 注文　準備中　→　キャンセル
![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/a303b893-1863-d79b-d1c5-a4a896a15635.png)

すでに注文を済ませたお客様から「さっきのパスタの注文をキャンセルして下さい」などと
注文のキャンセルの依頼があった場合「キャンセル」に切り替えます。
「キャンセル」に切り替えてから30秒ほどで項目が消えます。
もし依頼通りにキャンセルした場合はお会計額が異なりますので必ず忘れない様にこの項目を切り替えてください。またこちらの画面のみ「キャンセル」に切り替えてしまって間違って調理してしまわない様に厨房へ連絡もお願いいたします。

### 注文　準備中　→　お届け済み
![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/29cd453e-b37a-4530-bb3d-28de853d1666.png)

お客様に料理をお届けした後で「お届け済み」に切り替えます。
「お届け済み」に切り替えてから30秒ほどで項目が消えます。
座席名とメニュー名が一致しているかよく確認してから切り替えてください。
これで一連の「注文」の業務が完了です。



<div style="page-break-before:always"></div>

## ユーザー管理
![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/17f8d85a-08c4-283d-413e-5018301800c8.png)

翻訳QRにアクセスできるユーザーを管理します。ログインユーザーに編集権限がないとアクセスできません。新たなユーザーを作成、削除したり権限を付与したりできます。店舗の責任者は編集権限をもちアルバイトには閲覧権限を与えるというような使い方をします。店舗の責任者は自分自身の権限を剥奪しないように注意してください。

### ユーザー新規作成
![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/a61cb0a8-9c72-9040-d560-d3391063b35a.png)

* 氏名を入力します。ログインしている際は管理画面上に表示されます。
* メールアドレスを入力します。ログインの際必要になります。
* パスワードを入力します。ログインの際必要になります。
* 権限を選択します。店舗の責任者は編集権限をもちアルバイトには閲覧権限を与えるというような使い方をします。権限無しのユーザーは何もすることができません。


### ユーザー編集
![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/5b1dae34-a12f-483b-c2e9-064ea52999dd.png)

* 氏名を変更します。ログインしている際は管理画面上に表示されます。
* メールアドレスを変更します。ログインの際必要になります。
* 権限を変更します。


### パスワード変更
![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/9704c25e-0d90-c199-3843-71ce7a517b5d.png)

* パスワードを変更します。ログインの際必要になります。
* パスワード(確認用)、パスワードと同一の値を入力します。

### ユーザー削除
![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/62dc0dd7-8cd3-e4ce-dd47-6a864306e5d5.png)

「閲覧権限」と「権限無し」のユーザーを削除することができます。



<div style="page-break-before:always"></div>

## ジャンル管理
![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/f1e7ef08-2604-babc-5685-29616978058c.png)

ジャンルの管理に利用します。ログインユーザーに編集権限がないとアクセスできません。
ジャンルはメニューを表示する際にカテゴリー分けに利用します。フォルダーのようなものです。2階層まで階層化することができます。まず日本語でジャンルを作りそれをコピーして他言語のジャンルを作る手順になります。同一のキーを持つ者同士は同じ色で表示されます。

### ジャンル新規作成
![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/73013018-ad26-d94f-00c2-188722f5c00b.png)

* ジャンルキーを入力します。URLの一部になります。言語が異なっていても同一ジャンルならば同じキーになります。
* 言語を選択します。表示したい言語を選択するとその言語のページで表示されます
* ジャンルを入力します。ページに表示されるジャンル名です。適切に翻訳する必要があります。
* 表示順(数値が大きいほど前に表示)を入力します。前に表示したいものほど数値を大きくします。
* 親を選択します。親を選択するとジャンルを階層構造にできます。

### 他言語ジャンル作成
![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/a4147887-e53f-6090-b4e9-375511c8f2ed.png)

日本語ジャンルを作成すると「他言語ジャンル作成」ボタンが出現するのでクリックすると必要な情報がコピーされた状態で英語、中国語、韓国語のジャンルが自動で作成される。あとは適切な翻訳を入れるだけです。

### ジャンル編集
![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/d12fb3d9-ad93-2e7c-ea91-1860ec884ee0.png)

* ジャンルキーは変更できません。
* 言語は変更できません。
* ジャンルを変更します。ページに表示されるジャンル名です。言語によっては翻訳が必要です。
* 表示順(数値が大きいほど前に表示)を変更します。前に表示したいものほど数値を大きくします。言語ごとに表示順を変えることもできます。
* 親を選択します。親を選択するとジャンルを階層構造にできます。

### ジャンル削除
ジャンルを削除します。



<div style="page-break-before:always"></div>

## アレルギー品目管理
![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/6cca43d9-64c4-a718-4dfe-e4a8258bb320.png)

アレルギー品目を管理します。ログインユーザーに編集権限がないとアクセスできません。最初からアレルギー27品目の各国言語分が用意されています。アレルギーの表示義務が変わらない限り扱うことはない管理画面です。ジャンルと同じでまず日本語でアレルギーを作りそれをコピーして他言語のアレルギーを作る手順になります。同一のキーを持つ者同士は同じ色で表示されます。

### アレルギー品目新規作成
![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/65f38eea-661c-23ea-04a9-d41471781236.png)

* アレルギー品目のキーを入力します。新たにキーを作成した時は画像をpublic/img/allergens/{キー}.pngという形で準備する必要があります。言語が異なっていても同一アレルギー品目ならば同じキーになります。
* 言語を選択します。
* アレルギー品目の名前を入力します。適切に翻訳する必要があります。

<div style="page-break-before:always"></div>

### 他言語アレルギー品目作成
![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/0c77b231-3232-a325-0b48-56d71675bc9e.png)

日本語でアレルギー品目を作成すると「他言語アレルギー品目作成」ボタンが出現するのでクリックすると必要な情報がコピーされた状態で英語、中国語、韓国語のアレルギー品目が自動で作成される。あとは適切な翻訳を入れるだけです。

### アレルギー品目編集
![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/9e748ec3-6f86-df8f-86e4-677f696b1044.png)

* アレルギー品目のキーは変更できません。
* 言語は変更できません。
* アレルギー品目の名前を変更します。適切に翻訳する必要があります。
### アレルギー品目削除
アレルギー品目を削除します。



<div style="page-break-before:always"></div>

## メニュー管理
メニューを管理します。検索、作成、変更、削除ができます。
ログインユーザーに編集権限がないとアクセスできません。
まず日本語でメニューを作りそれをコピーして他言語のメニューを作る手順になります。
品切れの場合もこの画面から設定します。同一のキーを持つ者同士は同じ色で表示されます。

### メニュー検索
![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/5d8ca247-c410-da86-fbf7-b9b6a31a8b39.png)

各項目はAND検索で対象を絞り込んでいくようになっています。「ジャンルキー」を選択してさらに「言語」を選択するという使い方が多くなります。

* 商品キー、ピンポイントで商品キーで絞り込みたい時に入力します。
* 商品名、ピンポイントで商品名で絞り込みたい時に入力します。
* ジャンルキーから絞り込みたいときに選択します。
* 言語から絞り込みたいときに選択します。

<div style="page-break-before:always"></div>

### 品切れにする(全ての言語)　もしくは 販売開始する(全ての言語)
![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/5651c232-5b87-6158-4191-6e85abd6650c.png)
![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/718c7999-0fa2-68c0-4a47-d2656e6b14a3.png)

日本語メニューのみに表示されます。品切れなどで注文を受けられない場合はこの機能を使います。
「品切れにする(全ての言語)」をクリックするとメニュー画面から注文できなくなります。「販売開始する(全ての言語)」をクリックするとメニュー画面から再び注文できるようになります。日本語のメニューを切り替えたら
その他の言語の同一キーのメニューも品切れにすることができます。品切れにしたまま忘れると機会損失になりますので品切れが解消したら必ず忘れずに販売開始してください。

<div style="page-break-before:always"></div>

### メニュー新規作成
![localhost_3002_items_create.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/0834c718-e63e-7d59-70d0-16c2d075ebd2.png)

メニューを新規作成します。主に日本語メニューを作成するのに利用します。

* 商品キー、その商品を識別するためのキーを設定します。言語が異なっていても同一メニューならば同じキーになります。
* 言語、表示する言語を選択します。まずは日本語からメニューを作成します。
* 商品名、その商品の名前を入力します。メニュー画面で表示されます。適切に翻訳する必要があります。
* 価格、税無しの価格を入力します。
* 表示順(数値が大きいほど前に表示)、メニュー画面や管理画面上での表示順になります。
* 説明、メニュー画面で表示される説明文を入力します。適切に翻訳する必要があります。
* 画像、メニュー画面で表示される画像を設定します。
* ジャンル、どのジャンルに紐づくかを設定します。設定したジャンルをメニュー画面で選ぶと表示されます。
* アレルギー品目、言語を選択するとどのアレルギー品目にあたるか選択できるようになります。レシピを元に不足なく設定してください。


### 他言語メニュー作成
![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/850c2da9-1b7b-e567-3f9c-4410a66b01af.png)

日本語メニューのみに表示されます。「他言語メニュー作成」をクリックすると必要な情報をコピーした他言語のメニューを作成することができます。

![localhost_items_create_by_key_149.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/dbc57e77-bc59-c3a1-31ff-c4885ab08046.png)

「他言語メニュー作成」をクリックすると他言語メニュー作成画面が表示されます。
主となる日本語メニューから必要な情報(ジャンルやアレルギー品目の情報)をコピーして他言語のメニューが作成されます。

* 商品キーは変更することが出来ません。
* 言語、言語を選択します。英語、中国語、韓国語の中から選択します。
* 商品名、その商品の名前を入力します。メニュー画面で表示されます。適切に翻訳する必要があります。
* 説明、メニュー画面で表示される説明文を入力します。適切に翻訳する必要があります。

<div style="page-break-before:always"></div>

### メニュー編集
![localhost_items_153_edit.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/551cfecd-f1f1-11a9-817b-8884c0eff010.png)

メニューを編集します。名前を変更、画像を差し替えたり、価格を変更したりできます。
※注意、一度作成されたメニューはそれぞれ独立しています。日本語のメニューを変更してもその他の言語のメニューは変更されません。変更がある場合は全ての言語の分を変更をする必要があります。

* 商品キーは変更できません。
* 言語は変更できません。
* 商品名、その商品の名前を入力します。メニュー画面で表示されます。適切に翻訳する必要があります。
* 価格、税無しの価格を入力します。
* 表示順(数値が大きいほど前に表示)メニュー画面や管理画面上での表示順になります。
* 説明、メニュー画面で表示される説明文を入力します。適切に翻訳する必要があります。
* 画像、「削除する」をクリックすると画像を差し替えることができます。
* ジャンル、どのジャンルに紐づくかを設定します。メニュー画面で設定したジャンルに表示されます。
* アレルギー品目、どのアレルギー品目にあたるか選択できるようになります。レシピを元に不足なく設定してください。

### メニュー削除
メニューを削除します。

<div style="page-break-before:always"></div>

## 座席管理
![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/5928ce62-18d3-0419-96aa-e0c60a0d852d.png)

座席の管理を行います。ログインユーザーに編集権限がないとアクセスできません。
初期設定時や座席の増減がある場合、QRコードの再生成や印刷を行います。

### 座席新規作成
![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/5e93e548-50d5-ee4b-b706-f4977859f689.png)

* 座席名を入力します。席に分かりやすい名前をつけてください。
* 座席数を入力します。何名席かを入力してください。

<div style="page-break-before:always"></div>

### 座席編集
![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/17cfa4a8-1df5-0edc-4d71-387da9cad7ce.png)

管理画面で座席名をクリックすると座席編集ができます。

* 座席名を入力します。席に分かりやすい名前をつけてください。
* 座席数を入力します。何名席かを入力してください。

### QRコードを再生成
![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/1a5936b2-9079-ac1d-0920-6056affef4b6.png)

「QRコードを再生成」をクリックすると
座席の注文用のURLのQRコードを再生成します。注文のいたずらなどが起こった場合は再生成を行なってください。お客様がご利用の最中に再生成を行なってしまうとお会計が正しく出来ませんのでご注意ください。

<div style="page-break-before:always"></div>

### QRコードを印刷
![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/598261/7d8165dd-2390-0369-93d3-ed744ac3a667.png)

「QRコードを印刷」をクリックするとその座席のQRコードの印刷を行います。サーマルプリンターをご用意ください。印刷を終えるかキャンセルするとページが自動で閉じられます。
※印刷設定は起動時に行う必要があります。

### 座席削除
座席を削除します。