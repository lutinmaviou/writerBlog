<?php $title = $post['title'];
ob_start();
?>
<h2><?= htmlspecialChars(trim($post['title'])) ?></h2>
<p><?= nl2br(htmlspecialchars(trim($post['chapterContent']))) ?></p>
<form action="index.php?action=updatePost&amp;id=<?= $post['id'] ?>" method="POST">
    <button>Modifier</button>
</form>
<form action="index.php?action=deletePost&amp;id=<?= $post['id'] ?>" method="POST">
    <button>Supprimer</button>
</form>
<h3>Commentaires</h3>
<?php
var_dump(empty($comments));
if (empty($comments)) {
    echo '<p>Soyez le premier  laisser un commentaire';
} else {
    foreach ($comments as $data) {
        ?>
        <h4><?= htmlspecialChars(trim($data['author'])) . ' le ' . $data['commentDateFr'] ?></h4>
        <p><?= nl2br(htmlspecialchars(trim($data['commentContent']))) ?></p>
        <span id="report">
            <a href="#"><i class="far fa-angry"></i> Signaler</a></span>
        <form action="index.php?action=deleteComment&amp;id=<?= $data['id'] ?>" method="POST">
            <button>Supprimer</button>
        </form>
<?php
    }
}
?>
<h3>Ajouter un commentaire</h3>
<form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="POST">
    <div>
        <label for="author">Auteur<br />
            <input type="text" id="author" name="author" />
        </label>
    </div>
    <div>
        <label for="comment">Commentaire<br />
            <textarea id="comment" name="commentContent"></textarea>
        </label>
    </div>
    <div id="button">
        <button>Envoyer</button>
    </div>
</form>

<?php

//$comments->closecursor();
$content = ob_get_clean();
require('template.php');
?>