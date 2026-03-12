<?php
session_start();
require_once("../mydb.php");
$pdo = db_connect();

$id       = $_POST['id'] ?? null;
$syokuhin = $_POST['syokuhin'] ?? '';
$seizou   = $_POST['seizou'] ?? '';
$zaiko    = $_POST['zaiko'] ?? '';

if (!$id || !ctype_digit($id)) exit("IDが不正です。");

$errors = [];
if ($syokuhin === '') $errors[] = "食品名は必須です。";
if ($zaiko === '' || !ctype_digit((string)$zaiko)) $errors[] = "在庫数は0以上の整数で入力してください。";

if ($errors) {
    $_SESSION['message'] = implode("<br>", $errors);
    header("Location: update.php?id=" . urlencode($id));
    exit;
}

$seizou = ($seizou === '') ? null : $seizou;
$zaiko  = (int)$zaiko;

try {
    $sql = "UPDATE kanri SET syokuhin=:syokuhin, seizou=:seizou, zaiko=:zaiko WHERE id=:id";
    $stmh = $pdo->prepare($sql);

    $stmh->bindValue(':syokuhin', $syokuhin, PDO::PARAM_STR);
    $stmh->bindValue(':seizou', $seizou, $seizou === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $stmh->bindValue(':zaiko', $zaiko, PDO::PARAM_INT);
    $stmh->bindValue(':id', $id, PDO::PARAM_INT);

    $stmh->execute();

    $_SESSION['message'] = "食品情報を更新しました。";
    header("Location: update_done.php");
    exit;

} catch (PDOException $e) {
    exit("エラー: " . $e->getMessage());
}