<?php
session_start();
require_once("../mydb.php");
$pdo = db_connect();

$id = $_GET['id'] ?? null;
if (!$id || !ctype_digit($id)) exit("IDが不正です。");

try {
    $sql = "SELECT * FROM kanri WHERE id = :id";
    $stmh = $pdo->prepare($sql);
    $stmh->bindValue(':id', $id, PDO::PARAM_INT);
    $stmh->execute();
    $row = $stmh->fetch();
    if (!$row) exit("データが見つかりません。");

} catch (PDOException $e) {
    exit("エラー: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>更新</title>
<link rel="stylesheet" href="../css/update.css">
</head>
<body>

<h1>食品情報の更新</h1>

<div class="form-box">
    <form method="post" action="update_kakunin.php">
        <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>">

        <label>食品名</label>
        <input type="text" name="syokuhin" value="<?= htmlspecialchars($row['syokuhin']) ?>" required>

        <label>製造社名</label>
        <input type="text" name="seizou" value="<?= htmlspecialchars($row['seizou'] ?? '') ?>">

        <label>在庫数</label>
        <input type="number" name="zaiko" value="<?= htmlspecialchars($row['zaiko']) ?>" required min="0">

        <button type="submit" class="btn-submit">確認画面へ</button>
    </form>

    <a href="../home.php" class="btn-back">← 戻る</a>
</div>

</body>
</html>