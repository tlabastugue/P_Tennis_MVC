# Projet Tennis MVC - Site T-L Tour

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
│   └── bd.galerie.inc.php        # GalerieModel
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
│   
├── photos/                       # Images de la galerie (ignoré par git)
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
| `?action=rencontres` | `listeRencontres.php` | `vueListeRencontres.php` | Résultats des matchs, triés par `Id_Rencontre` (vainqueur ✓ / perdant ✗) |
| `?action=tournois` | `listeTournois.php` | `vueListeTournois.php` | Calendrier des tournois du Grand Chelem |
| `?action=galerie` | `galerie.php` | `vueGalerie.php` | Galerie photos chargée depuis la table `Galerie` |

## Base de données

Nom : `P_TENNIS_MVC` (encodage UTF-8, moteur InnoDB). Aucun script SQL n'est versionné dans le dépôt : penser à exporter la base depuis phpMyAdmin pour la sauvegarder.

### Tables

| Table | Colonnes |
|---|---|
| `Joueur` | `Id_Joueur` (PK), `Prenom_Joueur`, `Nom_Joueur`, `Age_Joueur`, `Numero_Classement`, `Id_Rencontre` |
| `Staff` | `Id_Staff` (PK), `Prenom_Staff`, `Nom_Staff`, `Fonction_Staff`, `Id_Joueur` |
| `Marque` | `Id_Marque` (PK), `Nom_Marque`, `Type_Marque` |
| `Sponsor` | `Id_Marque`, `Id_Joueur` (PK composée — table de liaison Joueur ↔ Marque) |
| `Tournoi` | `Id_Tournoi` (PK), `Nom_Tournoi`, `Date_Tournoi`, `Lieu_Tournoi` |
| `Rencontre` | `Id_Rencontre` (PK), `Resultat_Rencontre`, `Niveau_Rencontre`, `Id_Joueur_1`, `Id_Joueur_2`, `Id_Vainqueur_Rencontre`, `Id_Tournoi` |
| `Galerie` | `Id_Galerie` (PK), `Chemin_Photo`, `Legende_Photo`, `Id_Rencontre` |

### Clés étrangères

| Colonne | Référence | Contrainte |
|---|---|---|
| `Rencontre.Id_Joueur_1` | `Joueur.Id_Joueur` | `Fk_Rencontre_Joueur1` |
| `Rencontre.Id_Joueur_2` | `Joueur.Id_Joueur` | `Fk_Rencontre_Joueur2` |
| `Rencontre.Id_Vainqueur_Rencontre` | `Joueur.Id_Joueur` | `Fk_Rencontre_Vainqueur` |
| `Rencontre.Id_Tournoi` | `Tournoi.Id_Tournoi` | `Fk_Rencontre_Tournoi` |
| `Staff.Id_Joueur` | `Joueur.Id_Joueur` | `Fk_Staff_Joueur` |
| `Sponsor.Id_Joueur` | `Joueur.Id_Joueur` | `Fk_Sponsor_Joueur` |
| `Sponsor.Id_Marque` | `Marque.Id_Marque` | `Fk_Sponsor_Marque` |
| `Galerie.Id_Rencontre` | `Rencontre.Id_Rencontre` | `Fk_Galerie_Rencontre` |
| `Joueur.Id_Rencontre` | `Rencontre.Id_Rencontre` | `Fk_Joueur_Rencontre` |

Les clés étrangères empêchent d'enregistrer une référence vers une ligne inexistante et de supprimer un joueur encore utilisé dans une rencontre, un staff ou un sponsor.

## Galerie photos

- Les images sont stockées dans `photos/` et référencées en base par `Galerie.Chemin_Photo` (ex. `photos/Alcaraz-Sinner_RG.jpg`), avec leur légende dans `Legende_Photo`.
- Pour ajouter une photo : déposer le fichier dans `photos/`, puis insérer une ligne dans `Galerie`.
- Apache (XAMPP) tourne sous l'utilisateur `daemon` : les images doivent être lisibles par tous, sinon elles ne s'affichent pas (erreur 403). En cas d'image cassée :
  ```bash
  chmod 644 photos/*.jpg
  ```

## Notes

- `index.php` active l'affichage de toutes les erreurs PHP (`display_errors`, `E_ALL`) : configuration de développement.
- Les identifiants BD sont codés en dur dans `modele/bd.inc.php`.
- Les vues échappent les données avec `htmlspecialchars()`.
- `controleur/joueur.php` est présent mais jamais inclus par le flux principal.
- La colonne `Joueur.Id_Rencontre` n'est pas utilisée par le code : le lien joueur ↔ rencontre passe par `Rencontre.Id_Joueur_1` / `Id_Joueur_2`.
