<?php $title = $post['title'];
ob_start();
?>
<h2><?= htmlspecialChars(trim($post['title'])) ?></h2>
<p><?= nl2br(htmlspecialchars(trim($post['chapterContent']))) ?></p>
<?php
if ($_SESSION && $_SESSION['status'] === '1') {
    ?>
    <form action="index.php?action=updatePost&amp;id=<?= $post['id'] ?>" method="POST">
        <button>Modifier</button>
    </form>
    <form action="index.php?action=deletePost&amp;id=<?= $post['id'] ?>" method="POST">
        <button>Supprimer</button>
    </form>
<?php
}
?>
<h3>Commentaires</h3>
<?php
if (empty($comments)) {
    echo '<p>Soyez le premier à laisser un commentaire.';
} else {
    foreach ($comments as $data) {
        ?>
        <h4><?= htmlspecialChars(trim($data['author'])) . ' le ' . $data['commentDateFr'] ?></h4>
        <p><?= nl2br(htmlspecialchars(trim(ucfirst($data['commentContent'])))) ?></p>
        <?php
                //if ($_SESSION && $_SESSION['status'] != '1') {
                if ($data['reporting'] === '1') {
                    echo 'Ce message a été signalé';
                } else {
                    ?>
            <a href="index.php?action=report&amp;id= <?= $post['id'] ?> &amp;commentId= <?= $data['id'] ?>"><i class="fas fa-exclamation-triangle"></i> Signaler</a>
        <?php
                }
            }
            if ($_SESSION && $_SESSION['status'] === '1') {
                ?>
        <form action="index.php?action=deleteComment&amp;id= <?= $post['id'] ?> &amp;commentId= <?= $data['id'] ?>" method="POST">
            <button>Supprimer</button>
        </form>
        <?php
                //}
                ?>
<?php
    }
}
?>
<h3>Ajouter un commentaire</h3>
<?php if ($_SESSION) {
    ?>
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
} else {
    echo 'Vous devez être membre pour pouvoir laisser un commentaire';
}

$content = ob_get_clean();
require('template.php');
?>