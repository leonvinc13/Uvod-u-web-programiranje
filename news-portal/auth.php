<?php
declare(strict_types=1);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require_once __DIR__ . '/functions.php';

function is_logged_in(): bool
{
    return isset($_SESSION['user_id']);
}

function is_admin(): bool
{
    return is_logged_in() && ($_SESSION['role'] ?? '') === 'admin';
}

function require_admin(): void
{
    if (!is_admin()) {
        $_SESSION['flash'] = 'Administraciji može pristupiti samo administrator.';
        redirect('login.php');
    }
}

function current_username(): string
{
    return (string) ($_SESSION['username'] ?? '');
}
