<?php
require_once __DIR__ . '/includes/db.php';

// Настройки пагинации
$perPage = 5;
$page    = max(1, (int)($_GET['page'] ?? 1));
$offset  = ($page - 1) * $perPage;

// Общее количество статей
$countRes = pg_query($conn, "SELECT COUNT(*) FROM articles");
$total    = (int)pg_fetch_result($countRes, 0, 0);
$pages    = ceil($total / $perPage);

// Выборка текущей страницы
$sql = "SELECT id, title, content, author_name, rating, created_at 
        FROM articles 
        ORDER BY created_at DESC 
        LIMIT $1 OFFSET $2";
$res = pg_query_params($conn, $sql, [$perPage, $offset]);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Список статей</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1> Статьи</h1>
    <a href="pages/add_article.php" style="display:inline-block; margin-bottom:15px; padding:6px 12px; background:#007bff; color:#fff; text-decoration:none;">+ Добавить статью</a>
    <hr>

    <?php if ($total === 0): ?>
        <p>Статей пока нет.</p>
    <?php else: ?>
        <table border="1" cellpadding="8" style="border-collapse:collapse; width:100%;">
            <tr style="background:#f4f4f4;">
                <th>ID</th><th>Заголовок</th><th>Автор</th><th>Рейтинг</th><th>Дата</th>
            </tr>
            <?php while ($row = pg_fetch_assoc($res)): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars(mb_strimwidth($row['title'], 0, 40, '...')) ?></td>
                <td><?= htmlspecialchars($row['author_name']) ?></td>
                <td><?= $row['rating'] ?>/5</td>
                <td><?= date('d.m.Y H:i', strtotime($row['created_at'])) ?></td>
            </tr>
            <?php endwhile; ?>
        </table>

        <!-- Пагинация -->
        <div style="margin-top:15px;">
            <?php for ($i = 1; $i <= $pages; $i++): ?>
                <a href="?page=<?= $i ?>" style="margin:0 4px; padding:4px 8px; text-decoration:none; <?= $i === $page ? 'font-weight:bold; background:#ddd;' : '' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>
        </div>
    <?php endif; ?>
</body>
</html>