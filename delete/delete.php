<?php
session_start();
require_once("../mydb.php");
$pdo = db_connect();

$id = $_GET['id'] ?? null;
if (!$id || !ctype_digit($id)) exit("IDが不正です。");

try {
    $sql = "DELETE FROM kanri WHERE id = :id";
    $stmh = $pdo->prepare($sql);
    $stmh->bindValue(':id', $id, PDO::PARAM_INT);
    $stmh->execute();

    $_SESSION['message'] = "食品を削除しました。";
    header("Location: ../home.php");
    exit;

} catch (PDOException $e) {
    exit("エラー: " . $e->getMessage());
}