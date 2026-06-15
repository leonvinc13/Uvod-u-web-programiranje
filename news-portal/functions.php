<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function redirect(string $location): never
{
    header('Location: ' . $location);
    exit;
}

function format_date(string $date): string
{
    return date('d.m.Y.', strtotime($date));
}

function category_label(string $category): string
{
    return $category === 'sport' ? 'SPORT' : 'POLITIK';
}

function image_url(?string $image): string
{
    $image = $image ?: 'images/placeholder.svg';
    return e($image);
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function verify_csrf(): void
{
    $token = $_POST['csrf_token'] ?? '';

    if (!is_string($token) || !hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
        http_response_code(403);
        exit('Neispravan sigurnosni token.');
    }
}

function validate_article(array $input, array $files, bool $imageRequired): array
{
    $data = [
        'title' => trim((string) ($input['title'] ?? '')),
        'summary' => trim((string) ($input['summary'] ?? '')),
        'content' => trim((string) ($input['content'] ?? '')),
        'category' => (string) ($input['category'] ?? ''),
        'published_at' => (string) ($input['published_at'] ?? ''),
        'show_on_homepage' => isset($input['show_on_homepage']) ? 1 : 0,
    ];
    $errors = [];

    if (mb_strlen($data['title']) < 5 || mb_strlen($data['title']) > 180) {
        $errors[] = 'Naslov mora imati između 5 i 180 znakova.';
    }
    if (mb_strlen($data['summary']) < 20 || mb_strlen($data['summary']) > 500) {
        $errors[] = 'Sažetak mora imati između 20 i 500 znakova.';
    }
    if (mb_strlen($data['content']) < 50) {
        $errors[] = 'Puni tekst mora imati najmanje 50 znakova.';
    }
    if (!in_array($data['category'], ['politika', 'sport'], true)) {
        $errors[] = 'Odaberite ispravnu kategoriju.';
    }
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $data['published_at'])) {
        $errors[] = 'Odaberite ispravan datum.';
    }
    $image = $files['image'] ?? null;
    if ($imageRequired && (!$image || $image['error'] === UPLOAD_ERR_NO_FILE)) {
        $errors[] = 'Slika članka je obavezna.';
    }
    if ($image && $image['error'] !== UPLOAD_ERR_NO_FILE && $image['error'] !== UPLOAD_ERR_OK) {
        $errors[] = 'Dogodila se pogreška pri prijenosu slike.';
    }

    return [$data, $errors];
}

function upload_image(array $file): ?string
{
    if (($file['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
        return null;
    }
    if (($file['size'] ?? 0) > MAX_IMAGE_SIZE) {
        throw new RuntimeException('Slika smije imati najviše 5 MB.');
    }

    $allowed = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
    ];
    $mime = (new finfo(FILEINFO_MIME_TYPE))->file($file['tmp_name']);

    if (!isset($allowed[$mime])) {
        throw new RuntimeException('Dozvoljene su samo JPG, JPEG i PNG slike.');
    }

    $uploadDirectory = __DIR__ . '/uploads';
    if (!is_dir($uploadDirectory) && !mkdir($uploadDirectory, 0755, true)) {
        throw new RuntimeException('Nije moguće napraviti mapu za slike.');
    }

    $filename = bin2hex(random_bytes(16)) . '.' . $allowed[$mime];
    $destination = $uploadDirectory . '/' . $filename;

    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        throw new RuntimeException('Slika nije spremljena.');
    }

    return 'uploads/' . $filename;
}

function delete_uploaded_image(?string $path): void
{
    if (!$path || !str_starts_with($path, 'uploads/')) {
        return;
    }

    $fullPath = __DIR__ . '/' . $path;
    if (is_file($fullPath)) {
        unlink($fullPath);
    }
}
