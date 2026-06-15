<?php
declare(strict_types=1);

require_once __DIR__ . '/auth.php';

if (is_logged_in()) {
    redirect(is_admin() ? 'admin.php' : 'index.php');
}

$errors = $_SESSION['registration_errors'] ?? [];
$username = $_SESSION['registration_username'] ?? '';
unset($_SESSION['registration_errors'], $_SESSION['registration_username']);

$pageTitle = 'Registracija';
require __DIR__ . '/includes/header.php';
?>
<section class="form-page narrow-page">
    <div class="section-heading">
        <h1>REGISTRACIJA KORISNIKA</h1>
    </div>

    <?php if ($errors): ?>
        <div class="alert alert-error">
            <?php foreach ($errors as $error): ?><p><?= e($error) ?></p><?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="post" action="registracija_obrada.php" class="portal-form">
        <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">

        <label for="username">Korisničko ime</label>
        <input id="username" name="username" type="text" minlength="3" maxlength="50"
               pattern="[A-Za-z0-9_]+" value="<?= e($username) ?>" autocomplete="username" required>
        <p class="field-help">Dozvoljena su slova, brojevi i donja crta.</p>

        <label for="password">Lozinka</label>
        <input id="password" name="password" type="password" minlength="8"
               autocomplete="new-password" required>

        <label for="password_confirmation">Ponovite lozinku</label>
        <input id="password_confirmation" name="password_confirmation" type="password" minlength="8"
               autocomplete="new-password" required>

        <button class="button" type="submit">Registriraj se</button>
        <p class="form-switch">Već imate račun? <a href="login.php">Prijavite se</a>.</p>
    </form>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
