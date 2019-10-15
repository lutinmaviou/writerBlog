<?php $title = 'Le blog de Jean Forteroche';
ob_start();
if ($_SESSION) {
    echo 'Bonjour ' . $_SESSION['pseudo'];
}
?>
<div id="book_presentation">
    <h2>Mon dernier roman en ligne</h2>
    <p>Suivez son évolution au fur et à mesure de mon écriture !</p>
    <img src="public/img/Sans titre.png" alt="book">
</div>
<?php

if ($_SESSION && $_SESSION['status'] === '1') {
    ?>
    <div>
        <a href="index.php?action=displayReports">
            <h3>Messages signalés par les lecteurs</h3>
        </a>

    </div>
<?php
}

?>

<h3>Derniers chapitres</h3>
<?php
while ($data = $req->fetch()) {
    ?>
    <div id="chapters_view">
        <a href="index.php?action=post&amp;id=<?= $data['id']; ?>">
            <h4>
                <?php echo html_entity_decode(trim(ucfirst($data['title']))); ?>
                <em><span class="date_font">
        </a> publié le <?php echo $data['postDateFr']; ?></span></em>
        </h4>

        <p>
            <?php
                echo nl2br(html_entity_decode(trim(ucfirst(substr($data['chapterContent'], 0, 200))))) . " ...";
                ?>
            <br />
            <span class="read_more"><a href="index.php?action=post&amp;id=<?= $data['id']; ?>">Lire la suite</a></span>
        </p>
    </div>
<?php
}
?>
<h5>Pagination</h5>

<?php
for ($i = 1; $i <= $nbPages; $i++) {
    if ($i === $currentPage) {
        echo $i . ' - ';
    } else {
        echo '<a href="index.php?page=' . $i . '"> ' . $i . ' - </a> ';
    }
}
echo '<br />' . $currentPage;
echo '<br />' . $nbPosts;
echo '<br />' . $nbPages;
$req->closeCursor();
$content = ob_get_clean();
require('views/template.php');
?>