<?php
session_start();
require_once("../mydb.php");
$pdo = db_connect();

$syokuhin = $_POST['syokuhin'] ?? '';
$seizou   = $_POST['seizou'] ?? '';
$zaiko    = $_POST['zaiko'] ?? '';

$errors = [];

if ($syokuhin === '') $errors[] = "食品名は必須です。";
if ($zaiko === '' || !ctype_digit((string)$zaiko)) $errors[] = "在庫数は0以上の整数で入力してください。";

if ($errors) {
    $_SESSION['message'] = implode("<br>", $errors);
    header("Location: nyuryoku.php");
    exit;
}

$seizou = ($seizou === '') ? null : $seizou;
$zaiko  = (int)$zaiko;

try {
    $sql = "INSERT INTO kanri (syokuhin, seizou, zaiko)
            VALUES (:syokuhin, :seizou, :zaiko)";
    $stmh = $pdo->prepare($sql);

    $stmh->bindValue(':syokuhin', $syokuhin, PDO::PARAM_STR);
    $stmh->bindValue(':seizou', $seizou, $seizou === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $stmh->bindValue(':zaiko', $zaiko, PDO::PARAM_INT);

    $stmh->execute();

    $_SESSION['message'] = "食品を登録しました。";
    header("Location: ../home.php");
    exit;

} catch (PDOException $e) {
    echo "エラー: " . $e->getMessage();
}