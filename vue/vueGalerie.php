<h1>Galerie Photos ATP</h1>

<div class="galerie-grid">
    <?php foreach ($photos as $photo): ?>
        <div class="photo-card">
            <img src="<?= htmlspecialchars($photo['Chemin_Photo']) ?>" alt="<?= htmlspecialchars($photo['Legende_Photo'] ?? '') ?>">
            <p class="legende"><?=htmlspecialchars($photo['Legende_Photo'] ?? '') ?></p>
        </div>
    <?php endforeach; ?>
</div>
