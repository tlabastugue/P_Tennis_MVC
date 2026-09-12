<h1>Tournois ATP</h1>

<div class="tournois-grid">
    <?php foreach ($tournois as $t): ?>
        <div class="tournoi-card">
            <span class="rank">📅</span>
            <h3><?= htmlspecialchars($t['Nom_Tournoi']) ?></h3>
            <p class="nat"><?= htmlspecialchars($t['Lieu_Tournoi']) ?></p>
            <p>Date : <?= date('d/m/Y', strtotime($t['Date_Tournoi'])) ?></p>
        </div>
    <?php endforeach; ?>
</div>