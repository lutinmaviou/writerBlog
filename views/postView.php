<?php $title = strip_tags(htmlspecialchars_decode($post['title']));
ob_start();
?>
<!-- Chapter content -->
<section class="container mt-5">
    <div class="mx-auto">
        <div class="col-md-8 col-xs-6 text-justify mx-auto border p-4">
            <h2 class="text-center mb-5"><?= htmlspecialchars_decode(trim($post['title'])) ?></h2>
            <p><?= nl2br(htmlspecialchars_decode(trim($post['chapterContent']))) ?></p>
            <?php
            if ($_SESSION && $_SESSION['status'] === '1') {
                ?>
                <div class="row justify-content-around px-5 mt-5">
                    <div>
                        <form action="index.php?action=updatePost&amp;id=<?= $post['id'] ?>" method="POST">
                            <button class="btn btn-success btn-update">Modifier</button>
                        </form>
                    </div>
                    <div>
                        <form action="index.php?action=deletePost&amp;id=<?= $post['id'] ?>" method="POST">
                            <button class="btn btn-danger">Supprimer</button>
                        </form>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</section>
<!-- Display Comments section -->
<section class="container">
    <div class="row">
        <div class="col-md-8 col-sm-6 text-justify mx-auto line-height">
            <h3 class="text-center mb-4 mt-4  bg-md p-2">Commentaires</h3>
            <?php
            if (empty($comments)) {
                echo '<p class="text-primary text-center">Soyez le premier à laisser un commentaire.</p>';
            } else {
                foreach ($comments as $data) {
                    ?>
                    <div class="border line-height-5 p-3">
                        <h5><?= htmlspecialChars(trim($data['author'])) . ' <em id="dateTime-sm">le ' . $data['commentDateFr'] . '</em>' ?></h5>
                        <p class="mb-n2"><?= nl2br(htmlspecialchars(trim(ucfirst($data['commentContent'])))) ?></p>
                        <?php
                                if ($_SESSION && $_SESSION['status'] != '1') {
                                    if ($data['reporting'] === '1') {
                                        echo '<p class="mt-4 mb-n2 text-right text-danger"><em>Ce message a été signalé</em></p>';
                                    } else {
                                        ?>
                                <p class="mb-n2 text-right"><a class="text-danger" href="index.php?action=report&amp;id= <?= $post['id'] ?> &amp;commentId= <?= $data['id'] ?>">
                                        <i class="fas fa-exclamation-triangle mt-4"></i> Signaler
                                    </a></p>
                            <?php
                                        }
                                    }
                                    if ($_SESSION && $_SESSION['status'] === '1') {
                                        ?>
                            <form class="text-right" action="index.php?action=deleteComment&amp;id= <?= $post['id'] ?> &amp;commentId= <?= $data['id'] ?>" method="POST">
                                <button class="btn btn-sm btn-danger mt-4">Supprimer</button>
                            </form>
                        <?php
                                }
                                ?>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</section>
<!-- Post a comment section -->
<section class="container mt-3">
    <div class="row">
        <?php if ($_SESSION) {
            ?>
            <form class="col-md-6 text-center mx-auto bg-md border border-light rounded-lg shadow p-5 mt-4" action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="POST">
                <p class="h4 pb-4">Commenter</p>
                <label for="comment">
                    <textarea type="text" id="comment" name="commentContent" class="form-control mr-lg-5" cols="21" placeholder="Votre message" required></textarea>
                </label>
                <small class="form-text text-muted mb-4">
                </small>
                <button class="btn btn-info px-5" type="submit">Envoyer</button>
            </form>
        <?php
        } else {
            ?>
            <div class="col-md-6 mx-auto text-center mt-4 mb-5 border pt-2 bg-md">
                <p class="mb-n1">Vous devez être membre pour pouvoir laisser un commentaire ou signaler un message</p>
                <div class="pt-4">
                    <p><a href="index.php?action=login">Se connecter <i class="fas fa-sign-in-alt"></i></a></p>
                    <p><a href="index.php?action=subscribe">S'inscrire <i class="fas fa-sign-in-alt"></i></a></p>
                </div>
            </div>

        <?php

        }
        ?>
    </div>
</section>
<?php
$content = ob_get_clean();
require('template.php');
?>