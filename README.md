# ImgUploader

PHP + MySQL による簡易画像アップローダーサンプル


## 準備

- PHP + MySQL + httpd 環境の構築

## ファイル

- createtables.php : 必要なテーブルを作成する（最初に一回実行）

- credentials.php : 接続情報（このファイルをカスタマイズする必要有り）

- delete.php : 指定した画像の情報を DB から削除する

- index.php : 画像一覧を出力するページ（メインページ）

- loadimg.php : 画像バイナリを出力する

- up.php : アップロードされた画像バイナリを受け取って DB に格納する

- composer.json : IBM Bluemix 用

- .bp-config/options.json : IBM Bluemix 用

- colorbox.css, jquery.colorbox.min.js : jQuery ColorBox(http://www.jacklmoore.com/colorbox/)

- favicon.png : ファビコン

- README.md : このファイル

## 準備

- LAMP 環境を用意
 * IBM Bluemix であれば PHP ランタイムと MySQL サービス等をバインドする

- credentials.php ファイル内の MySQL 接続情報を更新
- HTML, PHP ファイル全てを PHP アプリケーションサーバーのドキュメントルートにデプロイ
 * IBM Bluemix であれば、HTML, PHP ファイル全てを PHP ランタイムにプッシュ

- アプリケーションサーバー上の createtables.php をブラウザから実行して、必要なテーブルを作成する

## 使い方

- 最初に一回だけ createtables.php をブラウザから呼び出して実行

- ブラウザでアプリケーションサーバーのドキュメントルートにアクセス（何も画像が登録されていないことを確認）して、画像をアップロード

- 改めてブラウザでアプリケーションサーバーのドキュメントルートにアクセスすると、追加した画像が一覧に含まれていて、クリックするとオリジナルサイズで表示されることを確認する。

## 開発者

- K.Kimura ( dotnsf@gmail.com ), all rights reserved.


