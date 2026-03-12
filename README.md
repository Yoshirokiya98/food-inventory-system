# 食品在庫管理システム（Food Inventory System）

PHP / MySQL を使用して開発した、食品の在庫管理システムです。  
食品の登録・更新・削除・検索・ソートなど、基本的な CRUD 操作を備えています。  
簡素な入力フォームやエラー表示など、ユーザーが使いやすい画面設計を行いました。

---

## 主な機能

食品登録機能
 - 食品名（必須）
 - 製造社名（任意）
 - 在庫数（必須・0以上の整数）
 - 入力チェック
 - エラー時のメッセージ表示

食品一覧表示
- 登録された食品を一覧で表示
- 在庫数の昇順・降順ソート
- 在庫 0 の食品を強調表示

食品情報の更新
- 既存データの編集
- 更新完了画面の表示

食品の削除
- 削除確認画面あり
- 誤操作防止の画面操作設計

---
  
## 使用技術
- 言語:PHP / HTML / CSS
- データベース:MySQL

---

##  DB 接続ファイルについて

セキュリティのため、実際の接続情報を含む **mydb.php** は公開していません。  
代わりに **mydb_sample.php** を掲載しています。

実行する際は、mydb_sample.php をコピーして **mydb.php** を作成し、  
以下の項目を環境に合わせて書き換えてください。

- host
- dbname
- username
- password

---

##  セットアップ手順

1. リポジトリをクローン
  
2. テーブルを作成
   任意のデータベースを作成してください。
   例：CREATE DATABASE food_inventory;
   
3.  本システムで使用するテーブルは以下の通りです。

    CREATE TABLE kanri ( id INT AUTO_INCREMENT PRIMARY KEY, syouhin VARCHAR(255) NOT NULL,
                         seizou VARCHAR(255), zaiko INT NOT NULL,
                         created_at DATETIME DEFAULT CURRENT_TIMESTAMP );

5. `mydb_sample.php` を `mydb.php` にコピー
  
6. `mydb.php` の接続情報を編集（ DB 接続ファイルについてを参照）
  
7. ローカルサーバー（XAMPP など）で `home.php` を開く
　　例：http://localhost/food-inventory-system/home.php

---

## 画面サンプル

・食品登録画面
![register](images/register.png)

・エラー表示（バリデーション）
![error](images/error.png)

・一覧画面（在庫ソート）
![list](images/list.png)

・更新画面
![update](images/update.png)

---

## 工夫した点

- 操作のしやすさを意識した画面設計  
- エラー表示を箇条書き・中央寄せで見やすく改善  
- 在庫 0 の強調表示による視認性向上   
- 保守性を考慮したフォルダ構成  
