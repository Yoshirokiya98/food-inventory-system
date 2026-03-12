<?php
// これはサンプルです。実際の接続情報は含めません。
function db_connect() {
    $dsn = "mysql:host=localhost;dbname=your_dbname;charset=utf8";
    $user = "your_username";
    $password = "your_password";

    try {
        $pdo = new PDO($dsn, $user, $password);
        return $pdo;
    } catch (PDOException $e) {
        echo "DB接続エラー: " . $e->getMessage();
        exit;
    }
}