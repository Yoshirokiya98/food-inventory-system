<?php
session_start();
require_once("mydb.php");
$pdo = db_connect();

// 検索キーワード
$keyword = $_GET['keyword'] ?? '';

// ソート対象
$sort = $_GET['sort'] ?? 'syokuhin';

// 昇順・降順
$order = $_GET['order'] ?? 'ASC';

// 許可するカラム名
$allowedSort = ['syokuhin', 'seizou', 'zaiko'];

// 不正な値ならデフォルトに戻す
if (!in_array($sort, $allowedSort, true)) {
    $sort = 'syokuhin';
}

// order の切り替え
$nextOrder = ($order === 'ASC') ? 'DESC' : 'ASC';

// ソート矢印
$arrow = ($order === 'ASC') ? '▲' : '▼';

try {
    if ($keyword !== '') {
        $sql = "SELECT * FROM kanri 
                WHERE syokuhin LIKE :keyword 
                ORDER BY $sort $order";
        $stmh = $pdo->prepare($sql);
        $stmh->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
    } else {
        $sql = "SELECT * FROM kanri ORDER BY $sort $order";
        $stmh = $pdo->prepare($sql);
    }

    $stmh->execute();
    $rows = $stmh->fetchAll();

} catch (PDOException $e) {
    echo "エラー: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>食品一覧</title>
<link rel="stylesheet" href="css/home.css">
</head>
<body>

<h1>食品一覧</h1>

<?php if (!empty($_SESSION['message'])): ?>
    <div class="alert-success">
        <?= htmlspecialchars($_SESSION['message'], ENT_QUOTES, 'UTF-8') ?>
    </div>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>

<!-- 検索フォーム -->
<div class="search-box">
    <form method="get" action="home.php">
        <input type="text" name="keyword" placeholder="食品名で検索" 
               value="<?= htmlspecialchars($keyword) ?>">
        <button type="submit" class="search-btn">検索</button>
    </form>
</div>

<div class="container">

    <div class="table-note">※項目名をクリックすると昇順・降順が切り替わります</div>

    <?php if ($keyword !== '' && empty($rows)): ?>
    <div class="alert-success" style="text-align:center; margin-top:20px;">
        該当データがありません
    </div>

    <div style="text-align:center; margin-top:15px;">
        <a href="home.php" class="btn-back">一覧へ戻る</a>
    </div>

    <?php return; ?>
<?php endif; ?>

    <table>
        <tr>
            <th>
                <a href="home.php?sort=syokuhin&order=<?= $nextOrder ?>&keyword=<?= urlencode($keyword) ?>">
                    食品名 <?= ($sort === 'syokuhin') ? $arrow : '' ?>
                </a>
            </th>
            <th>
                <a href="home.php?sort=seizou&order=<?= $nextOrder ?>&keyword=<?= urlencode($keyword) ?>">
                    製造社名 <?= ($sort === 'seizou') ? $arrow : '' ?>
                </a>
            </th>
            <th>
                <a href="home.php?sort=zaiko&order=<?= $nextOrder ?>&keyword=<?= urlencode($keyword) ?>">
                    在庫数 <?= ($sort === 'zaiko') ? $arrow : '' ?>
                </a>
            </th>
            <th>更新</th>
            <th>削除</th>
        </tr>

        <?php foreach ($rows as $row): ?>
            <tr class="<?= ($row['zaiko'] == 0) ? 'zero-stock' : '' ?>">
                <td><?= htmlspecialchars($row['syokuhin']) ?></td>
                <td><?= htmlspecialchars($row['seizou']) ?></td>
                <td><?= htmlspecialchars($row['zaiko']) ?></td>

                <td>
                    <a href="update/update.php?id=<?= $row['id'] ?>" class="btn-update">
                        更新
                    </a>
                </td>

                <td>
                    <a href="delete/delete.php?id=<?= $row['id'] ?>" 
                       class="btn-delete"
                       onclick="return confirm('本当に削除しますか？');">
                        削除
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>

    <a href="insert/nyuryoku.php" class="btn-add">+ 食品を登録する</a>

</div>

</body>
</html>