<?php $title = 'Messages signalés';
ob_start();
?>
<section class="container">
    <div class="row">
        <div class="col-md-8 col-sm-6 text-justify mx-auto line-height">
            <h3 class="text-center mt-5 mb-4 bg-sm bg-md rounded p-2">Messages signalés</h3>
            <?php
            foreach ($reportedComments as $data) {
                ?>
                <div class="border line-height-5 p-3">
                    <h5><?= htmlspecialChars(trim($data['author'])) . ' <em id="dateTime-sm">le ' . $data['commentDateFr'] . '</em>' ?></h5>
                    <p class="mb-n2"><?= nl2br(htmlspecialchars(trim(ucfirst($data['commentContent'])))) ?></p>
                    <form class="mb-n2 text-right bg-white btn-sm" action="index.php?action=deleteComment&amp;id= <?= $data['post_id'] ?> &amp;commentId= <?= $data['id'] ?>&amp;status=1" method="POST">
                        <button class="btn btn-sm btn-danger mt-2">Supprimer</button>
                    </form>
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