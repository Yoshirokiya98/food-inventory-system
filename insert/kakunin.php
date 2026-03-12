<?php
session_start();

$syokuhin = $_POST['syokuhin'] ?? '';
$seizou   = $_POST['seizou'] ?? '';
$zaiko    = $_POST['zaiko'] ?? '';

// ▼ エラーチェック ▼
$errors = [];

if ($syokuhin === '') {
    $errors[] = "食品名は必須です。";
}

if ($zaiko === '' || !ctype_digit($zaiko) || (int)$zaiko < 0) {
    $errors[] = "在庫数は0以上の整数で入力してください。";
}

// ▼ エラーがあれば入力画面へ戻す ▼
if (!empty($errors)) {
    $_SESSION['error'] = 
        "入力内容に誤りがあります：<ul><li>" .
        implode("</li><li>", $errors) .
        "</li></ul>";

    header("Location: nyuryoku.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>登録内容の確認</title>
    <link rel="stylesheet" href="../css/kakunin.css">
</head>
<body>

<h1>登録内容の確認</h1>

<div class="container">

    <table class="confirm-table">
        <tr><th>食品名</th><td><?= htmlspecialchars($syokuhin) ?></td></tr>
        <tr><th>製造社名</th><td><?= htmlspecialchars($seizou) ?></td></tr>
        <tr><th>在庫数</th><td><?= htmlspecialchars($zaiko) ?></td></tr>
    </table>

    <form action="insert.php" method="post" class="btn-area">
        <input type="hidden" name="syokuhin" value="<?= htmlspecialchars($syokuhin) ?>">
        <input type="hidden" name="seizou" value="<?= htmlspecialchars($seizou) ?>">
        <input type="hidden" name="zaiko" value="<?= htmlspecialchars($zaiko) ?>">

        <button type="submit" class="btn-submit">登録する</button>
        <a href="nyuryoku.php" class="btn-back">戻る</a>
    </form>

</div>

</body>
</html>