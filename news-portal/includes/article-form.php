<?php
$editing = isset($article['id']);
$submitLabel = $editing ? 'Spremi promjene' : 'Objavi članak';
?>
<form method="post" enctype="multipart/form-data" class="portal-form article-form">
    <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">

    <label for="title">Naslov članka</label>
    <input id="title" name="title" type="text" maxlength="180" value="<?= e($article['title'] ?? '') ?>" required>

    <label for="summary">Kratki sadržaj / sažetak</label>
    <textarea id="summary" name="summary" rows="4" maxlength="500" required><?= e($article['summary'] ?? '') ?></textarea>

    <label for="content">Puni tekst članka</label>
    <textarea id="content" name="content" rows="12" required><?= e($article['content'] ?? '') ?></textarea>

    <div class="form-row">
        <div>
            <label for="category">Kategorija</label>
            <select id="category" name="category" required>
                <option value="">Odaberite kategoriju</option>
                <option value="politika" <?= ($article['category'] ?? '') === 'politika' ? 'selected' : '' ?>>Politika</option>
                <option value="sport" <?= ($article['category'] ?? '') === 'sport' ? 'selected' : '' ?>>Sport</option>
            </select>
        </div>
        <div>
            <label for="published_at">Datum objave</label>
            <input id="published_at" name="published_at" type="date"
                   value="<?= e($article['published_at'] ?? date('Y-m-d')) ?>" required>
        </div>
    </div>

    <label for="image">Slika članka (JPG ili PNG, najviše 5 MB)</label>
    <input id="image" name="image" type="file" accept=".jpg,.jpeg,.png,image/jpeg,image/png"
           <?= $editing ? '' : 'required' ?>>
    <?php if ($editing && !empty($article['image'])): ?>
        <p class="field-help">Postojeća slika ostaje spremljena ako ne odaberete novu.</p>
        <img class="admin-thumbnail" src="<?= image_url($article['image']) ?>" alt="">
    <?php endif; ?>

    <label class="checkbox-label">
        <input type="checkbox" name="show_on_homepage" value="1"
               <?= (int) ($article['show_on_homepage'] ?? 1) === 1 ? 'checked' : '' ?>>
        Prikaži članak na naslovnici
    </label>

    <button class="button" type="submit"><?= e($submitLabel) ?></button>
</form>
