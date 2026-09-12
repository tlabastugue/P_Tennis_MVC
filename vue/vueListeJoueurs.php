<div class="joueurs-container">
    <?php foreach ($joueurs as $joueur) : ?>
        <div class="joueur-card-premium">
            <div class="card-header-premium">
                <span class="rank-badge-premium">#<?= htmlspecialchars($joueur['Numero_Classement']) ?></span>
            </div>

            <div class="card-body-premium">
                <h3 class="player-name-premium">
                    <span class="firstname"><?= htmlspecialchars($joueur['Prenom_Joueur']) ?></span>
                    <?= htmlspecialchars($joueur['Nom_Joueur']) ?>
                </h3>
            </div>

            <div class="card-footer-premium">
                <a href="./?action=detailJoueur&id=<?= $joueur['Id_Joueur'] ?>" class="btn-profil-premium">
                    Voir le profil
                </a>
            </div>
        </div>
    <?php endforeach; ?>
</div>