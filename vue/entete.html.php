<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $titre; ?></title>
        
        <link rel="stylesheet" href="css/style.css">
        
        <?php if (isset($style)): ?>
            <link rel="stylesheet" href="css/<?= $style ?>.css">
        <?php endif; ?>
    </head>
    <body>
        <nav>
            <a href="./index.php">Accueil</a>
            <a href="./?action=joueurs">Joueurs</a>
            <a href="./?action=rencontres">Matchs</a>
            <a href="./?action=tournois">Tournois</a>
            <a href="./?action=galerie">Galerie</a>
        </nav>
        <div id="contenu">