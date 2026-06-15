<?php
declare(strict_types=1);

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/functions.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    http_response_code(404);
    exit('Članak nije pronađen.');
}

$statement = db()->prepare('SELECT * FROM articles WHERE id = ? LIMIT 1');
$statement->bind_param('i', $id);
$statement->execute();
$article = $statement->get_result()->fetch_assoc();

if (!$article) {
    http_response_code(404);
    exit('Članak nije pronađen.');
}

$pageTitle = $article['title'];
require __DIR__ . '/includes/header.php';
?>
<div class="article-category-bar"><?= e(category_label($article['category'])) ?></div>
<article class="article-page">
    <header class="article-header">
        <p class="category"><?= e(category_label($article['category'])) ?></p>
        <h1><?= e($article['title']) ?></h1>
        <p class="article-lead"><?= e($article['summary']) ?></p>
        <div class="article-info">
            <time datetime="<?= e($article['published_at']) ?>">
                Objavljeno: <?= e(format_date($article['published_at'])) ?>
            </time>
        </div>
    </header>

    <img class="article-main-image" src="<?= image_url($article['image']) ?>" alt="<?= e($article['title']) ?>">

    <div class="article-content">
        <?php foreach (preg_split('/\R{2,}/', trim($article['content'])) as $paragraph): ?>
            <p><?= nl2br(e($paragraph)) ?></p>
        <?php endforeach; ?>
    </div>
</article>
<?php require __DIR__ . '/includes/footer.php'; ?>
