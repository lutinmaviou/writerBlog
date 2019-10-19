<?php $title = 'Le blog de Jean Forteroche';
ob_start();
if ($_SESSION) {
    echo 'Bonjour ' . $_SESSION['pseudo'];
}
?>
<div class="container text-center my-5 py-5 bg-light" id="bookCont">
    <h2>Mon dernier roman en ligne</h2>
    <p>Suivez son évolution au fur et à mesure de mon écriture !</p>
    <img class="mt-5" src="public/img/Sans titre.png" alt="book">
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
<h2 class="text-center" id="lastChapters">Derniers chapitres</h2>

<div class="container" id="articles">
    <div class="row justify-content-around">

        <?php
        while ($data = $req->fetch()) {
            ?>
            <article class="col-md-3 mb-5 card shadow-sm bg-white rounded">
                <div class="card-header">
                    <a href="index.php?action=post&amp;id=<?= $data['id']; ?>">
                        <h4 class="text-center">
                            <?php echo htmlspecialchars_decode(trim($data['title'])); ?>
                        </h4>
                    </a>
                </div>
                <div class="card-body text-justify bg-light">
                    <?php
                        echo nl2br(htmlspecialchars_decode(trim(substr($data['chapterContent'], 0, 150)))) . " ...";
                        ?>
                    <p><a href="index.php?action=post&amp;id=<?= $data['id']; ?>" class="text-primary">Lire la suite</a></p>
                </div>
                <div class="card-footer text-dark">
                    <em>
                        <p class="text-center" id="publicationDate">publié le <?php echo $data['postDateFr']; ?></p>
                    </em>
                </div>
            </article>
        <?php
        }
        ?>
    </div>
</div>

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