<?php
/**
 * mydb_sample.php
 * 
 * これはサンプルファイルです。
 * 実際の接続情報（ホスト名・ユーザー名・パスワード）は含めていません。
 * 実行する際は、このファイルを「mydb.php」としてコピーし、
 * 適切な接続情報を入力してください。
 */

function db_connect() {
    // ▼ 必要に応じて書き換えてください ▼
    $dsn = "mysql:host=localhost;dbname=your_dbname;charset=utf8";
    $user = "your_username";
    $password = "your_password";

    try {
        $pdo = new PDO($dsn, $user, $password);
        // エラーを例外として扱う（デバッグしやすくなる）
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;

    } catch (PDOException $e) {
        echo "データベース接続エラー: " . $e->getMessage();
        exit;
    }
}
