<?php
declare(strict_types=1);

require_once __DIR__ . '/../auth.php';
$pageTitle = $pageTitle ?? SITE_NAME;
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="WALT news portal">
    <title><?= e($pageTitle) ?> | <?= e(SITE_NAME) ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="site-shell">
    <header class="site-header">
        <a class="logo" href="index.php"><?= e(SITE_NAME) ?></a>
        <nav class="main-nav" aria-label="Glavna navigacija">
            <a href="index.php">HOME</a>
            <a href="index.php#politika">POLITIK</a>
            <a href="index.php#sport">SPORT</a>
            <a href="<?= is_admin() ? 'admin.php' : 'login.php' ?>">ADMINISTRACIJA</a>
        </nav>
    </header>
    <main>
