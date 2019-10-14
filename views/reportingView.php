<?php $title = 'Messages signalés';
ob_start();
?>
<h2>Derniers messages signalés</h2>
<?php
foreach ($reportedComments as $data) {
    ?>
    <h4><?= htmlspecialChars(trim($data['author'])) . ' le ' . $data['commentDateFr'] ?></h4>
    <p><?= nl2br(htmlspecialchars(trim(ucfirst($data['commentContent'])))) ?></p>
    <form action="index.php?action=deleteComment&amp;id= <?= $data['post_id'] ?> &amp;commentId= <?= $data['id'] ?>" method="POST">
        <button>Supprimer</button>
    </form>
<?php
}
$content = ob_get_clean();
require('template.php');
?>