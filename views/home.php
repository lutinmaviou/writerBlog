<?php $title = 'Le blog de Jean Forteroche';
ob_start();
if ($_SESSION) {
    echo '<p class="pt-3 pl-3 font-weight-bold">Bonjour ' . $_SESSION['pseudo'] . ' !</p>';
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
<section>
    <h2 class="text-center" id="lastChapters">Derniers chapitres</h2>

    <div class="container" id="articles">
        <div class="row justify-content-around">

            <?php
            while ($data = $req->fetch()) {
                ?>
                <article class="col-md-3 mb-5 card shadow-sm bg-white rounded">
                    <div class="card-header">
                        <h4 class="text-center">
                            <a href="index.php?action=post&amp;id=<?= $data['id']; ?>">
                                <?php echo htmlspecialchars(ucfirst(trim($data['title']))); ?>
                            </a>
                        </h4>
                    </div>
                    <div class="card-body text-justify bg-light">
                        <?php
                            echo substr($data['chapterContent'], 0, 150) . " ...";
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
</section>

<section>
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <li class="page-item <?php
                                    if ($currentPage <= 1) {
                                        ?>disabled<?php
                                                    } ?>">
                <a class="page-link" href="index.php?page=<?= $previousPage ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <?php
            for ($i = 1; $i <= $nbPages; $i++) {
                ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php
            }
            ?>
            <li class="page-item <?php
                                    if ($currentPage >= $nbPages) {
                                        ?>disabled<?php
                                                    } ?>">
                <a class="page-link" href="index.php?page=<?= $nextPage ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>
    </nav>
</section>
<?php

$req->closeCursor();
$content = ob_get_clean();
require('views/template.php');
?>