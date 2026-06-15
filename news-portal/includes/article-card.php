<article class="article-card">
    <a href="clanak.php?id=<?= (int) $article['id'] ?>" class="card-image-link">
        <img src="<?= image_url($article['image']) ?>" alt="<?= e($article['title']) ?>">
    </a>
    <p class="category"><?= e(category_label($article['category'])) ?></p>
    <h3><a href="clanak.php?id=<?= (int) $article['id'] ?>"><?= e($article['title']) ?></a></h3>
    <p class="summary"><?= e($article['summary']) ?></p>
    <div class="card-meta">
        <time datetime="<?= e($article['published_at']) ?>"><?= e(format_date($article['published_at'])) ?></time>
    </div>
</article>
