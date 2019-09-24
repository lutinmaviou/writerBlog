<?php $title = $post['title'];
ob_start();
?>
<h2><?= $post['title'] ?></h2>
<p><?= $post['chapterContent'] ?></p>
<form action="index.php?action=updatePost&amp;id=<?= $_GET['id'] ?>" method="POST">
    <button>Modifier</button>
</form>
<form action="index.php?action=deletePost&amp;id=<?= $_GET['id'] ?>" method="POST">
    <button>Supprimer</button>
</form>
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
<h3>Commentaires</h3>
<?php
while ($data = $comments->fetch()) {
    ?>
    <h4><?= $data['author'] . ' le ' . $data['commentDateFr'] ?></h4>
    <p><?= $data['commentContent'] ?></p>
    <form action="index.php?action=deleteComment&amp;id=<?= $data['id'] ?>" method="POST">
        <button>Supprimer</button>
    </form>
<?php
    var_dump($data['id']);
}
$comments->closecursor();
$content = ob_get_clean();
require('template.php');
?>