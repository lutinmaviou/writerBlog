<?php
$title = 'Le blog de Jean Forteroche';
ob_start();
?>
<div class="container">
    <?php
    // Say hello to connected user
    if ($_SESSION) {
        echo '<p class="pt-3 text-primary font-weight-bold text-center text-sm-left">Bonjour ' . $_SESSION['pseudo'] . ' !</p>';
    }
    // If admin connected, display reported messages
    if ($_SESSION && $_SESSION['status'] === '1') {
        ?>
        <div class="text-center">
            <p>
                <a href="index.php?action=displayReports">
                    <button class="btn btn-danger">Messages signalés par les lecteurs ! <i class="fas fa-sign-in-alt"></i></button>
                </a>
            </p>
        </div>
    <?php
    }
    ?>
    <!-- Last book presentation -->
    <section>
        <div class="container text-center my-5 py-5 bg-md">
            <h2 class="mb-3">Mon dernier roman en ligne</h2>
            <p>Suivez son évolution au fur et à mesure de mon écriture !</p>
            <img class="mt-5" src="public\img\jfbook.png" alt="book">
        </div>
    </section>
    <!-- Display last 3 chapters -->
    <section>
        <h2 class="container text-center bg-md p-4" id="lastChapters">Derniers chapitres</h2>

        <div class="container" id="articles">
            <div class="row justify-content-around">

                <?php
                while ($data = $req->fetch()) {
                    ?>
                    <article class="col-md-5 col-xl-3 mb-5 card shadow-sm bg-dark rounded">
                        <div class="card-header mt-3">
                            <h4 class="text-center">
                                <a href="index.php?action=post&amp;id=<?= $data['id']; ?>">
                                    <?php echo htmlspecialchars(ucfirst(trim($data['title']))); ?>
                                </a>
                            </h4>
                        </div>
                        <div class="card-body text-justify bg-md">
                            <?php
                                echo substr($data['chapterContent'], 0, 150) . " ...";
                                ?>
                            <p><a href="index.php?action=post&amp;id=<?= $data['id']; ?>" class="text-primary">Lire la suite</a></p>
                        </div>
                        <div class="card-footer text-dark mb-3">
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
    <!-- Pagination -->
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
</div>
<?php

$req->closeCursor();
$content = ob_get_clean();
require('views/template.php');
?>