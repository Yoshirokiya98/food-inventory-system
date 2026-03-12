<?php
session_start();
$message = $_SESSION['message'] ?? "食品データを更新しました。";
unset($_SESSION['message']);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>更新完了</title>
<link rel="stylesheet" href="../css/update_done.css">
</head>
<body>

<h1>更新完了</h1>

<div class="container">

    <div class="alert-success">
        <?= htmlspecialchars($message) ?>
    </div>

    <div class="btn-area">
        <a href="../home.php" class="btn-home">一覧へ戻る</a>
    </div>

</div>

</body>
</html>