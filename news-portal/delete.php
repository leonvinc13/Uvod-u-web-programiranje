<?php
declare(strict_types=1);

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/db.php';
require_admin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Brisanje je dozvoljeno samo POST metodom.');
}

verify_csrf();
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    http_response_code(400);
    exit('Neispravan ID članka.');
}

$statement = db()->prepare('SELECT image FROM articles WHERE id = ? LIMIT 1');
$statement->bind_param('i', $id);
$statement->execute();
$article = $statement->get_result()->fetch_assoc();

if ($article) {
    $delete = db()->prepare('DELETE FROM articles WHERE id = ?');
    $delete->bind_param('i', $id);
    $delete->execute();
    delete_uploaded_image($article['image']);
}

$_SESSION['flash'] = 'Članak je obrisan.';
redirect('admin.php');
