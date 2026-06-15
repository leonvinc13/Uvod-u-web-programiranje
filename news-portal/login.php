<?php
declare(strict_types=1);

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/db.php';

if (is_admin()) {
    redirect('admin.php');
}

$errors = [];
$flash = $_SESSION['flash'] ?? '';
unset($_SESSION['flash']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !is_logged_in()) {
    verify_csrf();

    $username = trim((string) ($_POST['username'] ?? ''));
    $password = (string) ($_POST['password'] ?? '');

    if ($username === '' || $password === '') {
        $errors[] = 'Unesite korisničko ime i lozinku.';
    } else {
        $statement = db()->prepare(
            'SELECT id, username, password, role FROM users WHERE username = ? LIMIT 1'
        );
        $statement->bind_param('s', $username);
        $statement->execute();
        $user = $statement->get_result()->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = (int) $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            redirect($user['role'] === 'admin' ? 'admin.php' : 'index.php');
        }

        $errors[] = 'Korisničko ime i/ili lozinka nisu ispravni. Ako nemate račun, prvo se registrirajte.';
    }
}

$pageTitle = is_logged_in() ? 'Korisnički račun' : 'Prijava';
require __DIR__ . '/includes/header.php';
?>
<section class="form-page narrow-page">
    <div class="section-heading">
        <h1><?= is_logged_in() ? 'KORISNIČKI RAČUN' : 'PRIJAVA KORISNIKA' ?></h1>
    </div>

    <?php if ($flash): ?>
        <div class="alert alert-info"><?= e($flash) ?></div>
    <?php endif; ?>

    <?php if (is_logged_in()): ?>
        <div class="portal-form account-panel">
            <p>Prijavljeni ste kao <strong><?= e(current_username()) ?></strong>.</p>
            <p>Ovaj korisnički račun nema administratorske ovlasti.</p>
            <div class="account-actions">
                <a class="button button-secondary" href="index.php">Povratak na naslovnicu</a>
                <a class="button" href="logout.php">Odjava</a>
            </div>
        </div>
    <?php else: ?>
        <?php if ($errors): ?>
            <div class="alert alert-error">
                <?php foreach ($errors as $error): ?><p><?= e($error) ?></p><?php endforeach; ?>
                <p><a class="text-link" href="registracija.php">Otvori formu za registraciju</a></p>
            </div>
        <?php endif; ?>

        <form method="post" class="portal-form">
            <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">

            <label for="username">Korisničko ime</label>
            <input id="username" name="username" type="text" maxlength="50" autocomplete="username" required>

            <label for="password">Lozinka</label>
            <input id="password" name="password" type="password" autocomplete="current-password" required>

            <button class="button" type="submit">Prijavi se</button>
            <p class="form-switch">Nemate korisnički račun? <a href="registracija.php">Registrirajte se</a>.</p>
        </form>
    <?php endif; ?>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
