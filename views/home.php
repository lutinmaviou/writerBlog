<?php $title = 'Le blog de Jean Forteroche';
ob_start(); ?>
<h2>Derniers chapitres</h2>
<?php
while ($data = $req->fetch()) {
    ?>
    <div>
        <a href="index.php?action=post&amp;id=<?= $data['id']; ?>">
            <h3>
                <?php echo htmlspecialchars($data['title']); ?>
                <em>le <?php echo $data['postDateFr']; ?></em>
            </h3>
        </a>
        <p>
            <?php
                echo nl2br(htmlspecialchars(substr($data['chapterContent'], 0, 100))) . " ...";
                ?>
            <br />
        </p>
    </div>
<?php
}
?>
<a href="views/createPostView.php">Créer un nouveau chapitre</a>
<?php

$req->closeCursor();
$content = ob_get_clean();
require('views/template.php');
?>