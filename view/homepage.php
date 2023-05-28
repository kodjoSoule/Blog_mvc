<?php $title = "Le blog de l'AVBN"; ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Le blog de l'AVBN</title>
    <link href="style.css" rel="stylesheet" />
    
</head>

<body>
    <h1><?= $title ?></h1>
    <p>Derniers billets du blog :</p>
    <?php //$posts is am array post object  ?>
    <?php foreach ($posts as $post) { ?>
        <div class="news">
            <h3>
                <?=  htmlspecialchars($post->getTitle()); ?>
                <?= htmlspecialchars($post->getId()); ?>
                <em>le <?php echo $post->getFrench_creation_date(); ?></em>
            </h3>
            <p>
                <?php
                // On affiche le contenu du billet
                echo nl2br(htmlspecialchars($post->getContent()));
                ?>
                <br />
                <em><a href="index.php?action=post&id=<?=urlencode($post->getId()) ?>">Commentaires</a></em>
            </p>
        </div>
    <?php  }
    ?>
    
</body>

</html>