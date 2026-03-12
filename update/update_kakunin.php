<?php
session_start();

$id       = $_POST['id'] ?? '';
$syokuhin = $_POST['syokuhin'] ?? '';
$seizou   = $_POST['seizou'] ?? '';
$zaiko    = $_POST['zaiko'] ?? '';

if ($syokuhin === '' || $zaiko === '') {
    $_SESSION['message'] = "必須項目が未入力です。";
    header("Location: update.php?id=" . urlencode($id));
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>更新内容の確認</title>
<link rel="stylesheet" href="../css/update_kakunin.css">
</head>
<body>

<h1>更新内容の確認</h1>

<div class="container">

    <table class="confirm-table">
        <tr><th>食品名</th><td><?= htmlspecialchars($syokuhin) ?></td></tr>
        <tr><th>製造社名</th><td><?= htmlspecialchars($seizou) ?></td></tr>
        <tr><th>在庫数</th><td><?= htmlspecialchars($zaiko) ?></td></tr>
    </table>

    <form action="update_process.php" method="post" class="btn-area">
        <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
        <input type="hidden" name="syokuhin" value="<?= htmlspecialchars($syokuhin) ?>">
        <input type="hidden" name="seizou" value="<?= htmlspecialchars($seizou) ?>">
        <input type="hidden" name="zaiko" value="<?= htmlspecialchars($zaiko) ?>">

        <button type="submit" class="btn-submit">更新する</button>
        <a href="update.php?id=<?= htmlspecialchars($id) ?>" class="btn-back">戻る</a>
    </form>

</div>

</body>
</html>