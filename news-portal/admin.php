<?php
declare(strict_types=1);

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/db.php';
require_admin();

$errors = [];
$article = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    [$article, $errors] = validate_article($_POST, $_FILES, true);

    if (!$errors) {
        try {
            $article['image'] = upload_image($_FILES['image']);

            $statement = db()->prepare(
                'INSERT INTO articles
                    (title, summary, content, category, image, published_at, show_on_homepage)
                 VALUES
                    (?, ?, ?, ?, ?, ?, ?)'
            );
            $statement->bind_param(
                'ssssssi',
                $article['title'],
                $article['summary'],
                $article['content'],
                $article['category'],
                $article['image'],
                $article['published_at'],
                $article['show_on_homepage']
            );
            $statement->execute();

            $_SESSION['flash'] = 'Članak je uspješno objavljen.';
            redirect('admin.php');
        } catch (RuntimeException $exception) {
            $errors[] = $exception->getMessage();
        }
    }
}

$articles = db()->query(
    'SELECT id, title, category, image, published_at, show_on_homepage
     FROM articles ORDER BY published_at DESC, id DESC'
)->fetch_all(MYSQLI_ASSOC);

$flash = $_SESSION['flash'] ?? '';
unset($_SESSION['flash']);

$pageTitle = 'Administracija';
require __DIR__ . '/includes/header.php';
?>
<section class="admin-page">
    <div class="admin-heading">
        <div>
            <p class="eyebrow">PRIJAVLJEN: <?= e(current_username()) ?></p>
            <h1>ADMINISTRACIJA</h1>
        </div>
        <a class="button button-secondary" href="logout.php">Odjava</a>
    </div>

    <?php if ($flash): ?><div class="alert alert-success"><?= e($flash) ?></div><?php endif; ?>
    <?php if ($errors): ?>
        <div class="alert alert-error">
            <?php foreach ($errors as $error): ?><p><?= e($error) ?></p><?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="admin-layout">
        <section>
            <h2>UNOS NOVOG ČLANKA</h2>
            <?php require __DIR__ . '/includes/article-form.php'; ?>
        </section>

        <section>
            <h2>OBJAVLJENI ČLANCI</h2>
            <div class="admin-list">
                <?php foreach ($articles as $item): ?>
                    <article class="admin-list-item">
                        <img src="<?= image_url($item['image']) ?>" alt="">
                        <div>
                            <p class="category"><?= e(category_label($item['category'])) ?></p>
                            <h3><?= e($item['title']) ?></h3>
                            <p><?= e(format_date($item['published_at'])) ?>
                                · <?= $item['show_on_homepage'] ? 'Na naslovnici' : 'Skriven s naslovnice' ?></p>
                            <div class="admin-actions">
                                <a href="clanak.php?id=<?= (int) $item['id'] ?>">Prikaži</a>
                                <a href="edit.php?id=<?= (int) $item['id'] ?>">Uredi</a>
                                <form method="post" action="delete.php" onsubmit="return confirm('Obrisati ovaj članak?');">
                                    <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                                    <input type="hidden" name="id" value="<?= (int) $item['id'] ?>">
                                    <button type="submit">Obriši</button>
                                </form>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>
    </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
