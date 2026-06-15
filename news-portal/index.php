<?php
declare(strict_types=1);

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/functions.php';

$statement = db()->prepare(
    'SELECT id, title, summary, category, image, published_at
     FROM articles
     WHERE show_on_homepage = 1 AND category = ?
     ORDER BY published_at DESC, id DESC
     LIMIT 3'
);

$articlesByCategory = [];
foreach (['politika', 'sport'] as $category) {
    $statement->bind_param('s', $category);
    $statement->execute();
    $articlesByCategory[$category] = $statement->get_result()->fetch_all(MYSQLI_ASSOC);
}

$pageTitle = 'Naslovnica';
require __DIR__ . '/includes/header.php';
?>
<section class="hero">
    <h1>Vijesti koje oblikuju dan</h1>
    <p>Politika, sport i priče koje vrijedi pročitati.</p>
</section>

<?php foreach (['politika', 'sport'] as $category): ?>
    <section class="news-section" id="<?= e($category) ?>">
        <div class="section-heading">
            <h2><?= e(category_label($category)) ?></h2>
            <span>Najnovije vijesti</span>
        </div>

        <?php if ($articlesByCategory[$category]): ?>
            <div class="article-grid">
                <?php foreach ($articlesByCategory[$category] as $article): ?>
                    <?php require __DIR__ . '/includes/article-card.php'; ?>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="empty-state">Trenutno nema objavljenih članaka u ovoj kategoriji.</p>
        <?php endif; ?>
    </section>
<?php endforeach; ?>

<?php require __DIR__ . '/includes/footer.php'; ?>
