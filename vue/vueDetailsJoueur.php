<div class="profile-container">
    <header class="profile-header">
        <div class="rank-badge">#<?= htmlspecialchars($leJoueur['Numero_Classement']) ?></div>
        <h1><?= htmlspecialchars($leJoueur['Prenom_Joueur']) ?> <?= htmlspecialchars($leJoueur['Nom_Joueur']) ?></h1>
        <p class="age"><?= htmlspecialchars($leJoueur['Age_Joueur']) ?> ans</p>
        </header>

        <div class="header-brands">
            <h2>Équipementiers & Sponsors</h2>
            <?php if (!empty($lesMarques)): ?>
                <?php foreach ($lesMarques as $m): ?>
                    <div class="brand-tag-mini">
                        <span class="brand-type-mini"><?= htmlspecialchars($m['Type_Marque']) ?></span>
                        <span class="brand-name-mini"><?= htmlspecialchars($m['Nom_Marque']) ?></span>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="profile-grid">
            <section class="staff-section">
                <h2>Mon Équipe (Staff)</h2>
                <div class="staff-list">
                    <?php if (!empty($leStaff)): ?>
                        <?php foreach ($leStaff as $s): ?>
                            <?php
                            $prenoms = explode('|', $s['Prenom_Staff'] ?? '');
                            $noms = explode('|', $s['Nom_Staff'] ?? '');
                            $personnes = [];
                            foreach ($prenoms as $i => $prenom) {
                                $personnes[] = trim($prenom . ' ' . ($noms[$i] ?? ''));
                            }
                            $nomStaff = implode(' | ', array_filter($personnes));
                            ?>
                            <div class="staff-card">
                                <strong><?= htmlspecialchars($nomStaff !== '' ? $nomStaff : 'Aucun') ?></strong>
                                <span><?= htmlspecialchars($s['Fonction_Staff'] ?? '') ?></span>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Aucun membre du staff renseigné.</p>
                    <?php endif; ?>
                </div>
            </section>
        </div>

        <div class="back-action">
            <a href="./?action=joueurs" class="btn-back">← Retour au classement</a>
        </div>
</div>