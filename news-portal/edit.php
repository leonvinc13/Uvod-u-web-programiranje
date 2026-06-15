<?php
declare(strict_types=1);

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/db.php';
require_admin();

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

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    [$data, $errors] = validate_article($_POST, $_FILES, false);

    if (!$errors) {
        $newImage = null;

        try {
            $newImage = upload_image($_FILES['image'] ?? ['error' => UPLOAD_ERR_NO_FILE]);
            $data['image'] = $newImage ?: $article['image'];

            $update = db()->prepare(
                'UPDATE articles SET
                    title = ?, summary = ?, content = ?,
                    category = ?, image = ?, published_at = ?,
                    show_on_homepage = ?
                 WHERE id = ?'
            );
            $update->bind_param(
                'ssssssii',
                $data['title'],
                $data['summary'],
                $data['content'],
                $data['category'],
                $data['image'],
                $data['published_at'],
                $data['show_on_homepage'],
                $id
            );
            $update->execute();

            if ($newImage) {
                delete_uploaded_image($article['image']);
            }

            $_SESSION['flash'] = 'Promjene su spremljene.';
            redirect('admin.php');
        } catch (RuntimeException $exception) {
            if ($newImage) {
                delete_uploaded_image($newImage);
            }
            $errors[] = $exception->getMessage();
        }
    }

    $article = array_merge($article, $data);
}

$pageTitle = 'Uredi članak';
require __DIR__ . '/includes/header.php';
?>
<section class="form-page">
    <div class="section-heading">
        <h1>UREDI ČLANAK</h1>
        <a href="admin.php">Povratak na administraciju</a>
    </div>

    <?php if ($errors): ?>
        <div class="alert alert-error">
            <?php foreach ($errors as $error): ?><p><?= e($error) ?></p><?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php require __DIR__ . '/includes/article-form.php'; ?>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
