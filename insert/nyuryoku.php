<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>食品登録</title>
    <link rel="stylesheet" href="../css/nyuryoku.css">
</head>
<body>

<h1>食品登録</h1>

<?php
session_start();
if (!empty($_SESSION['error'])) {
    echo '<div class="error-message">'.$_SESSION['error'].'</div>';
    unset($_SESSION['error']); // ← 表示後に消す
}
?>

<div class="form-box">

    <!-- 必須項目の説明 -->
    <p class="form-note">※（必須）は入力が必要な項目です</p>

    <form action="kakunin.php" method="post">

        <label>食品名 <span class="required">（必須）</span></label>
        <input type="text" name="syokuhin">

        <label>製造社名 <span class="optional">（任意）</span></label>
        <input type="text" name="seizou">

        <label>在庫数 <span class="required">（必須）</span></label>
        <input type="number" name="zaiko">

        <button type="submit" class="btn-submit">確認画面へ</button>
    </form>

    <a href="../home.php" class="btn-back">← 戻る</a>
</div>

</body>
</html>