<h1>Résultats des Rencontres</h1>

<div class="match-list">
    <?php foreach ($rencontres as $r): ?>
        <div class="match-card">
            <div class="match-header"><?= htmlspecialchars($r['Nom_Tournoi']) ?></div>
            <div class="match-body">
                <span class="<?= ($r['Id_Vainqueur_Rencontre'] == $r['Id_Joueur_1']) ? 'winner' : 'loser' ?>">
                    <?= htmlspecialchars($r['Nom2']) ?>
                </span>
                <span class="vs">VS</span>
                <span class="<?= ($r['Id_Vainqueur_Rencontre'] == $r['Id_Joueur_2']) ? 'winner' : 'loser' ?>">
                    <?= htmlspecialchars($r['Nom1']) ?>
                </span>
            </div>
            <div class="score"><?= htmlspecialchars($r['Resultat_Rencontre']) ?></div>
            <div class="niveau"><?= htmlspecialchars($r['Niveau_Rencontre']) ?></div>
        </div>
    <?php endforeach; ?>
</div>