# P_Tennis_MVC — T-L Tour

Site web PHP (architecture MVC « maison », sans framework) présentant un circuit de tennis fictif : classement des joueurs, profils détaillés (staff, sponsors), résultats des rencontres, calendrier des tournois et galerie photos.

Projet de première année, prévu pour tourner sous XAMPP (Apache + MySQL/MariaDB + PHP).

## Prérequis

- PHP ≥ 7.4 avec l'extension `pdo_mysql`
- MySQL / MariaDB
- Apache (XAMPP) — le projet doit être placé dans `htdocs/`

## Installation

1. Cloner le dépôt dans `htdocs/` :
   ```bash
   cd /Applications/XAMPP/xamppfiles/htdocs
   git clone <url-du-depot> P_Tennis_MVC
   ```
2. Créer la base de données `P_TENNIS_MVC` et y importer le schéma / les données (voir [Base de données](#base-de-données)).
3. Vérifier les identifiants de connexion dans `modele/bd.inc.php` (par défaut `root` sans mot de passe sur `localhost`).
4. Ouvrir <http://localhost/P_Tennis_MVC/> dans le navigateur.

## Structure du projet

```
P_Tennis_MVC/
├── index.php                  # Point d'entrée unique (front controller)
├── getRacine.php              # Définit $racine = chemin absolu du projet
├── controleur/
│   ├── controleurPrincipal.php   # Routeur : associe ?action=… à un fichier contrôleur
│   ├── accueil.php
│   ├── listeJoueurs.php
│   ├── detailsJoueur.php
│   ├── listeRencontres.php
│   ├── listeTournois.php
│   ├── galerie.php
│   └── joueur.php                # Classe JoueurController (non utilisée par le routeur)
├── modele/
│   ├── bd.inc.php                # connexionPDO()
│   ├── bd.joueur.inc.php         # JoueurModel
│   ├── bd.rencontre.inc.php      # RencontreModel
│   ├── bd.tournoi.inc.php        # TournoiModel
│   └── bd.galerie.inc.php        # GalerieModel (non utilisé, la galerie est statique)
├── vue/
│   ├── entete.html.php           # <head>, nav, ouverture de #contenu
│   ├── pied.html.php             # footer, fermeture
│   ├── vueListeJoueurs.php
│   ├── vueDetailsJoueur.php
│   ├── vueListeRencontres.php
│   ├── vueListeTournois.php
│   └── vueGalerie.php
├── css/
│   ├── style.css                 # CSS global (chargé sur toutes les pages)
│   ├── joueurs.css, detailJoueur.css, rencontres.css, tournoi.css, galerie.css
├── photos/                       # Images de la galerie (ignoré par git)
├── images/
└── screenshots/                  # Captures d'écran (ignoré par git)
```

## Fonctionnement (MVC)

1. `index.php` inclut `getRacine.php`, le routeur et la connexion BD, puis lit `$_GET['action']` (défaut : `accueil`).
2. `controleurPrincipal($action)` renvoie le nom du fichier contrôleur correspondant ; toute action inconnue retombe sur l'accueil.
3. Le contrôleur instancie le modèle nécessaire, récupère les données, définit `$titre` et `$style` (nom du CSS spécifique), puis inclut `entete.html.php`, la vue, et `pied.html.php`.
4. Les modèles sont des classes recevant l'objet PDO dans leur constructeur et exposant des méthodes de lecture (requêtes préparées).

### Routes disponibles

| URL | Contrôleur | Vue | Description |
|---|---|---|---|
| `./` ou `?action=accueil` | `accueil.php` | (inline) | Page d'accueil |
| `?action=joueurs` | `listeJoueurs.php` | `vueListeJoueurs.php` | Classement des joueurs |
| `?action=detailJoueur&id=N` | `detailsJoueur.php` | `vueDetailsJoueur.php` | Profil d'un joueur, staff et sponsors |
| `?action=rencontres` | `listeRencontres.php` | `vueListeRencontres.php` | Résultats des matchs (vainqueur mis en avant) |
| `?action=tournois` | `listeTournois.php` | `vueListeTournois.php` | Calendrier des tournois |
| `?action=galerie` | `galerie.php` | `vueGalerie.php` | Galerie photos (statique) |

## Base de données

Nom : `P_TENNIS_MVC` (encodage UTF-8). Aucun script SQL n'est versionné dans le dépôt ; le schéma ci-dessous est déduit des requêtes des modèles.

| Table | Colonnes utilisées |
|---|---|
| `Joueur` | `Id_Joueur`, `Prenom_Joueur`, `Nom_Joueur`, `Age_Joueur`, `Numero_Classement` |
| `Staff` | `Id_Joueur`, `Prenom_Staff`, `Nom_Staff`, `Fonction_Staff` |
| `Marque` | `Id_Marque`, `Nom_Marque`, `Type_Marque` |
| `Sponsor` | `Id_Joueur`, `Id_Marque` (table de liaison Joueur ↔ Marque) |
| `Tournoi` | `Id_Tournoi`, `Nom_Tournoi`, `Lieu_Tournoi`, `Date_Tournoi` |
| `Rencontre` | `Id_Tournoi`, `Id_Joueur_1`, `Id_Joueur_2`, `Id_Vainqueur_Rencontre`, `Resultat_Rencontre`, `Niveau_Rencontre` |
| `Galerie` | `*` (référencée par `GalerieModel`, non utilisée par le site) |

## Notes

- `index.php` active l'affichage de toutes les erreurs PHP (`display_errors`, `E_ALL`) : configuration de développement.
- Les identifiants BD sont codés en dur dans `modele/bd.inc.php`.
- Les vues échappent les données avec `htmlspecialchars()`.
- `controleur/joueur.php` et `modele/bd.galerie.inc.php` sont présents mais jamais inclus par le flux principal.
