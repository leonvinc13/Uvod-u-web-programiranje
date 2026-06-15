<?php
declare(strict_types=1);

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('registracija.php');
}

if (is_logged_in()) {
    redirect(is_admin() ? 'admin.php' : 'index.php');
}

verify_csrf();

$username = trim((string) ($_POST['username'] ?? ''));
$password = (string) ($_POST['password'] ?? '');
$passwordConfirmation = (string) ($_POST['password_confirmation'] ?? '');
$errors = [];

if (!preg_match('/^[A-Za-z0-9_]{3,50}$/', $username)) {
    $errors[] = 'Korisničko ime mora imati 3 do 50 znakova i smije sadržavati slova, brojeve i donju crtu.';
}
if (mb_strlen($password) < 8) {
    $errors[] = 'Lozinka mora imati najmanje 8 znakova.';
}
if ($password !== $passwordConfirmation) {
    $errors[] = 'Lozinka i potvrda lozinke nisu jednake.';
}

if (!$errors) {
    $check = db()->prepare('SELECT id FROM users WHERE username = ? LIMIT 1');
    $check->bind_param('s', $username);
    $check->execute();

    if ($check->get_result()->fetch_assoc()) {
        $errors[] = 'To korisničko ime već postoji. Odaberite drugo.';
    }
}

if ($errors) {
    $_SESSION['registration_errors'] = $errors;
    $_SESSION['registration_username'] = $username;
    redirect('registracija.php');
}

$passwordHash = password_hash($password, PASSWORD_DEFAULT);
$role = 'user';
$statement = db()->prepare(
    'INSERT INTO users (username, password, role) VALUES (?, ?, ?)'
);
$statement->bind_param('sss', $username, $passwordHash, $role);
$statement->execute();

$_SESSION['flash'] = 'Registracija je uspješna. Sada se možete prijaviti.';
redirect('login.php');
